# DISCOVERIST JOURNAL — FILE REFERENCE FOR CLAUDE CODE
# All files are static HTML/CSS/JS — no framework, no build step.
# Deploy root to GitHub Pages. Domain: discoveristjournal.com

---

## DESIGN SYSTEM (apply to every file)

Fonts:       Playfair Display (headings, 700/800) + Barlow (body, 300/400)
Google CDN:  https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,800;1,700;1,800&family=Barlow:wght@300;400;500;600&display=swap

CSS Variables:
  --black:    #0c0b09   page background
  --deep:     #141210   alternate section background
  --charcoal: #1e1b17   card / panel background
  --stone:    #2a2520   raised surface / subtle bg
  --warm:     #c8a97e   primary gold accent, CTAs, labels
  --warm-lt:  #e2c99f   lighter gold, hover states, em text
  --cream:    #f2ece2   body text
  --muted:    #7a7068   secondary text, meta, placeholders
  --white:    #faf8f4   hero titles, high contrast headings

Nav: fixed, transparent over hero → solid on scroll. Links: Hotels / Trips & Journeys / POD Store / About
Scroll reveals: class="reveal" → IntersectionObserver adds class="visible"
All sections: padding 80–100px 48px, max-width 1200px centered
Photo grids: gap 2px (images touch, no borders)
Affiliate disclaimer: every page footer + inline in booking boxes
Mobile menu: hamburger → full-screen overlay

---

## SITE PAGES

### index.html
PURPOSE: Homepage. Entry point for all traffic.
SECTIONS:
  - Hero: full-height, parallax, Swiss Alps drone image
  - Intro split: about text + Gabriel Gamar quote + stats (40+ countries, 200+ hotels, ★)
  - Hotel Reviews grid: 3 cards (first wide), Travelpayouts affiliate links
  - Affiliate partner band: Travelpayouts / Marriott / Amazon / Booking.com
  - Trips & Journeys: 2x2 editorial grid
  - Moto strip: dedicated motorcycle section
  - POD Store: 4-item hover grid → Printify
  - Newsletter signup form
  - Destinations: 5-country grid
  - Blog: 3 recent posts
  - About teaser + footer
AFFILIATE LINKS: Travelpayouts hotel deep links in hotel cards
NOTES: Hero bg image set in .hero-bg CSS background-image property

### about.html
PURPOSE: Author credibility page. Builds trust for affiliate conversions.
SECTIONS:
  - Page header with ghost watermark "ABOUT"
  - Intro split: photo left / story text right
  - Credentials: 3 cards (Bonvoy Ambassador / Star Alliance Gold / 40+ Countries)
  - Blockquote break (Gabriel Gamar quote)
  - Philosophy: story left / numbered values 01–04 right
  - Stats band: 40+ / 200+ / ★ / ∞
  - Affiliate disclosure section
  - CTA → Hotels + Journeys
NOTES: No affiliate links on this page. Pure trust-building.

### hotels.html
PURPOSE: Hotel reviews listing page.
STATUS: NOT YET BUILT — next priority
SHOULD CONTAIN: Filter bar by country/region, hotel card grid, featured hotel, affiliate links per card

### journeys.html
PURPOSE: Trips & journeys listing page.
SECTIONS:
  - Full-height photo hero (drone image)
  - Sticky filter bar: All / Europe / Americas / Asia / Motorcycle / Winter / Alpine
  - Featured journey card (editorial 50/50 split)
  - Journey grid: 3-col with wide featured card
  - Moto section: 2-col grid, ghost "MOTO" watermark
  - Load more button
AFFILIATE LINKS: Travelpayouts in featured journey booking area

### blog.html
PURPOSE: Blog listing page with sidebar.
SECTIONS:
  - Page header + search bar
  - Category filter tabs (All / Hotel Reviews / Trip Reports / Motorcycle / Gear / Loyalty / City Guides)
  - Featured post (large editorial split)
  - Post list: thumbnail + excerpt + date
  - Sidebar: recent posts / destination tags / newsletter widget
  - Pagination
