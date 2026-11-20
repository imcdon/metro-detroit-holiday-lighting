<?php
declare(strict_types=1);

$base = dirname(__DIR__);
require $base . '/includes/config.php';

$missing = [];

$check = static function (string $rel) use ($base, &$missing): void {
    $rel = ltrim(str_replace('\\', '/', $rel), '/');
    if ($rel === '' || is_file($base . '/' . $rel)) {
        return;
    }
    $missing[$rel] = true;
    echo "MISSING {$rel}\n";
};

foreach (mdhl_landing_pages() as $slug => $page) {
    if (!empty($page['hero_image'])) {
        $check((string) $page['hero_image']);
    }
    foreach ($page['gallery_files'] ?? [] as $file) {
        $check('assets/img/gallery/' . $file);
    }
    foreach ($page['sections'] ?? [] as $section) {
        if (!empty($section['image'])) {
            $check((string) $section['image']);
        }
    }
}

foreach ($audiences as $audience) {
    if (!empty($audience['image'])) {
        $check((string) $audience['image']);
    }
}

foreach ($scroll_frames as $frame) {
    $check('assets/img/gallery/' . $frame['file']);
}

$check('assets/img/gallery/mdhl-bloomfield-hills-8.jpg');
$check('assets/img/gallery/hanging-the-wreath.jpg');
$check('assets/img/logo-new.png');
$check('assets/img/favicon.png');

// Gallery files that used to exist but may have been deleted (orphans from older names)
foreach ([
    'residential-blue-tree.jpg',
    'wreath-hanging.jpg',
] as $old) {
    if (!is_file($base . '/assets/img/gallery/' . $old)) {
        echo "DELETED_UNREFERENCED assets/img/gallery/{$old}\n";
    }
}

if ($missing === []) {
    echo "No missing referenced assets from config/landings.\n";
} else {
    echo count($missing) . " missing referenced assets.\n";
}
