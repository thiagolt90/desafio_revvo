<div class="container">
    <div class="row">
        <div class="col-lg-12 py-4">
            <h1><?= empty($user['id']) ? 'Novo Usuário' : 'Editar Usuário'; ?></h1>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <?php if (isset($message)): ?>
                <div class="alert alert-success"><?= htmlspecialchars($message); ?></div>
            <?php endif; ?>
    
            <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nome *</label>
                        <input type="text" class="form-control" name="name" required minlength="2" maxlength="100" value="<?= (isset($user["name"])) ? $user["name"] : ""; ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email *</label>
                        <input type="email" class="form-control" name="email" required value="<?= (isset($user["email"])) ? $user["email"] : ""; ?>">
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Senha *</label>
                        <input type="password" class="form-control" name="password" required minlength="6">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Foto (opcional)</label>
                        <input type="hidden" name="picture" value="<?= (isset($user["picture"])) ? $user["picture"] : ""; ?>">
                        <input type="file" class="form-control" name="picture_upload" accept="image/*">
                    </div>
                </div>
    
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-success">Salvar Usuário</button>
                </div>
            </form>
        </div>
    </div>
</div>