AFFILIATE LINKS: None on listing page. Links are inside individual posts.

### blog-post.html
PURPOSE: TEMPLATE for every blog post and hotel review. Reuse for all content.
REUSE: Copy this file, rename (e.g. cambrian-adelboden.html), replace content.
SECTIONS:
  - Reading progress bar (fixed, top of viewport)
  - Full-height hero: breadcrumbs + category tags + title + meta
  - Two-column layout: article left / sticky sidebar right
ARTICLE ELEMENTS AVAILABLE:
  .post-intro        — large lead paragraph (18px, semi-bold)
  .quick-facts       — hotel facts grid (2-col)
  h2.post-h2         — section heading with optional em accent
  h3.post-h3         — sub-heading in warm-lt color
  p.post-p           — standard body paragraph
  .post-quote        — pull quote with left border
  .post-img-full     — full-width image with caption
  .post-img-grid     — 2-col image grid
  .affiliate-box     — booking CTA box with hotel name, desc, link, disclaimer
  .verdict           — scores grid (Design / Food / Experience / Value) + verdict text
  .post-tags         — tag cloud at bottom
SIDEBAR ELEMENTS:
  TOC with scroll-based active state tracking
  Sticky "Book This Hotel" widget with price + affiliate CTA
  Related reviews (3 items with thumbnails)
AFFILIATE LINKS: .affiliate-box and sidebar .sidebar-book widget
NOTES: Duplicate and rename for each new post. Update: hero bg image, title, meta, breadcrumbs, body content, affiliate links, related posts.

### store.html
PURPOSE: POD store landing page. Showcases products, links out to Printify for checkout.
SECTIONS:
  - Page header with ghost watermark "SHOP"
  - Brand statement: why these objects exist
  - Category filter tabs
  - 3x2 product grid: each card links to Printify
  - Featured product spotlight (50/50 editorial)
  - Printify redirect band
  - "How It Works" 3-step section
AFFILIATE LINKS: All product links → https://thediscoveristjournal.printify.me/
NOTES: No checkout on this page. All purchases happen on Printify. Update product images and names as Printify catalogue grows.

---

## MOTO PAGES

### moto-alpine-passes.html
PURPOSE: Reference guide for Alpine motorcycle passes. Evergreen SEO content.
SECTIONS:
  - Hero: full-height moto image
  - Season calendar: open/closed months per pass (5 passes, 12 months, colour-coded dots)
  - Filter bar: by country (CH/IT/AT/FR) + difficulty + search
  - Pass cards grid: 6 passes with photo, difficulty badge, elevation, surface, traffic, affiliate hotel button
  - 6 field-note tip cards (Ride Early / Weather / Fuel / Tyres / Maps / Hotels)
  - Tools band linking to moto-tools.html
FILTER LOGIC:
  data-country="it|ch|at|fr" on each .pass-card
  data-difficulty="easy|moderate|technical|extreme" on each .pass-card
  JS filters by activeCountry + activeDifficulty + search text against data-name
AFFILIATE LINKS: "Hotels Nearby" button on each pass card → Travelpayouts deep links
EXPAND: Add more .pass-card divs following exact same structure to grow the database.

### moto-trip-report.html
PURPOSE: TEMPLATE for motorcycle trip reports. Reuse for every moto journey.
REUSE: Copy, rename (e.g. moto-furka-loop.html), replace all content.
SECTIONS:
  - Reading progress bar
  - Full-height hero: breadcrumbs, categories, title, meta
  - Route stats band: km / days / passes / elevation / best month (5-col grid)
  - DAY CARDS (key structure — one per riding day):
      .day-header: day number + route title
      .day-meta-row: distance, elevation, riding time, fuel note
      .road-conditions: 4-cell grid (Surface / Traffic / Summit Temp / Weather)
      .waypoints: numbered stops with names, notes, cumulative km
      .overnight-box: hotel name, features, affiliate CTA button
  - Field notes (post-h2 + post-p sections between day cards)
  - post-img-row: 2-col photo grid
  - post-quote: pull quote
  - .gear-used: 6-item gear grid, all Amazon affiliate links
  - .verdict: 4 scores + verdict text
  - .post-tags: tag cloud
  - Sidebar: sticky TOC + route quick stats + related passes
  - Post nav: back to passes guide / next journey
