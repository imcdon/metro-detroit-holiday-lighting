<?php
/*
 * config.php - Site-wide settings for Metro Detroit Holiday Lighting.
 */
require_once __DIR__ . '/paths.php';
require_once __DIR__ . '/staging-gate.php';
require_once __DIR__ . '/cities.php';
require_once __DIR__ . '/gallery.php';
require_once __DIR__ . '/landing-pages.php';

$site_name = 'Metro Detroit Holiday Lighting';
$site_domain = 'metrodetroitholidaylighting.com';
$site_url = 'https://metrodetroitholidaylighting.com';
$site_tagline = 'Holiday magic, simplified.';
$site_description = 'Owner-operated holiday lighting for Metro Detroit homes, businesses & HOAs. Design, install, care, takedown & storage. Free estimate. (248) 525-4715.';
$company_name = 'Metro Detroit Holiday Lighting';
$owner_name = 'Steve';
$years_experience = 20;

$phone = '(248) 525-4715';
$phone_href = 'tel:+12485254715';
$sms_href = 'sms:+12485254715';
$email = 'metrodetroitholidaylighting@gmail.com';
$email_href = 'mailto:metrodetroitholidaylighting@gmail.com';
$contact_form_to = $email;
$mail_from = '';

$trust_line = 'Professionally designed. Fully insured. Owner-operated.';

$service_nav = mdhl_audience_nav();
// Specialty landings stay live; set true when copy is ready for the Specialties menu.
$show_specialty_nav = false;
$specialty_nav = $show_specialty_nav ? mdhl_specialty_nav() : [];

$nav_links = [
    'Home' => '',
    'Services' => 'homeowners/',
];
if ($show_specialty_nav) {
    $nav_links['Specialties'] = 'wreaths/';
}
$nav_links += [
    'Gallery' => 'gallery/',
    'Service Areas' => 'service-areas/',
    'Contact' => 'contact/',
];

$audiences = [
    [
        'title' => 'Homeowners',
        'body' => 'Custom holiday lighting that fits your home — rooftops, trees, walks, and accents — without you climbing a ladder or fighting tangled cords.',
        'image' => 'assets/img/gallery/mdhl-bloomfield-hills-5.jpg',
        'image_alt' => 'Bloomfield Hills home with professional holiday lighting',
        'url' => 'homeowners/',
    ],
    [
        'title' => 'Businesses',
        'body' => 'Storefronts, offices, and commercial buildings that look polished for the season and stay maintained from install through take-down.',
        'image' => 'assets/img/audiences/businesses.jpg',
        'image_alt' => 'Commercial storefront with professional holiday lighting',
        'url' => 'businesses/',
    ],
    [
        'title' => 'HOAs & Property Managers',
        'body' => 'Community entrances, clubhouses, and shared spaces with one clear plan, one crew, and one call for mid-season fixes.',
        'image' => 'assets/img/gallery/commercial-07-how-entrance.jpg',
        'image_alt' => 'Community entrance with professional holiday lighting',
        'url' => 'hoa-property-managers/',
    ],
];

foreach ($audiences as &$audience) {
    $audiencePath = dirname(__DIR__) . '/' . $audience['image'];
    $audience['has_image'] = is_file($audiencePath);
}
unset($audience);

$process_steps = [
    [
        'title' => 'Custom Design',
        'body' => 'Call or submit a quote with your name and address, and we\'ll schedule a date and time for Steve to come out and understand your vision. He\'ll create a full lighting and décor plan that fits your vision and budget.',
    ],
    [
        'title' => 'Installation',
        'body' => 'Professional installation before the season hits. Clean lines, secure clips, and displays built to last through Michigan weather.',
    ],
    [
        'title' => 'Maintenance',
        'body' => 'We maintain your lighting and décor all season long.',
    ],
    [
        'title' => 'Take-down',
        'body' => 'After the holidays, lights and décor come down carefully so nothing is left behind on the property.',
    ],
    [
        'title' => 'Off-season storage',
        'body' => 'Décor is labeled and properly stored for next season.',
    ],
];

