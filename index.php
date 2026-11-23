<?php
declare(strict_types=1);
require __DIR__ . '/includes/config.php';

$page_title = 'Holiday Lighting & Décor | Metro Detroit Holiday Lighting';
$page_description = $site_description;
$canonical_path = '/';
$schema_home = true;
$schema_faq = true;
$preload_image = $hero_image_rel !== '' ? mdhl_preload_image_url($hero_image_rel, 1280) : null;
if ($preload_image === '') {
    $preload_image = $hero_image !== '' ? $hero_image : null;
}
$body_class = 'page-home';

require __DIR__ . '/includes/header.php';
?>
<section class="hero<?= $hero_image !== '' ? ' hero--photo' : '' ?>">
    <?php if ($hero_image !== ''): ?>
        <div class="hero__media" aria-hidden="true">
            <?= mdhl_picture($hero_image_rel, [
                'alt' => '',
                'sizes' => MDHL_SIZES_HERO,
                'width' => 1600,
                'height' => 900,
                'loading' => '',
                'fetchpriority' => 'high',
                'decoding' => 'async',
                'aria_hidden' => true,
            ]) ?>
        </div>
        <div class="hero__shade" aria-hidden="true"></div>
    <?php endif; ?>
    <div class="hero__content">
        <div class="hero__brand">
            <img class="hero__brand-mark" src="<?= htmlspecialchars(url('assets/img/logo-new.png')) ?>" alt="" width="176" height="176">
            <h1 class="hero__brand-name"><?= htmlspecialchars($site_name) ?></h1>
        </div>
        <p class="hero__lead">Homes, storefronts, and HOA entrances — one expert from design through takedown. <?= (int) $years_experience ?> years experience. Fully insured.</p>
        <div class="hero__actions">
            <a class="btn btn-primary" href="<?= htmlspecialchars($phone_href) ?>">
                <svg class="btn__icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.81.36 1.6.68 2.35a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.75.32 1.54.55 2.35.68A2 2 0 0 1 22 16.92z"/></svg>
                <?= htmlspecialchars($phone) ?>
            </a>
            <a class="btn btn-ghost" href="<?= htmlspecialchars($sms_href) ?>">Text a photo</a>
            <a class="btn btn-ghost" href="<?= htmlspecialchars(url('contact/')) ?>">Request a quote</a>
        </div>
    </div>
</section>

<section class="section section--snow" id="who-we-serve">
    <div class="container">
        <div class="section__head">
            <h2>Who we Decorate</h2>
            <p class="section__lead">Residences, Commercial Properties, Dealerships, and Community entrances – just to name a few.</p>
        </div>
        <div class="audience-stages">
            <?php foreach ($audiences as $audience): ?>
                <?php
                $audienceUrl = !empty($audience['url']) ? url($audience['url']) : '';
                $cardTag = $audienceUrl !== '' ? 'a' : 'article';
                $cardAttrs = $audienceUrl !== ''
                    ? ' href="' . htmlspecialchars($audienceUrl) . '"'
                    : '';
                ?>
                <<?= $cardTag ?> class="audience-stage<?= empty($audience['has_image']) ? ' audience-stage--placeholder' : '' ?>"<?= $cardAttrs ?>>
                    <div class="audience-stage__media" aria-hidden="true">
                        <?php if (!empty($audience['has_image'])): ?>
                            <?= mdhl_picture((string) $audience['image'], [
                                'alt' => '',
                                'sizes' => MDHL_SIZES_CARD,
                                'width' => 1200,
                                'height' => 700,
                                'loading' => 'lazy',
                                'decoding' => 'async',
                                'aria_hidden' => true,
                            ]) ?>
                        <?php endif; ?>
                    </div>
                    <div class="audience-stage__shade" aria-hidden="true"></div>
                    <div class="audience-stage__content">
                        <h3><?= htmlspecialchars($audience['title']) ?></h3>
                        <p><?= htmlspecialchars($audience['body']) ?></p>
                    </div>
                </<?= $cardTag ?>>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php if ($scroll_frames !== []): ?>
<section
    class="scroll-stage"
    id="season"
    data-scroll-stage
    style="--scroll-frames: <?= (int) count($scroll_frames) ?>"
    aria-label="Season lighting gallery"