AFFILIATE LINKS:
  .overnight-box CTA → Travelpayouts hotel link (update per hotel)
  .gear-used items → Amazon affiliate links (update tag= to your ID)
NOTES: Replace hero bg image in .hero-bg CSS. Update all data-specific content. The day card structure is the core differentiator — maintain it.

---

## TOOLS

### tool-trip-calculator.html
PURPOSE: Interactive trip cost estimator. Drives hotel affiliate conversions.
FUNCTION:
  - 6 destination presets auto-populate sliders (Switzerland/Italy/Norway/Spain/Thailand/Colombia)
  - User adjusts: nights, travellers, hotel tier, hotel $/night, food/day, activities/day, flights, transport, insurance
  - Calculates: total cost, per-day cost, full line-item breakdown
  - Results show: Discoverist tip per destination + "Search Hotels" affiliate button
AFFILIATE TRIGGER: Every result generates a Travelpayouts search button for that destination
DATA LOCATION: destData object in <script> — add destinations by adding new key
AFFILIATE LINKS: destData[dest].link property — update with correct Travelpayouts deep links

### tool-hotel-comparison.html
PURPOSE: Side-by-side hotel comparison tables. Drives booking decisions.
FUNCTION:
  - 4 destination tabs: Switzerland / Italy / Best of Alps / Norway (coming soon)
  - Each tab shows a comparison grid: hotel headers with photos + booking buttons, then rows comparing price, location, design, best for, loyalty points, spa, restaurant, Discoverist score
  - Verdict section below grid
TAB SWITCHING: showDest(dest, btn) function, shows/hides .dest-section divs by id
AFFILIATE LINKS: .hotel-book-btn on each hotel header, aff-bar link at bottom of each tab
EXPAND: Add new destination tabs by adding a new .dest-section div + a new .tab button

### tool-destination-quiz.html
PURPOSE: "Where should you travel next?" quiz. Highly shareable on Reddit/Facebook.
FUNCTION:
  - 8 questions, 4 options each
  - Scoring: each answer has a tag, each destination has scores per tag
  - Results: top 3 ranked destinations with photo, why text, tags, affiliate hotel search button
  - Retake button resets all state
SCORING: destinations array in <script>, each entry has .scores object mapping answer tags to point values
AFFILIATE LINKS: result-book-btn on each result card → destData link per destination
EXPAND: Add destinations by adding new object to destinations array with name/img/link/tags/why/scores

### tool-packing-list.html
PURPOSE: Trip packing list generator. Amazon affiliate on every gear item.
FUNCTION:
  - Selectors: trip type (Alpine/Moto/City/Beach/Backcountry) + duration + season
  - Generates categorised checklist with essential vs optional items
  - Weekend mode: shows essentials only
  - Checkboxes with progress bar (N/total packed)
  - Sidebar: 3 curated gear items with Amazon links per trip type
  - Print to PDF button
DATA: lists object in <script> — nested by type → season → {title, tip, gear[], cats[]}
AMAZON LINKS: gear[].link in each list entry — format: https://www.amazon.com/s?k=QUERY&tag=YOUR-TAG
EXPAND: Fill in empty season combinations (currently some show "coming soon"). Follow existing structure exactly.