$faq_items = [
    [
        'q' => 'Do you serve my city in Metro Detroit?',
        'a' => 'Yes — we work across Oakland, Wayne, Macomb, and Genesee County. Browse Service Areas or call (248) 525-4715 to confirm your neighborhood.',
    ],
    [
        'q' => 'How do I get a quote?',
        'a' => 'Call or message us with your name and address at (248) 525-4715 or metrodetroitholidaylighting@gmail.com. We will schedule a time for Steve to come out for a free estimate and put together a lighting and décor plan for your vision and budget. Photos are helpful but not required.',
    ],
    [
        'q' => 'How much does holiday lighting cost?',
        'a' => 'Every property is custom — roofline length, height, trees, and accents change the scope. We do not publish a one-size price. Call or message with your name and address and Steve will provide a clear quote for your home, business, or HOA.',
    ],
    [
        'q' => 'Are you insured?',
        'a' => 'Yes. Metro Detroit Holiday Lighting is fully insured for residential and commercial holiday lighting installs.',
    ],
    [
        'q' => 'Who does the work?',
        'a' => 'Steve owns the company and does the work himself. You work with him directly from the first quote through final take down.',
    ],
    [
        'q' => 'Who owns the lights, and do you store them?',
        'a' => 'Metro Detroit Holiday Lighting supplies the seasonal lighting and décor materials for your display. Installation, maintenance, take-down, and labeled off-season storage are part of the full-season service — you are not left storing bins in the garage.',
    ],
    [
        'q' => 'What if a strand fails mid-season?',
        'a' => 'Call or text (248) 525-4715. Maintenance is part of the service — if a strand fails or weather knocks something loose, Steve comes back to get the display looking right again.',
    ],
    [
        'q' => 'When should I book?',
        'a' => 'Book in October or early November for the widest install date range. Peak installs fill through fall so displays are ready before Thanksgiving and early December.',
    ],
];

/**
 * Real testimonials only. Leave empty until Steve supplies quotes — the section hides itself.
 * Paste approved quotes from docs/CLIENT-INPUTS.md into this array.
 *
 * @var list<array{quote:string,name:string,detail?:string}>
 */
$testimonials = [];

$gallery_images = mdhl_gallery_images();

/**
 * Homepage scroll-scrub frames (curated night / install sequence).
 * Only frames whose files exist are included.
 *
 * @var list<array{file:string,caption:string,alt:string}>
 */
$scroll_frame_defs = [
    [
        'file' => 'mdhl-bloomfield-hills-7.jpg',
        'caption' => 'Tree wraps and landscape lighting after dark',
        'alt' => 'Bloomfield Hills home with green tree wraps and warm white branch lighting at night',
    ],
    [
        'file' => 'mdhl-bloomfield-hills-8.jpg',
        'caption' => 'Wreaths, steps, and trees lit for the season',
        'alt' => 'Bloomfield Hills brick home with lighted wreaths, step lights, and wrapped trees at night',
    ],
];

$scroll_frames = [];
foreach ($scroll_frame_defs as $frame) {
    $path = dirname(__DIR__) . '/assets/img/gallery/' . $frame['file'];
    if (!is_file($path)) {
        continue;
    }
    $scroll_frames[] = [
        'file' => $frame['file'],
        'url' => mdhl_asset_url('assets/img/gallery/' . $frame['file']),
        'caption' => $frame['caption'],
        'alt' => $frame['alt'],
    ];
}
unset($scroll_frame_defs, $frame, $path);

$hero_image_rel = 'assets/img/gallery/mdhl-bloomfield-hills-8.jpg';
$hero_image_file = dirname(__DIR__) . '/' . $hero_image_rel;
$hero_image = is_file($hero_image_file) ? mdhl_asset_url($hero_image_rel) : '';
$hero_image_alt = 'Bloomfield Hills brick home with wreaths, green tree wraps, and step lights at night';
if ($hero_image === '' && $gallery_images !== []) {
    $hero_image = $gallery_images[0]['url'];
    $hero_image_alt = $gallery_images[0]['alt'];
}

// About section photo — Steve hanging a wreath.
$owner_image_file = dirname(__DIR__) . '/assets/img/gallery/hanging-the-wreath.jpg';
$owner_image = is_file($owner_image_file) ? 'assets/img/gallery/hanging-the-wreath.jpg' : '';
$owner_image_alt = 'Steve hanging a holiday wreath';