>
    <div class="scroll-stage__sticky">
        <div class="scroll-stage__frames">
            <?php foreach ($scroll_frames as $i => $frame): ?>
                <div
                    class="scroll-stage__frame<?= $i === 0 ? ' is-active' : '' ?>"
                    data-frame="<?= (int) $i ?>"
                    data-caption="<?= htmlspecialchars($frame['caption'], ENT_QUOTES) ?>"
                >
                    <?= mdhl_picture('assets/img/gallery/' . $frame['file'], [
                        'alt' => $frame['alt'],
                        'sizes' => MDHL_SIZES_SCROLL,
                        'width' => 1600,
                        'height' => 900,
                        'loading' => $i === 0 ? '' : 'lazy',
                        'fetchpriority' => $i === 0 ? 'high' : '',
                        'decoding' => 'async',
                    ]) ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="scroll-stage__shade" aria-hidden="true"></div>
        <div class="scroll-stage__ui">
            <div class="scroll-stage__ui-inner">
                <p class="scroll-stage__kicker">Decorations that shine at night</p>
                <p class="scroll-stage__caption" data-scroll-caption><?= htmlspecialchars($scroll_frames[0]['caption']) ?></p>
                <div class="scroll-stage__dots" role="presentation">
                    <?php foreach ($scroll_frames as $i => $_frame): ?>
                        <span class="scroll-stage__dot<?= $i === 0 ? ' is-active' : '' ?>" data-dot="<?= (int) $i ?>"></span>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="section section--pine" id="process">
    <div class="container">
        <div class="section__head">
            <h2>Seamless Holiday Lighting & Décor</h2>
            <p class="section__lead">From the first connection to final take down, the process stays simple.</p>
        </div>
        <div class="process">
            <?php foreach ($process_steps as $i => $step): ?>
                <article class="process-step">
                    <div class="process-step__num" aria-hidden="true"><?= $i + 1 ?></div>
                    <div>
                        <h3><?= htmlspecialchars($step['title']) ?></h3>
                        <p><?= htmlspecialchars($step['body']) ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section" id="about">
    <div class="container owner">
        <div class="owner__copy">
            <p class="eyebrow">Owner-operated</p>
            <h2><?= (int) $years_experience ?> years of Metro Detroit installs</h2>
            <p class="section__lead">Fully insured, with 2 decades of experience, from custom design to installation, maintenance, take down and storage – he handles everything, to ensure your display looks sharp for the whole season.</p>
            <p>
                <a class="btn btn-primary" href="<?= htmlspecialchars($phone_href) ?>"><?= htmlspecialchars($phone) ?></a>
                <a class="btn btn-ghost" href="<?= htmlspecialchars($sms_href) ?>">Text a photo</a>
            </p>
        </div>
        <div class="owner__photo<?= $owner_image === '' ? ' owner__photo--empty' : '' ?>">
            <?php if ($owner_image !== ''): ?>
                <?= mdhl_picture($owner_image, [
                    'alt' => $owner_image_alt,
                    'sizes' => MDHL_SIZES_SECTION,
                    'width' => 900,
                    'height' => 1100,
                    'loading' => 'lazy',
                    'decoding' => 'async',
                ]) ?>
            <?php else: ?>
                <div class="owner__photo-placeholder" aria-hidden="true"></div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php if ($testimonials !== []): ?>
<section class="section section--snow section--tight" id="testimonials">
    <div class="container">
        <div class="section__head">
            <h2>What clients say</h2>
        </div>
        <div class="testimonials">
            <?php foreach ($testimonials as $t): ?>
                <blockquote class="testimonial">
                    <p>“<?= htmlspecialchars($t['quote']) ?>”</p>
                    <footer>
                        — <?= htmlspecialchars($t['name']) ?>
                        <?php if (!empty($t['detail'])): ?>
                            · <?= htmlspecialchars($t['detail']) ?>
                        <?php endif; ?>
                    </footer>
                </blockquote>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="section section--snow" id="faq">
    <div class="container">
        <div class="section__head">
            <h2>FAQ</h2>
        </div>
        <div class="faq-list">
            <?php foreach ($faq_items as $i => $item): ?>
                <div class="faq-item">
                    <button type="button" aria-expanded="false" id="faq-btn-<?= $i ?>"><?= htmlspecialchars($item['q']) ?></button>
                    <div><?= htmlspecialchars($item['a']) ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section" id="quote">
    <div class="container">
        <div class="cta-band">
            <h2>Ready for a Free Quote?</h2>
            <p>Call or message us today and we will come out and do a free estimate. Steve designs, quotes, and installs to ensure a seamless experience from start to finish.</p>
            <div class="cta-band__actions">
                <a class="btn btn-primary" href="<?= htmlspecialchars($sms_href) ?>">Text a photo</a>
                <a class="btn btn-ghost" href="<?= htmlspecialchars($phone_href) ?>"><?= htmlspecialchars($phone) ?></a>
                <a class="btn btn-ghost" href="<?= htmlspecialchars($email_href) ?>"><?= htmlspecialchars($email) ?></a>
                <a class="btn btn-ghost" href="<?= htmlspecialchars(url('contact/')) ?>">Contact form</a>
            </div>
        </div>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
