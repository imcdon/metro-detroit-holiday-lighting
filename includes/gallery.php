<?php

declare(strict_types=1);

/** Web gallery basenames replaced by mdhl-bloomfield-hills-7/8/9/11 — hide from public index. */
const MDHL_GALLERY_HIDDEN = [
    'mdhl-bloomfield-hills-1.jpg',
    'mdhl-bloomfield-hills-2.jpg',
    'mdhl-bloomfield-hills-3.jpg',
    'mdhl-bloomfield-hills-4.jpg',
];

/**
 * Project-relative asset URL with cache-busting filemtime (gallery, img, etc.).
 */
function mdhl_asset_url(string $rel): string
{
    $rel = ltrim(str_replace('\\', '/', $rel), '/');
    if ($rel === '') {
        return url();
    }
    $base = url($rel);
    $file = dirname(__DIR__) . '/' . $rel;
    if (!is_file($file)) {
        return $base;
    }
    $v = (int) filemtime($file);

    return $base . (str_contains($base, '?') ? '&' : '?') . 'v=' . $v;
}

/**
 * Pixel dimensions for a project-relative image path (e.g. assets/img/gallery/foo.jpg).
 *
 * @return array{width:int,height:int}
 */
function mdhl_image_dimensions_from_rel(string $rel): array
{
    $rel = ltrim(str_replace('\\', '/', $rel), '/');
    if ($rel === '') {
        return ['width' => 0, 'height' => 0];
    }

    $file = dirname(__DIR__) . '/' . $rel;
    if (!is_file($file)) {
        return ['width' => 0, 'height' => 0];
    }

    $size = @getimagesize($file);
    if (!is_array($size) || $size[0] < 1 || $size[1] < 1) {
        return ['width' => 0, 'height' => 0];
    }

    return ['width' => (int) $size[0], 'height' => (int) $size[1]];
}

/**
 * List gallery image files from assets/img/gallery/.
 *
 * @return list<array{file:string,url:string,alt:string}>
 */
function mdhl_gallery_images(): array
{
    $dir = dirname(__DIR__) . '/assets/img/gallery';
    if (!is_dir($dir)) {
        return [];
    }

    $files = scandir($dir) ?: [];
    $out = [];
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }
        if (!preg_match('/\.(jpe?g|png|webp)$/i', $file)) {
            continue;
        }
        if (in_array($file, MDHL_GALLERY_HIDDEN, true)) {
            continue;
        }
        $base = pathinfo($file, PATHINFO_FILENAME);
        $label = ucwords(str_replace(['-', '_'], ' ', $base));
        $fullPath = $dir . DIRECTORY_SEPARATOR . $file;
        $width = 0;
        $height = 0;
        $size = @getimagesize($fullPath);
        if (is_array($size)) {
            $width = (int) $size[0];
            $height = (int) $size[1];
        }
        $orientation = 'landscape';
        if ($width > 0 && $height > 0) {
            if ($height > $width) {
                $orientation = 'portrait';
            } elseif ($width === $height) {
                $orientation = 'square';
            }
        }
        $out[] = [
            'file' => $file,
            'url' => mdhl_asset_url('assets/img/gallery/' . $file),
            'alt' => 'Holiday lighting by Metro Detroit Holiday Lighting — ' . $label,
            'width' => $width,
            'height' => $height,
            'orientation' => $orientation,
        ];
    }

    usort($out, static fn ($a, $b) => strcasecmp($a['file'], $b['file']));

    return $out;
}

/**
 * Filter gallery images whose filenames match any of the given patterns.
 *
 * @param list<string> $patterns PCRE patterns matched against the filename
 * @param int $limit Max images to return (0 = all matches)
 * @return list<array{file:string,url:string,alt:string}>
 */
function mdhl_gallery_for_landing(array $patterns, int $limit = 6): array
{
    if ($patterns === []) {
        return [];
    }

    $matched = [];
    foreach (mdhl_gallery_images() as $img) {
        foreach ($patterns as $pattern) {
            if (@preg_match($pattern, $img['file']) === 1) {
                $matched[] = $img;
                break;
            }
        }
    }

    if ($limit > 0) {
        $matched = array_slice($matched, 0, $limit);
    }

    return $matched;
}

/**
 * Return gallery entries for an ordered list of filenames (skips missing files).
 *
 * @param list<string> $filenames Basenames under assets/img/gallery/
 * @return list<array{file:string,url:string,alt:string,width:int,height:int,orientation:string}>
 */
function mdhl_gallery_pick_files(array $filenames): array
{
    if ($filenames === []) {
        return [];
    }

    $byFile = [];
    foreach (mdhl_gallery_images() as $img) {
        $byFile[$img['file']] = $img;
    }

    $out = [];
    foreach ($filenames as $file) {
        if (isset($byFile[$file])) {
            $out[] = $byFile[$file];
        }
    }

    return $out;
}
