<?php

declare(strict_types=1);

/** Basenames excluded from the public gallery index / match strips (empty = show all). */
const MDHL_GALLERY_HIDDEN = [];

/** Responsive sizes presets for mdhl_picture(). */
const MDHL_SIZES_HERO = '(max-width: 768px) 100vw, 1280px';
const MDHL_SIZES_SECTION = '(max-width: 900px) 100vw, 640px';
const MDHL_SIZES_CARD = '(max-width: 900px) 100vw, 400px';
const MDHL_SIZES_GALLERY = '(max-width: 600px) 50vw, 400px';
const MDHL_SIZES_SCROLL = '100vw';

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
 * @return array<string, array<string, mixed>>
 */
function mdhl_variants_manifest(): array
{
    static $cache = null;
    if (is_array($cache)) {
        return $cache;
    }

    $path = dirname(__DIR__) . '/assets/img/gallery/.variants-manifest.json';
    if (!is_file($path)) {
        $cache = [];
        return $cache;
    }

    $raw = file_get_contents($path);
    if ($raw === false || $raw === '') {
        $cache = [];
        return $cache;
    }

    $decoded = json_decode($raw, true);
    $cache = is_array($decoded) ? $decoded : [];

    return $cache;
}

/**
 * Best WebP (or JPEG fallback) URL for preload / LCP near $preferWidth.
 */
function mdhl_preload_image_url(string $rel, int $preferWidth = 1280): string
{
    $rel = ltrim(str_replace('\\', '/', $rel), '/');
    if ($rel === '') {
        return '';
    }

    $basename = basename($rel);
    $entry = mdhl_variants_manifest()[$basename] ?? null;
    if (!is_array($entry)) {
        return is_file(dirname(__DIR__) . '/' . $rel) ? mdhl_asset_url($rel) : '';
    }

    $variants = $entry['variants'] ?? [];
    if (!is_array($variants) || $variants === []) {
        return mdhl_asset_url($rel);
    }

    $best = null;
    $bestDelta = PHP_INT_MAX;
    foreach ($variants as $variant) {
        if (!is_array($variant) || ($variant['format'] ?? '') !== 'webp') {
            continue;
        }
        $w = (int) ($variant['width'] ?? 0);
        $file = (string) ($variant['file'] ?? '');
        if ($w < 1 || $file === '') {
            continue;
        }
        $delta = abs($w - $preferWidth);
        if ($delta < $bestDelta) {
            $bestDelta = $delta;
            $best = $file;
        }
    }

    if ($best === null) {
        return mdhl_asset_url($rel);
    }

    $dir = dirname($rel);
    $webpRel = ($dir === '.' ? '' : $dir . '/') . $best;

    return mdhl_asset_url($webpRel);
}

/**
 * Emit a responsive <picture> (WebP srcset + JPEG fallback) when variants exist.
 *
 * @param array{
 *   alt?:string,
 *   sizes?:string,
 *   class?:string,
 *   width?:int,
 *   height?:int,
 *   loading?:string,
 *   fetchpriority?:string,
 *   decoding?:string,
 *   aria_hidden?:bool
 * } $opts
 */
function mdhl_picture(string $rel, array $opts = []): string
{
    $rel = ltrim(str_replace('\\', '/', $rel), '/');
    if ($rel === '' || !is_file(dirname(__DIR__) . '/' . $rel)) {
        return '';
    }

    $alt = (string) ($opts['alt'] ?? '');
    $sizes = (string) ($opts['sizes'] ?? MDHL_SIZES_SECTION);
    $class = (string) ($opts['class'] ?? '');
    $loading = (string) ($opts['loading'] ?? 'lazy');
    $decoding = (string) ($opts['decoding'] ?? 'async');
    $fetchpriority = (string) ($opts['fetchpriority'] ?? '');
    $ariaHidden = !empty($opts['aria_hidden']);

    $dims = mdhl_image_dimensions_from_rel($rel);
    $width = (int) ($opts['width'] ?? $dims['width'] ?: 0);
    $height = (int) ($opts['height'] ?? $dims['height'] ?: 0);

    $basename = basename($rel);
    $entry = mdhl_variants_manifest()[$basename] ?? null;
    $webpSrcset = '';
    if (is_array($entry) && !empty($entry['variants']) && is_array($entry['variants'])) {
        $parts = [];
        $dir = dirname($rel);
        foreach ($entry['variants'] as $variant) {
            if (!is_array($variant) || ($variant['format'] ?? '') !== 'webp') {
                continue;
            }
            $w = (int) ($variant['width'] ?? 0);
            $file = (string) ($variant['file'] ?? '');
            if ($w < 1 || $file === '') {
                continue;
            }
            $webpRel = ($dir === '.' ? '' : $dir . '/') . $file;
            if (!is_file(dirname(__DIR__) . '/' . $webpRel)) {
                continue;
            }
            $parts[] = mdhl_asset_url($webpRel) . ' ' . $w . 'w';
        }
        $webpSrcset = implode(', ', $parts);
        if ($width < 1 && isset($entry['width'])) {
            $width = (int) $entry['width'];
        }
        if ($height < 1 && isset($entry['height'])) {
            $height = (int) $entry['height'];
        }
    }

    $imgAttrs = [
        'src="' . htmlspecialchars(mdhl_asset_url($rel)) . '"',
        'alt="' . htmlspecialchars($alt) . '"',
    ];
    if ($width > 0) {
        $imgAttrs[] = 'width="' . $width . '"';
    }
    if ($height > 0) {
        $imgAttrs[] = 'height="' . $height . '"';
    }
    if ($class !== '') {
        $imgAttrs[] = 'class="' . htmlspecialchars($class) . '"';
    }
    if ($loading !== '') {
        $imgAttrs[] = 'loading="' . htmlspecialchars($loading) . '"';
    }
    if ($decoding !== '') {
        $imgAttrs[] = 'decoding="' . htmlspecialchars($decoding) . '"';
    }
    if ($fetchpriority !== '') {
        $imgAttrs[] = 'fetchpriority="' . htmlspecialchars($fetchpriority) . '"';
    }
    if ($ariaHidden) {
        $imgAttrs[] = 'aria-hidden="true"';
    }

    if ($webpSrcset === '') {
        return '<img ' . implode(' ', $imgAttrs) . '>';
    }

    $imgAttrs[] = 'sizes="' . htmlspecialchars($sizes) . '"';

    return '<picture>'
        . '<source type="image/webp" srcset="' . htmlspecialchars($webpSrcset) . '" sizes="' . htmlspecialchars($sizes) . '">'
        . '<img ' . implode(' ', $imgAttrs) . '>'
        . '</picture>';
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
        // Primary gallery items are JPEG/PNG only; skip WebP width variants.
        if (!preg_match('/\.(jpe?g|png)$/i', $file)) {
            continue;
        }
        if (preg_match('/-\d+w\.(jpe?g|png)$/i', $file)) {
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
            'rel' => 'assets/img/gallery/' . $file,
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
