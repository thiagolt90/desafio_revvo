<?php require_once '../src/views/components/banner.php'; ?>

<div class="container-fluid py-5 dr-course-page">
    <div class="container">
        <h1 class="mb-4 text-uppercase fw-bold"><?= htmlspecialchars($course['name']); ?></h1>
        <div class="g-4">
            <?= nl2br(htmlspecialchars($course['description'])); ?>
        </div>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="<?= BASE_URL; ?>course/edit/<?= $course['slug']; ?>" class="btn btn-success dr-btn-edit-course">Editar Curso</a>
        <?php endif; ?>
    </div>
</div>    
