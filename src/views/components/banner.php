<style type="text/css">
    .banner {
        background-image: url('https://images.unsplash.com/photo-1521791136064-7986c2920216');
        background-size: cover;
        background-position: center;
        height: 400px;
        position: relative;
        color: #fff;
    }

    .banner-overlay {
        background: rgba(0, 0, 0, 0.65);
        max-width: 420px;
    }
</style>
<?php if (!empty($banners)): ?>
<!-- Banner -->
<div class="container-fluid p-0">
    <?php foreach ($banners as $course): ?>
        <div class="banner d-flex align-items-center">
            <div class="container">
                <?php if (count($banners) > 1): ?>
                <div class="banner-overlay p-4">
                    <h2 class="fw-bold"><?php echo htmlspecialchars($course['name']); ?></h2>
                    <p class="small">
                        <?php echo htmlspecialchars(substr($course['description'], 0, 120)); ?>...
                    </p>
                    <a href="<?= BASE_URL; ?>/course/<?php echo htmlspecialchars($course['slug']); ?>" class="btn btn-outline-light btn-sm">VER CURSO</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>