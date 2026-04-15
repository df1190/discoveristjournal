# 🗺️ Google Maps Review → Blog Post Converter
### Discoverist Journal | Upload to Claude Code alongside brand kit + travel blog skill

---

> **WHAT THIS FILE IS**
> A repeatable workflow for converting your existing Google Maps hotel reviews
> into full SEO-optimized blog posts with Marriott affiliate links.
> You have 25–50 reviews. Each one is a potential post. This file tells Claude Code
> exactly how to convert them — one prompt per review.

---

## AUTHOR CONTEXT (Claude Code must know this for every post)

- Marriott Bonvoy Ambassador status
- Star Alliance Gold status
- 25–50 Marriott properties reviewed on Google Maps from real stays
- Active affiliate: **Marriott Bonvoy hotel bookings only**
- Pending approval: Travelpayouts (Expedia, TripAdvisor, Booking.com) — DO NOT add these yet
- Site: discoveristjournal.com — static HTML files, GitHub deployment
- Output format: `.html` files ready for static site deployment

---

## THE WORKFLOW — 4 STEPS EVERY TIME

---

### STEP 1 — WHAT YOU DO (1 minute per review)

Go to your Google Maps profile and find a Marriott hotel review you've written.
Copy the full review text — every word, exactly as you wrote it.

Then open Claude Code and paste this prompt:

---

**THE MASTER PROMPT — copy this exactly, fill in the brackets:**

```
I have a Google Maps review I wrote for [HOTEL NAME] in [CITY, COUNTRY].
Here is my review:

"[PASTE YOUR FULL GOOGLE MAPS REVIEW TEXT HERE]"

Additional context I remember about this stay (add anything extra here, optional):
- [any detail not in the review, e.g. floor number, lounge experience, specific staff moment]
- [room type if you remember]
- [approximate year of stay if relevant]

Using my brand kit, travel blog skill, and the rules in this workflow file:
1. Convert this into a full SEO-optimized hotel review post
2. Output as a static .html file ready for GitHub deployment
3. Use ONLY Marriott Bonvoy affiliate link placeholders — no Booking.com or TripAdvisor yet
4. Follow the hotel review post structure from my skill file
5. Keep my original voice — don't over-polish it
```

---

### STEP 2 — WHAT CLAUDE CODE DOES (automatic)

Claude Code will:

1. **Extract your voice** from the review — your phrasing, your opinions, your specific details
2. **Build SEO structure** around it:
   - Primary keyword: `[hotel name] review` or `[hotel name] Marriott review`
   - Secondary keywords: city + Marriott, Bonvoy points value, neighborhood context
   - Title tag, meta description, URL slug
3. **Expand the review** into a full post using:
   - Your real details as the credibility core
   - Travel knowledge to fill context (location, neighborhood, getting there)
   - Bonvoy loyalty angle (points category, elite recognition notes)
   - Practical tips section
4. **Insert affiliate placeholders** — Marriott only, at natural booking decision moments
5. **Output** a ready-to-deploy `.html` file

---

### STEP 3 — QUALITY CHECK (2 minutes per post)

Before publishing, verify:

- [ ] Your original voice is intact — if it sounds too polished or generic, tell Claude Code:
      *"Make it sound more like my original review — keep [specific phrase] verbatim"*
- [ ] No invented facts — prices, promotions, specific amenities you didn't mention
      (Claude Code should have used `[INSERT CURRENT RATE]` placeholders for these)
- [ ] Marriott affiliate placeholders are present — minimum 2 per post
- [ ] No Booking.com or TripAdvisor links added yet
- [ ] HTML file opens correctly in browser before pushing to GitHub

---

### STEP 4 — PUBLISH + PROMOTE (5 minutes per post)

1. Push `.html` file to GitHub → auto-deploys to your site
2. Wait 24–48 hours for Google to index
3. When relevant, share on Reddit or Facebook with a natural comment
   (see Reddit/Facebook template section below)

---
---

## POST STRUCTURE — HOTEL REVIEW FORMAT
### Claude Code follows this for every Maps review conversion

```
FRONTMATTER (embedded as HTML meta tags):
- title: "[Hotel Name] Review — Is It Worth It? (Marriott Bonvoy)"
- meta description: 140–155 chars, includes hotel name + city + Bonvoy angle
- slug: [hotel-name-city-review-marriott-bonvoy]
- focus keyword: [hotel name] review
- secondary keywords: [city] Marriott hotel, Bonvoy points [city], [hotel name] worth it

STRUCTURE:
1. Opening hook — drop reader into the real experience immediately
   (use the most specific/vivid detail from the Google Maps review)

2. Quick verdict table:
   | Rating | Points value | Best for | Bonvoy category |
   (Claude Code fills what it knows, placeholders for rates)

3. Location & getting there
   (neighborhood context, transit, walkability)

4. The stay — room experience
   (expand from review details — views, room quality, vibe)

5. Amenities & highlights
   (lounge, pool, restaurant, anything mentioned in review)

6. Loyalty / Bonvoy angle
   - Points category estimate
   - Elite recognition quality (based on your experience)
   - Worth using points or cash?

7. Who it's best for / who should skip it
   (clear, opinionated — not "it depends")

8. Final verdict
   (one paragraph, direct recommendation)

9. Closing CTA — Marriott only for now:
   "Check availability at [Hotel Name] →"
   [MARRIOTT BONVOY AFFILIATE LINK — [Hotel Name] booking]

10. Internal linking suggestions
    (Claude Code suggests 2–3 related posts to link to)
```

