<div class="container-fluid py-5 dr-course-edit-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1><?= empty($course['id']) ? 'Novo Curso' : 'Editar Curso'; ?></h1>

                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <?php if (isset($message)): ?>
                    <div class="alert alert-success"><?= htmlspecialchars($message); ?></div>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Nome do Curso *</label>
                            <input type="text" class="form-control" name="name" id="name" required value="<?= htmlspecialchars($course['name'] ?? ''); ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Novo?</label>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="is_new" id="is_new" value='1' <?= ($course['is_new'] ?? 0) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="is_new">Destaque</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Slug *</label>
                        <input type="text" class="form-control" name="slug" id="slug" required value="<?= htmlspecialchars($course['slug'] ?? ''); ?>" pattern="[a-z0-9\-]+" title="Apenas letras minúsculas, números e hífen">
                        <div class="form-text">Ex: desafio-revvo</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descrição *</label>
                        <textarea class="form-control" name="description" rows="5" required><?= htmlspecialchars($course['description'] ?? ''); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto</label>
                        <input type="hidden" name="picture" value="<?= htmlspecialchars($course['picture'] ?? ''); ?>">
                        <input type="file" class="form-control" name="picture_upload" accept="image/*">
                        <?php if (isset($course['picture'])): ?>
                            <div class="mt-2">
                                <img src="<?= BASE_URL; ?>/uploads/<?= htmlspecialchars($course['picture']); ?>" class="img-thumbnail dr-course-image" alt="Atual">
                                <small class="text-muted d-block">Nova foto substituirá a atual</small>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="<?= BASE_URL; ?>/course/<?= $course['slug']; ?>" class="btn btn-primary">Voltar</a>
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?= BASE_URL; ?>/js/course.js"></script>