### tool-interactive-map.html
PURPOSE: Visual "where I've been" map. Builds authority, drives country page visits.
FUNCTION:
  - SVG world map with highlighted visited countries
  - Hover: tooltip with country name, featured hotel/journey, meta info
  - Click: navigates to journeys.html (update to specific country pages when built)
  - Country card grid below map: grid view or list view toggle
  - Countries organised by region in list view
SVG PATHS: Simplified shapes — not geographic-accurate. Sufficient for UI purposes.
TOOLTIP DATA: countryData object in <script> — add/update entries per country
AFFILIATE LINKS: None directly. Drives traffic to journeys.html which contains affiliate links.
EXPAND: Update countryData entries as new trip reports are published. Update SVG country IDs to match new destinations.

---

## MOTO TOOLS (all 4 in one file)

### moto-tools.html
PURPOSE: All 4 motorcycle planning tools in a single tabbed interface.
TABS: Route Planner / Pass Difficulty Finder / Fuel Calculator / Rider's Hotel Index

TAB 1 — ROUTE PLANNER:
  FUNCTION: Select country + duration + style + difficulty + must-include passes → returns matching curated routes
  DATA: routes array in <script> — each route has id/name/days/country/style/difficulty/km/passes/overnight/links
  MATCHING: filters routes array against user selections, falls back to first 2 routes if no match
  AFFILIATE LINKS: overnightLink per route → Travelpayouts. Action button "Book Hotel" per result card.
  EXPAND: Add routes to routes array following exact same object structure.

TAB 2 — PASS DIFFICULTY FINDER:
  FUNCTION: Sortable/filterable table of 13 Alpine passes
  FILTERS: Country dropdown + Difficulty dropdown + Season status dropdown
  DATA: passData array in <script> — each entry has name/country/elevation/diff/season/surface/score/link
  AFFILIATE LINKS: .pass-book-link "Book Nearby" per table row → Travelpayouts hotel links
  EXPAND: Add passes to passData array. Follow exact same object structure.

TAB 3 — FUEL CALCULATOR:
  FUNCTION: Tank size + consumption + distance + terrain profile + reserve policy → fuel stops, cost, stop km points
  PRESET ROUTES: presetRoutes object — auto-fills distance and profile for named routes
  CALCULATIONS:
    usableTank = tank - reserveLitres
    consump adjusted by profileMult (flat 1x / mixed 1.15x / technical 1.25x)
    rangeKm = floor(usableTank / consump * 100)
    stopsNeeded = ceil(distance / rangeKm) - 1
    cost estimate uses €1.85/L (update this value as fuel prices change)
  AFFILIATE LINKS: None directly. Contextually links to hotel booking via tips section.

TAB 4 — RIDER'S HOTEL INDEX:
  FUNCTION: Curated moto-friendly hotels, filterable by feature tag
  FILTER TAGS: secure-parking / early-breakfast / pass-proximity / spa
  DATA: data-tags attribute on each .hi-card div (space-separated tag list)
  AFFILIATE LINKS: Each .hi-card href → Travelpayouts hotel link
  EXPAND: Add new .hi-card divs. Set data-tags to relevant comma-separated tags. Link to appropriate Travelpayouts deep link.

---

## AFFILIATE LINK REFERENCE

Program          | Platform    | Format
Travelpayouts    | Direct      | https://prf.hn/l/[CODE]/
Marriott Bonvoy  | Partnerize  | Generate in Partnerize dashboard
Amazon           | Associates  | https://www.amazon.com/s?k=[QUERY]&tag=[YOUR-TAG]
Printify Store   | Direct      | https://thediscoveristjournal.printify.me/

Current Travelpayouts deep links in use:
  The Cambrian, Adelboden    → https://prf.hn/l/kVGw1Zv/
  Vigilius Mountain Resort   → https://prf.hn/l/DLkmPaZ/
  The Hotel Lucerne          → https://prf.hn/l/3PGgpkE/
  Generic hotel search       → https://prf.hn/l/kVGw1Zv/

