<div class="container">
    <div class="row">
        <div class="col-lg-12 py-4">
            <h1>Cadastro de usuários</h1>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
    
            <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nome *</label>
                        <input type="text" class="form-control" name="name" required 
                               minlength="2" maxlength="100">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email *</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Senha *</label>
                        <input type="password" class="form-control" name="password" required 
                               minlength="6">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Foto (opcional)</label>
                        <input type="file" class="form-control" name="picture" accept="image/*">
                    </div>
                </div>
    
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="<?php echo BASE_URL; ?>/users" class="btn btn-outline-secondary me-md-2">Cancelar</a>
                    <button type="submit" class="btn btn-success">Criar Usuário</button>
                </div>
            </form>
        </div>
    </div>
</div>
