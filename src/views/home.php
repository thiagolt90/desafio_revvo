<?php require_once '../src/views/components/banner.php'; ?>

<div class="container-fluid py-5" style="background-color: #efefef;">
    <div class="container">
        <h1 class="mb-4 text-uppercase fw-bold">Meus Cursos</h1>
        <div class="row g-4">
            <?php if (!empty($courses)): ?>
                <?php foreach ($courses as $course): ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card h-100 shadow-sm">
                            <?php if ($course['picture']): ?>
                                <img src="<?= BASE_URL; ?>/uploads/<?= htmlspecialchars($course['picture']); ?>" class="card-img-top" alt="<?= htmlspecialchars($course['name']); ?>" />
                            <?php endif; ?>
                            <div class="card-body d-flex flex-column">
                                <h6 class="fw-bold"><?= htmlspecialchars($course['name']); ?></h6>
                                <p class="text-muted small flex-grow-1">
                                    <?= htmlspecialchars(substr($course['description'], 0, 120)); ?>...
                                </p>
                                <a href="<?= BASE_URL; ?>/course/<?= htmlspecialchars($course['slug']); ?>" class="btn btn-success rounded-pill">Ver curso</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>   

            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div
                    class="card h-100 border-2 border-dashed text-center d-flex align-items-center justify-content-center"
                    style="border-style: dashed"
                >
                    <div class="card-body">
                        <p class="fw-bold text-muted mb-0">Adicionar curso</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
