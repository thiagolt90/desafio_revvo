<?php if (!empty($banners)): ?>
<!-- Banner -->
<div id="dr-main-banner" class="carousel slide" data-bs-ride="carousel">
    <?php if (count($banners) > 1): ?>
    <div class="carousel-indicators">
        <div class="carousel-indicators-box">
            <?php for ($i = 0; $i < count($banners); $i ++): ?>
                <button type="button" data-bs-target="#dr-main-banner" data-bs-slide-to="<?= $i; ?>" <?= ($i == 0) ? "class=\"active\"" : ""?> aria-current="true" aria-label="<?= htmlspecialchars($banners[$i]['name']); ?>"></button>
            <?php endfor; ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="carousel-inner">
        <?php for ($i = 0; $i < count($banners); $i ++): ?>
            <div class="carousel-item <?= ($i == 0) ? "active" : ""?>">
                <div class="dr-banner d-flex align-items-center" style="background-image: url(<?= BASE_URL . "/uploads/" . htmlspecialchars($banners[$i]['picture']); ?>);">
                    <?php if ($isHome): ?>
                    <div class="container">
                        <div class="dr-banner-overlay p-4">
                            <h2 class="fw-bold"><?= htmlspecialchars($banners[$i]['name']); ?></h2>
                            <p class="small">
                                <?= htmlspecialchars(substr($banners[$i]['description'], 0, 120)); ?>...
                            </p>
                            <a href="<?= BASE_URL; ?>/course/<?= htmlspecialchars($banners[$i]['slug']); ?>" class="btn btn-outline-light btn-sm dr-show-course">VER CURSO</a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endfor; ?>
    </div>

    <?php if (count($banners) > 1): ?>
    <button class="carousel-control-prev" type="button" data-bs-target="#dr-main-banner" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#dr-main-banner" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Próximo</span>
    </button>
    <?php endif; ?>
</div>
<?php endif; ?>