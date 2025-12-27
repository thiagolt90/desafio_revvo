
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
        <div class="card border-1 my-4">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <h1 class="h3 mb-1">Login</h1>
                </div>

                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-4">
                        <label class="form-label">E-mail</label>
                        <input type="email" class="form-control form-control-lg" name="email" required autofocus>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Senha</label>
                        <input type="password" class="form-control form-control-lg" name="password" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 btn-lg mb-4">
                        Entrar
                    </button>

                    <a href="<?= BASE_URL; ?>/user/new" class="btn btn-secondary w-100 btn-lg mb-4">
                        Cadastre-se
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