Amazon tag placeholder: tdjournal-20
ACTION REQUIRED: Replace tdjournal-20 with your actual Associates tracking ID everywhere it appears.

---

## IMAGES IN USE (WordPress CDN)

All images served from discoveristjournal.com WordPress uploads:
  Swiss_018       → https://discoveristjournal.com/wp-content/uploads/2026/02/Swiss_018-768x1024.jpg
  IMG_4850        → https://discoveristjournal.com/wp-content/uploads/2026/02/IMG_4850-576x1024.jpg
  Swiss_023       → https://discoveristjournal.com/wp-content/uploads/2026/02/Swiss_023-768x1024.jpg
  IMG_4857        → https://discoveristjournal.com/wp-content/uploads/2026/01/IMG_4857-576x1024.jpg
  2-0             → https://discoveristjournal.com/wp-content/uploads/2026/01/2-0-1024x576.jpg
  IMG_5791        → https://discoveristjournal.com/wp-content/uploads/2026/01/IMG_5791-scaled-e1769258060646-1024x954.jpg
  4-DJI_0101      → https://discoveristjournal.com/wp-content/uploads/2026/01/4-DJI_0101-576x1024.jpg
  7-dji_fly       → https://discoveristjournal.com/wp-content/uploads/2026/01/7-dji_fly_20230721_112538_90_1690062080451_photo-576x1024.jpg
  8-dji_fly       → https://discoveristjournal.com/wp-content/uploads/2026/01/8-dji_fly_20230721_112524_87_1690062076550_photo-576x1024.jpg
  IMG_4938        → https://discoveristjournal.com/wp-content/uploads/2023/01/IMG_4938-1024x576.jpg

NOTE: If WordPress is decommissioned, update all src attributes to new CDN or local /images/ folder.

---

## COMPLETE FILE LIST

Site Pages:
  index.html                  Homepage
  about.html                  About / Author credibility
  hotels.html                 Hotel reviews listing (NOT YET BUILT)
  journeys.html               Trips & journeys listing
  blog.html                   Blog listing with sidebar
  blog-post.html              TEMPLATE — blog post / hotel review
  store.html                  POD store → Printify

Moto Pages:
  moto-alpine-passes.html     Alpine passes reference guide
  moto-trip-report.html       TEMPLATE — motorcycle trip report

Travel Tools:
  tool-trip-calculator.html   Trip cost estimator
  tool-hotel-comparison.html  Hotel side-by-side comparison
  tool-destination-quiz.html  Where should you travel next? quiz
  tool-packing-list.html      Packing list builder
  tool-interactive-map.html   Visited countries map

Moto Tools:
  moto-tools.html             4 tools in one: Route Planner + Pass Finder + Fuel Calculator + Hotel Index

Project Docs:
  PROJECT_MEMORY.md           Full project context for new Claude conversations
  CLAUDE_CODE_REFERENCE.md    This file

---

## PENDING / TODO

  [ ] Build hotels.html — hotel reviews listing page
  [ ] Replace tdjournal-20 Amazon tag with real Associates ID
  [ ] Add real Printify product URLs to store.html product cards
  [ ] Add Travelpayouts Marker ID to hotel search widget (when built)
  [ ] Set up GitHub repo, push all files, enable GitHub Pages
  [ ] Point discoveristjournal.com DNS → GitHub Pages
  [ ] Add Google Analytics tracking snippet to all pages
  [ ] Add Open Graph meta tags to all pages for social sharing
  [ ] Add schema.org structured data to blog-post.html and hotel reviews
  [ ] Set up email capture backend (Mailchimp or ConvertKit)
  [ ] Fill empty packing list combinations in tool-packing-list.html
  [ ] Add more pass cards to moto-alpine-passes.html
  [ ] Expand passData array in moto-tools.html Tab 2
  [ ] Update countryData in tool-interactive-map.html as new trips published
