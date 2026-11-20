<?php

declare(strict_types=1);

/**
 * SEO landing page definitions for Metro Detroit Holiday Lighting.
 *
 * @return array<string, array<string, mixed>>
 */
function mdhl_landing_pages(): array
{
    return [
        'homeowners' => [
            'nav_label' => 'Homeowners',
            'nav_group' => 'audience',
            'title' => 'Residential Holiday Lighting & Décor | Metro Detroit',
            'description' => 'Residential holiday lighting—rooflines, tree wraps, greenery & walks. Oakland, Wayne, Macomb & Genesee. Owner-operated. Free quote. (248) 525-4715.',
            'h1' => 'Residential holiday lighting and décor for Metro Detroit homeowners',
            'intro' => 'Metro Detroit Holiday Lighting provides professional holiday décor installation across the region. From clean lit rooflines, to branch wrapped trees and greenery – we can bring your holiday vision to life. Let us brighten up your holidays and take the stress out of reaching those tall trees and peaks.',
            'hero_image' => 'assets/img/gallery/residential-08-clark-white-tree.jpg',
            'hero_alt' => 'Residential home with white holiday tree lighting',
            'service_name' => 'Residential holiday lighting and décor',
            'gallery_heading' => 'Residential Installs',
            'gallery_match' => ['/^residential-/i'],
            'gallery_files' => [
                'residential-01-birchwood-all-white-house-tree.jpg',
                'residential-08-clark-white-tree.jpg',
                'residential-07-birchwood-white-tree-snow.jpg',
                'residential-03-birchwood-multicolor-tree.jpg',
                'residential-16-small-house-roof-wreath-bush.jpg',
                'residential-19-white-bushes-and-roof.jpg',
            ],
            'related' => ['wreaths', 'tree-wraps', 'high-roof-lighting'],
            'sections' => [
                [
                    'h2' => 'Residential Holiday Lighting installation that fits your home',
                    'body' => 'Every house is different. Steve designs a custom display specific to your home and budget. We use only commercial grade products designed to withstand the elements of Michigan winters – ensuring your display shines bright all season long.',
                    'bullets' => [
                        'Custom lit Roof lines',
                        'Branch or canopy wrapped trees',
                        'Artificial lit greenery',
                        'Walkways and entrances',
                    ],
                    'image' => 'assets/img/gallery/residential-01-birchwood-all-white-house-tree.jpg',
                    'image_alt' => 'Metro Detroit home with white holiday lights on the house and trees',
                ],
                [
                    'h2' => 'Holiday Light installers Metro Detroit homeowners can trust',
                    'body' => 'Steve works with you directly from the first quote to the final take down instilling an “owners touch” on every job he takes on.',
                    'image' => 'assets/img/gallery/hanging-the-wreath.jpg',
                    'image_alt' => 'Steve installing holiday décor on a Metro Detroit home',
                    'image_fit' => 'natural',
                ],
                [
                    'h2' => 'Service across Oakland, Wayne, Macomb, and Genesee County',
                    'body' => 'We install holiday lighting for homes throughout southeastern Michigan—including Birmingham, Troy, Rochester Hills, Waterford, Clarkston, and neighboring Oakland communities, plus Genesee County cities such as Grand Blanc, Fenton, Flint, and Davison. Browse Service Areas for your city or call (248) 525-4715.',
                    'image' => 'assets/img/gallery/residential-07-birchwood-white-tree-snow.jpg',
                    'image_alt' => 'Residential holiday lighting glowing in Michigan snow',
                ],
            ],
            'faq' => [
                [
                    'q' => 'Who installs holiday lighting and décor on houses in Metro Detroit?',
                    'a' => 'Metro Detroit Holiday Lighting — Steve designs and installs residential holiday lighting and décor across Oakland, Wayne, Macomb, and Genesee County. Call or message (248) 525-4715 with your name and address to schedule a free on-site estimate.',
                ],
                [
                    'q' => 'Do you offer holiday lighting installation in Troy, Rochester Hills, or Birmingham?',
                    'a' => 'Yes. Troy, Rochester Hills, Birmingham, Waterford, and Clarkston are in our Oakland service area; Fenton, Grand Blanc, Flint, and Davison are among our Genesee County pages. Browse Service Areas or call (248) 525-4715 to confirm your neighborhood.',
                ],
                [
                    'q' => 'Is this seasonal lighting or permanent holiday lighting?',
                    'a' => 'We specialize in seasonal full-service holiday lighting and décor: custom design, installation, maintenance, take-down, and storage. Ask Steve if you have questions about permanent vs seasonal holiday lighting options for your home.',
                ],
                [
                    'q' => 'How much does residential holiday lighting cost?',
                    'a' => 'Pricing is custom based on roofline, height, trees, and accents. We do not publish a one-size residential price. Call or message with your name and address and Steve will provide a clear quote after a free estimate visit.',
                ],
            ],
        ],

        'businesses' => [
            'nav_label' => 'Businesses',
            'nav_group' => 'audience',
            'title' => 'Commercial Holiday Lighting Metro Detroit | Businesses',
            'description' => 'Commercial holiday lighting for storefronts, offices & dealerships. Insured; Steve does the work. Oakland, Wayne, Macomb & Genesee. Free quote. (248) 525-4715.',
            'h1' => 'Commercial holiday lighting and décor for Metro Detroit businesses',
            'intro' => 'Stand out this season with commercial holiday light installation that looks sharp from the curb. Metro Detroit Holiday Lighting delivers commercial holiday lighting Metro Detroit businesses rely on — storefronts, offices, restaurants, and dealerships included.',
            'hero_image' => 'assets/img/audiences/businesses.jpg',
            'hero_alt' => 'Commercial storefront with professional holiday lighting',
            'service_name' => 'Commercial holiday lighting and décor',
            'gallery_heading' => 'Commercial Installations',
            'gallery_match' => ['/^commercial-/i'],
            'related' => ['wreaths', 'hoa-property-managers', 'tree-wraps'],
            'sections' => [
                [
                    'h2' => 'Business holiday light installation that stays maintained',
                    'body' => 'We decorate storefronts, office buildings, restaurants, dealerships and more. Displays look intentional after dark and stay maintained through the whole season.',
                    'bullets' => [
                        'Storefront and canopy lighting',
                        'Dealership roof and tree packages',
                        'Shopping Center roof lines',
                        'Office and retail entrance greenery',
                    ],
                    'image' => 'assets/img/gallery/commercial-01-blue-roof-gmc.jpg',
                    'image_alt' => 'Commercial dealership building with blue holiday roof lighting',
                ],
                [
                    'h2' => 'Insured commercial holiday light installation',
                    'body' => 'Steve owns the company and does the work himself.',
                    'image' => 'assets/img/gallery/brand-trailer-side.jpg',
                    'image_alt' => 'Metro Detroit Holiday Lighting service trailer on site',
                ],
                [
                    'h2' => 'Commercial Holiday light installers for the Tri-County area and beyond',
                    'body' => 'We serve businesses across Oakland, Macomb, Wayne and Genesee counties. Call us today for a free quote.',
                    'image' => 'assets/img/gallery/commercial-05-dealership-trees.jpg',
                    'image_alt' => 'Dealership lot trees wrapped with holiday lights',
                ],
            ],
            'faq' => [
                [
                    'q' => 'Do you install dealership holiday lights and shopping center displays?',
                    'a' => 'Yes. Dealership lots, shopping centers, and multi-tenant entrances are common commercial projects. Call or message with your business name and address — Steve will visit for a free estimate and plan access and scope with you.',
                ],
                [
                    'q' => 'Are you insured for commercial holiday lighting?',
                    'a' => 'Yes. We carry insurance for commercial holiday light installation on business properties across Oakland, Macomb, Wayne, and Genesee counties.',
                ],
                [
                    'q' => 'How much does commercial holiday lighting cost?',
                    'a' => 'Commercial pricing is custom — building size, height, trees, and access change the scope. We do not publish a one-size commercial price. Call or message with your name and address for a free estimate and a clear quote.',
                ],
                [
                    'q' => 'How do businesses get a quote?',
                    'a' => 'Call or message us at (248) 525-4715 or metrodetroitholidaylighting@gmail.com with your name and address. We schedule a time for Steve to come out for a free estimate. Photos are helpful but not required.',
                ],
            ],
        ],

        'hoa-property-managers' => [
            'nav_label' => 'HOAs & Property Managers',
            'nav_group' => 'audience',
            'title' => 'HOA Holiday Lighting & Décor Metro Detroit | HOAs',
            'description' => 'HOA & community holiday lighting—entrances, clubhouses & common areas. Insured, owner-operated. Four-county Metro Detroit. Free quote. (248) 525-4715.',
            'h1' => 'HOA and community holiday lighting and décor',
            'intro' => 'Associations and managers need one reliable partner for HOA holiday light installation. Metro Detroit Holiday Lighting handles community entrances, clubhouses, and shared space.',
            'hero_image' => 'assets/img/gallery/commercial-07-how-entrance.jpg',
            'hero_alt' => 'Community entrance with professional holiday lighting',
            'service_name' => 'HOA and community holiday lighting',
            'gallery_heading' => 'Recent HOA and Community Installations',
            'gallery_match' => ['/entrance/i', '/wreath/i', '/commercial-07/i', '/commercial-09/i', '/commercial-03/i'],
            'related' => ['businesses', 'wreaths', 'tree-wraps'],
            'sections' => [
                [
                    'h2' => 'Property Manager holiday lighting with one clear plan',
                    'body' => 'Boards and property managers receive a seamless scope of work to include subdivision entrance lights, sign and lamp post décor, clubhouse lighting and more.',
                    'bullets' => [
                        'Branch or canopy wrapped trees',
                        'Artificial lit greenery on signs and lamp posts',
                        'Clubhouse roof lighting',
                        'Walkway lighting',
                    ],
                    'image' => 'assets/img/gallery/commercial-07-how-entrance.jpg',
                    'image_alt' => 'Community entrance with professional holiday lighting',
                ],
                [
                    'h2' => 'Why HOAs pick an owner-operated crew',
                    'body' => 'Residents and boards want accountability, not a rotating cast of subcontractors. Steve designs the entrance and shared-space plan, installs it, answers mid-season calls himself, and returns for take-down and labeled storage — one vendor, one phone number, one invoice trail.',
                    'bullets' => [
                        'from quote through take down',
                        'Fully insured to meet association and management company requirements',
                        'Entrance and clubhouse work timed around gate codes and access windows',
                        'No board members on ladders or chasing burned-out strands',
                    ],
                    'image' => 'assets/img/gallery/high-roof-01-gutter-install.jpg',
                    'image_alt' => 'Steve installing holiday lighting for a community property',
                ],
                [
                    'h2' => 'Holiday light installers, Metro Detroit HOA\'s trust',
                    'body' => 'From Oakland County subdivisions to Macomb and Wayne condos, all the way to Genesee county neighborhoods, Steve designs displays that will brighten your community for the holidays!',
                    'image' => 'assets/img/gallery/commercial-03-building-entrance-wreath.jpg',
                    'image_alt' => 'Building entrance with holiday wreath and lighting',
                ],
            ],
            'faq' => [
                [
                    'q' => 'Can you light entrance monuments for the holidays in Michigan?',
                    'a' => 'Yes. Entrance monument lighting and décor for holiday displays is a core part of our HOA work — subdivision entrances, signs, lamp posts, and gate features included.',
                ],
                [
                    'q' => 'Do you work with Property Managers and board presidents?',
                    'a' => 'Yes. We coordinate with Property Managers and boards on scope, approvals, and site access so install day stays organized from quote through take down.',
                ],
                [
                    'q' => 'Who do we call if lights fail mid-season?',
                    'a' => 'Call or text (248) 525-4715. Maintenance is part of the HOA service — Steve handles the repair instead of routing tickets through a large crew.',
                ],
                [
                    'q' => 'How do HOAs and Property Managers get a quote?',
                    'a' => 'Call or message (248) 525-4715 or metrodetroitholidaylighting@gmail.com with the community name and address. We schedule a site visit for a free estimate. Note entrances, clubhouse, and common areas you want lit, plus your preferred switch-on date. Photos are helpful but not required.',
                ],
            ],
        ],

        'wreaths' => [
            'nav_label' => 'Wreaths',
            'nav_group' => 'specialty',
            'title' => 'Holiday Wreath Installation Service Metro Detroit',
            'description' => 'Holiday wreath hanging & lighted garland for Metro Detroit homes and businesses. Installed by Steve. (248) 525-4715.',
            'h1' => 'Holiday wreath installation service in Metro Detroit',
            'intro' => 'Need a holiday wreath installation service that looks finished from the street? Metro Detroit Holiday Lighting offers holiday wreath hanging service and lighted wreath installation for doors, porches, and building entrances across southeastern Michigan.',
            'hero_image' => 'assets/img/gallery/wreath-03-lit-gable.jpg',
            'hero_alt' => 'Lighted holiday wreath with red bow on a high brick gable',
            'service_name' => 'Holiday wreath and garland installation',
            'gallery_match' => ['/^wreath-/i', '/wreath/i', '/garland/i'],
            'gallery_files' => [
                'wreath-01-peak-install.jpg',
                'high-roof-05-peak-lights-wreath.jpg',
                'high-roof-03-ladder-ascent.jpg',
                'wreath-03-lit-gable.jpg',
                'wreath-02-ladder-hang.jpg',
                'high-roof-04-gable-ladder.jpg',
            ],
            'related' => ['homeowners', 'businesses', 'hoa-property-managers'],
            'sections' => [
                [
                    'h2' => 'Front door wreath installation and porch accents',
                    'body' => 'From a single front door wreath installation to matching pairs on a two-story facade, Steve sizes and mounts wreaths so they hang level and stay secure through wind and snow.',
                    'bullets' => [
                        'Lighted wreath installation with clean power routing',
                        'Holiday garland installation for front porch rails and columns',
                        'Custom holiday wreaths Metro Detroit homes and businesses can coordinate with roof and tree lighting',
                    ],
                    'image' => 'assets/img/gallery/wreath-01-peak-install.jpg',
                    'image_alt' => 'Steve hanging a large holiday wreath with red bow on a high peak',
                    'image_fit' => 'natural',
                ],
                [
                    'h2' => 'Commercial wreath and garland for entrances',
                    'body' => 'Offices and storefronts often need commercial wreath and garland that match brand colors and building scale. We hang building entrance wreath and garland displays that photograph well for daytime and glow after dark.',
                    'image' => 'assets/img/gallery/high-roof-05-peak-lights-wreath.jpg',
                    'image_alt' => 'Lighted wreath on a brick gable with roofline holiday lights',
                    'image_fit' => 'natural',
                ],
                [
                    'h2' => 'Professional wreath hanging near you',
                    'body' => 'Serving Oakland, Wayne, and Macomb County. Whether you need professional wreath hanging near me for a residential porch or to install a wreath on a second story entrance, we bring the gear and leave the facade clean.',
                    'image' => 'assets/img/gallery/high-roof-03-ladder-ascent.jpg',
                    'image_alt' => 'Installer on a ladder for second-story wreath and roof lighting',
                    'image_fit' => 'natural',
                ],
            ],
            'faq' => [
                [
                    'q' => 'Can you install a wreath on a second-story entrance?',
                    'a' => 'Yes. Second-story and tall entrance wreaths are routine when paired with proper mounting. Mention height when you send photos.',
                ],
                [
                    'q' => 'Do wreaths come with lights?',
                    'a' => 'We can install lighted wreaths or hang your preferred style. Ask about lighted wreath installation when you request a quote.',
                ],
                [
                    'q' => 'Can wreaths be part of a full lighting package?',
                    'a' => 'Absolutely. Many homeowners and businesses combine wreaths with rooflines, garland, and trees for a complete holiday look.',
                ],
            ],
        ],

        'tree-wraps' => [
            'nav_label' => 'Tree wraps',
            'nav_group' => 'specialty',
            'title' => 'Branch Wrap Tree Lights Metro Detroit | Tree Wrapping',
            'description' => 'Branch wrap tree lights and outdoor tree light wrapping in Metro Detroit. Professional holiday tree wrapping for landscape trees. Call (248) 525-4715.',
            'h1' => 'Branch wrap tree lights for Metro Detroit landscapes',
            'intro' => 'Transform trunks and canopies with branch wrap tree lights installed the professional way. Metro Detroit Holiday Lighting specializes in holiday tree wrapping service and outdoor tree light wrapping that looks dense, even, and built for Michigan winters.',
            'hero_image' => 'assets/img/gallery/residential-03-birchwood-multicolor-tree.jpg',
            'hero_alt' => 'Outdoor tree wrapped with professional holiday lights',
            'service_name' => 'Branch wrap tree lighting',
            'gallery_match' => ['/tree/i'],
            'related' => ['homeowners', 'businesses', 'wreaths'],
            'sections' => [
                [
                    'h2' => 'Branch wrap tree lights for landscape trees',
                    'body' => 'Branch wrapping outdoor trees is more than tossing strands into the canopy. Steve wraps limbs and trunks so light coverage stays consistent from the ground up — ideal for front-yard specimens and commercial landscaping.',
                    'bullets' => [
                        'Branch wrap tree lights on deciduous and evergreen trees',
                        'Trunk wrap tree lights for strong vertical glow',
                        'Large tree holiday lights installation with secure routing',
                        'Landscape tree holiday lighting that pairs with rooflines and walks',
                    ],
                    'image' => 'assets/img/gallery/residential-02-birchwood-blue-tree.jpg',
                    'image_alt' => 'Landscape tree wrapped with blue holiday lights',
                ],
                [
                    'h2' => 'Professional tree lighting installation',
                    'body' => 'Whether you want warm white, cool white, or color, we wrap trees with holiday lights sized for the canopy. Professional tree lighting installation means clean power plans, tidy connections, and displays that still look sharp after a snowstorm.',
                    'image' => 'assets/img/gallery/residential-13-red-trees.jpg',
                    'image_alt' => 'Front-yard trees wrapped with red holiday lights',
                ],
                [
                    'h2' => 'Branch wrap tree lights Metro Detroit and Oakland County',
                    'body' => 'Homeowners and businesses across southeastern Michigan book tree wrap holiday lights Oakland County and neighboring counties trust. From single statement trees to rows of lot trees, ask Steve how to decorate large trees with professional installers on your timeline.',
                    'image' => 'assets/img/gallery/commercial-05-dealership-trees.jpg',
                    'image_alt' => 'Row of professionally wrapped holiday trees',
                ],
            ],
            'faq' => [
                [
                    'q' => 'How much does it cost to wrap outdoor trees with lights?',
                    'a' => 'Pricing depends on tree height, branch density, and how many trees you want wrapped. Send photos and approximate heights to (248) 525-4715 for a clear estimate.',
                ],
                [
                    'q' => 'Do you wrap trunks only or full branch wraps?',
                    'a' => 'Both. Many clients choose trunk wrap tree lights for a clean look; others prefer full branch wrap tree lights for a richer canopy glow.',
                ],
                [
                    'q' => 'Can tree wraps be combined with roof lighting?',
                    'a' => 'Yes. Tree wraps often complete a residential or commercial package alongside rooflines, wreaths, and walk lighting.',
                ],
            ],
        ],

        'high-roof-lighting' => [
            'nav_label' => 'High roofs',
            'nav_group' => 'specialty',
            'title' => 'High Roof Holiday Light Installation Metro Detroit',
            'description' => 'High roof holiday light installation and steep roof holiday lighting in Metro Detroit. Insured tall roofline holiday lights by Steve. Call (248) 525-4715.',
            'h1' => 'High roof holiday light installation in Metro Detroit',
            'intro' => 'Steep pitches and tall peaks are not DIY projects. Metro Detroit Holiday Lighting handles high roof holiday light installation and steep roof holiday lighting with the right equipment — so your tall roofline holiday lights look sharp without putting your household on a ladder.',
            'hero_image' => 'assets/img/gallery/high-roof-01-gutter-install.jpg',
            'hero_alt' => 'Steve installing holiday lights on a high residential gutter',
            'service_name' => 'High and steep roof holiday lighting',
            'gallery_match' => ['/^high-roof-/i', '/roof/i', '/rood/i', '/height/i'],
            'gallery_files' => [
                'high-roof-01-gutter-install.jpg',
                'high-roof-02-gutter-corner.jpg',
                'high-roof-03-ladder-ascent.jpg',
                'high-roof-04-gable-ladder.jpg',
                'high-roof-05-peak-lights-wreath.jpg',
                'wreath-01-peak-install.jpg',
            ],
            'related' => ['homeowners', 'tree-wraps', 'wreaths'],
            'sections' => [
                [
                    'h2' => 'Two story house holiday lights installation',
                    'body' => 'Two story house holiday lights installation needs secure clips, careful peak work, and clean lines along high gutters. We plan each run so holiday lights on high gutters stay tight through wind and ice.',
                    'bullets' => [
                        'Peak roof holiday lighting on steep gables',
                        'Tall fascia and gutter runs',
                        'Insured high roof light installers Michigan homeowners can trust',
                        'Take-down handled the same careful way in the spring',
                    ],
                    'image' => 'assets/img/gallery/high-roof-04-gable-ladder.jpg',
                    'image_alt' => 'Tall gable with ladder and holiday lights on a brick home',
                    'image_fit' => 'natural',
                ],
                [
                    'h2' => 'Skip dangerous roof holiday lights DIY',
                    'body' => 'If a roof feels too high or too steep, hire a professional. Dangerous roof holiday lights are a leading winter injury risk. Steve brings the experience for two story roofline lighting Metro Detroit homes need — without you climbing.',
                    'image' => 'assets/img/gallery/high-roof-03-ladder-ascent.jpg',
                    'image_alt' => 'Installer ascending an extension ladder for high roof holiday lighting',
                    'image_fit' => 'natural',
                ],
                [
                    'h2' => 'Holiday light installation without the ladder hassle',
                    'body' => 'Looking for holiday light installation without ladder service at your house? Send elevation photos and note any tricky peaks. We quote high-roof work across Oakland, Wayne, and Macomb County and schedule installs before peak season fills.',
                    'image' => 'assets/img/gallery/high-roof-02-gutter-corner.jpg',
                    'image_alt' => 'Professional clipping holiday lights along a high gutter corner',
                ],
            ],
            'faq' => [
                [
                    'q' => 'Do you install lights on steep or tall roofs?',
                    'a' => 'Yes. High roof and steep roof holiday lighting is a core service. Share photos so Steve can assess access and pitch.',
                ],
                [
                    'q' => 'Are you insured for high-roof work?',
                    'a' => 'Yes. We are insured high roof light installers serving Michigan homes and buildings in Metro Detroit.',
                ],
                [
                    'q' => 'Can high-roof lighting include wreaths or trees?',
                    'a' => 'Yes. Many packages combine tall rooflines with wreaths, garland, and tree wraps for a complete display.',
                ],
            ],
        ],
    ];
}

/**
 * @return array<string, mixed>|null
 */
function mdhl_landing_by_slug(string $slug): ?array
{
    $pages = mdhl_landing_pages();
    return $pages[$slug] ?? null;
}

/**
 * Nav items for a landing-page group: label => path relative to site root.
 *
 * @return array<string, string>
 */
function mdhl_nav_for_group(string $group): array
{
    $out = [];
    foreach (mdhl_landing_pages() as $slug => $page) {
        if (($page['nav_group'] ?? '') !== $group) {
            continue;
        }
        $out[$page['nav_label']] = $slug . '/';
    }
    return $out;
}

/**
 * Nav items for Services dropdown (audience landings).
 *
 * @return array<string, string>
 */
function mdhl_audience_nav(): array
{
    return mdhl_nav_for_group('audience');
}

/**
 * Nav items for Specialties dropdown (specialty landings).
 *
 * @return array<string, string>
 */
function mdhl_specialty_nav(): array
{
    return mdhl_nav_for_group('specialty');
}