---
---

## AFFILIATE RULES FOR THIS WORKFLOW

**Active now — use these:**
- `[MARRIOTT BONVOY AFFILIATE LINK — [Hotel Name] booking]` — in closing CTA
- `[MARRIOTT BONVOY AFFILIATE LINK — [Hotel Name] availability check]` — mid-post after room section
- `[MARRIOTT BONVOY AFFILIATE LINK — Bonvoy points search]` — in loyalty section if relevant

**Pending Travelpayouts approval — DO NOT add yet, leave HTML comments instead:**
```html
<!-- FUTURE: [BOOKING.COM AFFILIATE LINK — price comparison] — add when Travelpayouts approved -->
<!-- FUTURE: [TRIPADVISOR AFFILIATE LINK — tours/activities] — add when Travelpayouts approved -->
```

**Why HTML comments:** When Travelpayouts approves your site, you do a find-and-replace
across all your HTML files in one pass. Takes 20 minutes to monetize every post at once.

---
---

## PRIORITIZATION — WHICH REVIEWS TO CONVERT FIRST

Not all 25–50 reviews are equal. Convert in this order:

### Tier 1 — Convert immediately (highest search volume + affiliate value)
Properties in:
- Major US cities (New York, LA, Miami, Chicago, San Francisco, Las Vegas)
- Major international hubs (London, Paris, Tokyo, Dubai, Singapore, Bangkok)
- World Cup 2026 host cities (any match city jumps to top priority right now)

### Tier 2 — Convert within 30 days
Properties in:
- Popular leisure destinations (beach resorts, ski destinations, European cities)
- Properties with a strong story or standout detail in your review

### Tier 3 — Convert when Tier 1 + 2 are done
Properties in:
- Smaller cities or less-searched destinations
- Properties where your review is short or lacks specific details

---
---

## WHAT TO DO WHEN YOUR REVIEW IS SHORT

Some Google Maps reviews are 2–3 sentences. That's fine.
Tell Claude Code:

```
My review is short — only [X sentences]. 
Expand into a full post using travel knowledge for the location and property context,
but keep my exact words as the authentic core. Mark any expanded sections clearly
so I can verify accuracy before publishing.
```

Claude Code will scaffold the post around your real words and flag anything it's
filling in from general knowledge so you can fact-check.

---
---

## WHAT TO DO WHEN YOUR REVIEW IS NEGATIVE OR MIXED

Honest reviews convert better than glowing ones. Don't sanitize.

If your review includes criticism, tell Claude Code:

```
This review includes some criticism of the property.
Keep the honest assessment — do not soften it.
Frame it as "who this property is and isn't for" rather than a takedown.
The affiliate link should still appear but position it as:
"If this sounds like your kind of stay, check availability →"
```

Readers trust honest reviews. A post that says "the elevators were slow during the day
but the Broadway Lounge view made up for it" converts better than a post that says
everything was perfect.

---
---

## REDDIT + FACEBOOK PROMOTION TEMPLATES
### Use these when sharing converted posts on social

**Reddit — when someone asks about a hotel you've reviewed:**
```
I stayed there as a Marriott Bonvoy Ambassador — [one honest sentence from your review].
Wrote up the full experience here if it helps: [your post URL]
```

**Reddit — when someone asks about hotels in a city you have a post for:**
```
I've stayed at a few Marriott properties in [city] — here's my honest breakdown
with points value and elite recognition notes: [your post URL]
```

**Facebook travel groups:**
```
Just published my review of [Hotel Name] in [City] from my recent stay —
covering the Bonvoy points value, lounge experience, and whether it's worth
booking for [leisure/business/event]. Link in comments if useful.
```

**Key rule:** Always lead with value, never lead with the link.
The link goes in a comment or at the end — never the first thing people see.

---
---

## TRACKING — SIMPLE SYSTEM TO MANAGE ALL 25–50 REVIEWS

Copy this table into a notes app or spreadsheet. Update as you go.

| Hotel Name | City | Review Length | Tier | Status | Published URL |
|---|---|---|---|---|---|
| [Hotel 1] | [City] | Short/Medium/Long | 1/2/3 | To do / In progress / Live | |
| [Hotel 2] | [City] | | | | |
| ... | | | | | |

**Target pace:** 3–5 posts per week using this workflow = full review library live in 6–8 weeks.

---
---

## WHEN TRAVELPAYOUTS APPROVES YOUR SITE

Do this immediately across all published posts:

1. Open each `.html` file
2. Find all `<!-- FUTURE: [BOOKING.COM...] -->` comments
3. Replace with live Booking.com affiliate links
4. Find all `<!-- FUTURE: [TRIPADVISOR...] -->` comments  
5. Replace with live TripAdvisor affiliate links
6. Push all updated files to GitHub in one commit
7. Every post is now fully monetized — done

This is why the HTML comment placeholders matter. One batch update,
not hunting through 50 posts manually.

---
---

## INTERNAL LINKING STRATEGY AS LIBRARY GROWS

As you publish more posts, link them together:

- Every hotel review → links to that city's destination guide (when you write one)
- Every city guide → links to individual hotel reviews in that city
- Every World Cup post → links to any review of a property in that host city
- Every Bonvoy loyalty post → links to your best hotel reviews as examples

Claude Code will suggest internal links automatically with each post.
Accept the suggestions — internal linking is how your site builds authority over time.
