# The Discoverist Journal

Static site for [discoveristjournal.com](https://discoveristjournal.com) — hotels, journeys, and motorcycle travel.

## Deploy

Push to `main` → Hostinger auto-deploys via Git integration.

## Structure

```
/               Core pages (index, about, hotels, journeys, blog, store)
/tools/         Interactive travel tools
/moto/          Motorcycle pages
```

## Notes

- All CSS and JS is inline per page — no build step required
- Clean URLs handled by `.htaccess` (Apache)
- Affiliate links: Travelpayouts, Amazon Associates (tag: tdjournal-20), Printify
