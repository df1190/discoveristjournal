<?php
// Poster order requests from tools/map-generator.html.
// Saves every order in _orders/<id>/ (never served) and emails David the
// design file, a preview and the customer's photo, plus a short receipt to
// the customer. Where to send it lives in order-config.php, which is not in
// git:  <?php return ['to' => 'you@example.com'];
header('Content-Type: application/json');

function fail($code, $msg) {
    http_response_code($code);
    echo json_encode(['ok' => false, 'error' => $msg]);
    exit;
}
function cut($s, $max) { return function_exists('mb_substr') ? mb_substr($s, 0, $max, 'UTF-8') : substr($s, 0, $max); }
function field($k, $max, $multiline = false) {
    $v = trim((string)($_POST[$k] ?? ''));
    if (!$multiline) $v = preg_replace('/[\r\n\t]+/', ' ', $v);
    return cut($v, $max);
}
function mime_header($s) { return '=?UTF-8?B?' . base64_encode($s) . '?='; }

if ($_SERVER['REQUEST_METHOD'] !== 'POST') fail(405, 'Method not allowed');
// Bots fill the hidden "website" field; pretend it worked.
if (!empty($_POST['website'])) { echo json_encode(['ok' => true, 'id' => 'DP-0']); exit; }

$PRODUCTS = [
    'poster'  => ['8x10', '11x14', 'a4', 'a3', 'a2', '30x40', '50x70', '61x91'],
    'framed'  => ['8x10', '11x14', 'a4', '30x40', '50x70'],
    'canvas'  => ['a4', '30x40', '50x70'],
    'digital' => [],
];
$FRAMES = ['black' => 'Black', 'white' => 'White', 'natural' => 'Natural wood'];
$PAY    = ['stripe' => 'Card (Stripe)', 'paypal' => 'PayPal', 'printify' => 'Printify checkout'];

$name    = field('name', 100);
$email   = field('email', 160);
$country = field('country', 80);
$store   = field('store_order', 60);
$note    = field('note', 1000, true);
$product = field('product', 20);
$size    = field('size', 20);
$frame   = field('frame', 20);
$pay     = field('pay', 20);
$orient  = field('orient', 20) === 'landscape' ? 'landscape' : 'portrait';
$style   = preg_replace('/[^a-z]/', '', field('style', 20));
$title   = field('title', 120);

if ($name === '' || $country === '') fail(400, 'Please fill in your name and country');
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) fail(400, 'Please check your email address');
if (!isset($PRODUCTS[$product])) fail(400, 'Unknown product');
if ($PRODUCTS[$product] && !in_array($size, $PRODUCTS[$product], true)) fail(400, 'Unknown size');
if ($product === 'framed' && !isset($FRAMES[$frame])) fail(400, 'Unknown frame colour');
if ($store === '' && !isset($PAY[$pay])) fail(400, 'Please choose how to pay');

// Uploaded files, checked by content (not by what the browser claims).
function upload($k, $maxBytes, $kind) {
    if (empty($_FILES[$k]) || $_FILES[$k]['error'] !== UPLOAD_ERR_OK) return null;
    $f = $_FILES[$k];
    if ($f['size'] > $maxBytes) fail(413, 'A file is too large');
    $head = file_get_contents($f['tmp_name'], false, null, 0, 4);
    if ($kind === 'jpg' && substr($head, 0, 3) !== "\xFF\xD8\xFF") fail(400, 'Invalid image');
    if ($kind === 'json' && json_decode(file_get_contents($f['tmp_name'])) === null) fail(400, 'Invalid design file');
    return $f['tmp_name'];
}
$design  = upload('design', 8 * 1024 * 1024, 'json');
$preview = upload('preview', 4 * 1024 * 1024, 'jpg');
$photo   = upload('photo', 15 * 1024 * 1024, 'jpg');
if (!$design) fail(400, 'The design is missing');

// Order folder, locked from the web.
$base = __DIR__ . '/_orders';
if (!is_dir($base)) mkdir($base, 0750, true);
if (!is_file("$base/.htaccess")) file_put_contents("$base/.htaccess", "Require all denied\n<IfModule !mod_authz_core.c>\nDeny from all\n</IfModule>\n");

// At most 6 requests an hour from one address.
$ipKey = "$base/.rate-" . md5($_SERVER['REMOTE_ADDR'] ?? '');
$now = time();
$hits = array_filter(array_map('intval', is_file($ipKey) ? file($ipKey, FILE_IGNORE_NEW_LINES) : []), function ($t) use ($now) { return $t > $now - 3600; });
if (count($hits) >= 6) fail(429, 'Too many requests, please try again in an hour');
$hits[] = $now;
file_put_contents($ipKey, implode("\n", $hits));

