<?php require_once '../src/views/components/modal.php'; ?>
<?php require_once '../src/views/components/banner.php'; ?>

<div class="container-fluid py-5 dr-home-page">
    <div class="container">
        <h1 class="text-uppercase fw-bold">Meus Cursos</h1>
        <hr>
        <div class="row g-4 dr-courses">
            <?php if (!empty($courses)): ?>
                <?php foreach ($courses as $course): ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card h-100 shadow-sm dr-course">
                            <?php if ($course['picture']): ?>
                                <?php if ($course['is_new'] == 1): ?>
                                    <span class="badge-new">NOVO</span>
                                <?php endif; ?>
                                <img src="<?= BASE_URL; ?>/uploads/<?= htmlspecialchars($course['picture']); ?>" class="card-img-top dr-course-img" alt="<?= htmlspecialchars($course['name']); ?>" />
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
                <div class="card h-100 border-2 border-dashed text-center dr-add-course">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <img src="<?= BASE_URL; ?>/img/add-course.png" alt="Adicionar Curso" class="mb-2">
                        <a href="<?= BASE_URL; ?>/course/new" class="fw-bold text-muted mb-0">Adicionar curso</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