$id  = 'DP-' . date('Ymd') . '-' . strtoupper(bin2hex(random_bytes(2)));
$dir = "$base/$id";
mkdir($dir, 0750);
move_uploaded_file($design, "$dir/design.json");
if ($preview) move_uploaded_file($preview, "$dir/preview.jpg");
if ($photo) move_uploaded_file($photo, "$dir/photo.jpg");

$labels = ['8x10' => '8 x 10 in', '11x14' => '11 x 14 in', 'a4' => 'A4', 'a3' => 'A3', 'a2' => 'A2', '30x40' => '30 x 40 cm', '50x70' => '50 x 70 cm', '61x91' => '61 x 91 cm'];
$what = ucfirst($product === 'digital' ? 'digital file (PNG)' : $product)
      . ($size ? ', ' . $labels[$size] . ", $orient" : '')
      . ($product === 'framed' ? ', ' . $FRAMES[$frame] . ' frame' : '');
$order = [
    'id' => $id, 'time' => date('c'), 'name' => $name, 'email' => $email, 'country' => $country,
    'product' => $product, 'size' => $size, 'frame' => $frame, 'orientation' => $orient,
    'pay' => $store === '' ? $PAY[$pay] : '', 'store_order' => $store, 'note' => $note,
    'style' => $style, 'title' => $title, 'photo' => (bool)$photo,
];
file_put_contents("$dir/order.json", json_encode($order, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

$cfgFile = __DIR__ . '/order-config.php';
$cfg = is_file($cfgFile) ? include $cfgFile : [];
$to = is_array($cfg) ? ($cfg['to'] ?? '') : '';
$from = 'Discoverist Posters <no-reply@discoveristjournal.com>';

// Email to David with the files attached.
$mailed = false;
if (filter_var($to, FILTER_VALIDATE_EMAIL)) {
    $body = "New poster order request $id\n\n"
          . "Product:   $what\n"
          . "Style:     $style" . ($title !== '' ? " ($title)" : '') . "\n"
          . ($store !== '' ? "Store order: $store (already paid)\n" : "Pays with: {$PAY[$pay]}\n")
          . "\nName:      $name\nEmail:     $email\nCountry:   $country\n"
          . ($note !== '' ? "\nNote:\n$note\n" : '')
          . "\nTo make it: open discoveristjournal.com/tools/map-generator, drop design.json"
          . ($photo ? ' and photo.jpg together' : '') . " on the route box, choose 300 DPI and download the PNG.\n"
          . "Everything is also saved on the server in _orders/$id/.\n";
    $b = 'b' . bin2hex(random_bytes(8));
    $msg = "--$b\r\nContent-Type: text/plain; charset=UTF-8\r\nContent-Transfer-Encoding: base64\r\n\r\n" . chunk_split(base64_encode($body)) . "\r\n";
    $files = [['preview.jpg', 'image/jpeg'], ['design.json', 'application/json'], ['photo.jpg', 'image/jpeg']];
    $total = 0;
    foreach ($files as [$fn, $type]) {
        if (!is_file("$dir/$fn")) continue;
        $total += filesize("$dir/$fn");
        if ($total > 18 * 1024 * 1024) break;   // keep the email under common size limits
        $msg .= "--$b\r\nContent-Type: $type; name=\"$fn\"\r\nContent-Transfer-Encoding: base64\r\nContent-Disposition: attachment; filename=\"$fn\"\r\n\r\n"
              . chunk_split(base64_encode(file_get_contents("$dir/$fn"))) . "\r\n";
    }
    $msg .= "--$b--";
    $headers = "From: $from\r\nReply-To: $email\r\nMIME-Version: 1.0\r\nContent-Type: multipart/mixed; boundary=\"$b\"";
    $mailed = mail($to, mime_header("Poster order $id: $what, $name"), $msg, $headers);

    // Short receipt to the customer.
    $receipt = "Hi $name,\n\nThanks for your poster order request. Your reference is $id.\n\n"
             . "What you asked for: $what\n\n"
             . ($store !== ''
                 ? "David will check your design and email you a proof within 24 hours.\n"
                 : "David will check your design and email you a proof and a payment link within 24 hours. Nothing is charged until you pay that link.\n")
             . "\nIf anything needs changing, just reply to this email.\n\nDavid\nDiscoverist · discoveristjournal.com\n";
    mail($email, mime_header("Your poster order $id"), $receipt,
         "From: $from\r\nReply-To: $to\r\nMIME-Version: 1.0\r\nContent-Type: text/plain; charset=UTF-8");
}
file_put_contents("$dir/order.json", json_encode($order + ['emailed' => $mailed], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

echo json_encode(['ok' => true, 'id' => $id]);
