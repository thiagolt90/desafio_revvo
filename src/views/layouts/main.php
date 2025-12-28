<?php
    global $router;
    $isHome = $router->isHome ?? false;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle . " - " . APP_NAME : APP_NAME; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL; ?>css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-3 dr-header">
        <div class="container">
            <a class="navbar-brand" href="<?= BASE_URL; ?>"><img src="<?= BASE_URL; ?>img/logo.png" alt="Logo TLT"></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#dr-header-navbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="dr-header-navbar">
                <form class="mx-auto my-2 my-lg-0 w-50 dr-form" action="<?= BASE_URL; ?>">
                    <div class="input-group dr-search">
                        <input type="text" name="q" class="form-control rounded-pill dr-input" placeholder="Pesquisar cursos..." value="<?= isset($_REQUEST['q']) ? htmlspecialchars($_REQUEST['q']) : ''; ?>">
                        <button type="submit" class="btn position-absolute end-0 me-2 p-0 border-0 dr-button" aria-label="Buscar">
                            <i class="bi bi-search dr-icon"></i>
                        </button>
                    </div>
                </form>
                <div class="d-flex dr-separator">
                    <div class="vr"></div>
                </div>
                <ul class="navbar-nav ms-auto align-items-center dr-dropdown">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center dr-dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <?php if ($currentUser): ?>
                            <img src="<?= (isset($currentUser['picture']) ? BASE_URL . "uploads/" . $currentUser['picture'] : "https://placehold.co/50x50"); ?>" class="rounded-circle me-2 dr-user-picture" alt="Avatar">
                            <?php endif; ?>
                            <span class="dr-bem-vindo">
                                Seja bem-vindo<br>
                                <span class="dr-bem-vindo-nome"><?= (isset($currentUser['name']) ? $currentUser['name'] : "Acesse a área do usuário"); ?></span>
                            </span>
                        </a>
                        <?php if ($currentUser): ?>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="<?= BASE_URL; ?>user/edit">Meu cadastro</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="<?= BASE_URL; ?>user/logout">Sair</a></li>
                        </ul>
                        <?php else: ?>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="<?= BASE_URL; ?>user/login">Login</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= BASE_URL; ?>user/new">Cadastre-se</a></li>
                        </ul>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <?php require_once '../src/views/' . $view . '.php'; ?>
    </main>

    <footer class="dr-footer">
        <div class="container py-4">
            <div class="row align-items-center text-center text-md-start">
            <div class="col-md-6 mb-3 mb-md-0">
                <img src="<?= BASE_URL; ?>img/logo-footer.png" alt="Logo TLT">
                <p class="text-muted mb-0 dr-text">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ut pharetra ex.<br>
                    Nullam ultrices consectetur turpis, vitae pretium ligula posuere id.
                </p>
            </div>
            <div class="col-md-3 mb-3 mb-md-0">
                <h6 class="text-uppercase fw-bold mb-2">// Contato</h6>
                <p class="mb-1 text-muted small">(11) 99312-6993</p>
                <p class="mb-0 text-muted small">thiagolt90@gmail.com</p>
            </div>
            <div class="col-md-3 dr-social">
                <h6 class="text-uppercase fw-bold mb-2">// Redes Sociais</h6>
                <a href="#" class="dr-icon"><i class="bi bi-twitter"></i></a>
                <a href="#" class="dr-icon"><i class="bi bi-youtube"></i></a>
                <a href="#" class="dr-icon"><i class="bi bi-pinterest"></i></a>
            </div>

            </div>
        </div>
        <div class="py-2 dr-copyright">
            <div class="container">
                <small class="text-muted">
                    Copyright © <?= date("Y"); ?> - All right reserved.
                </small>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= BASE_URL; ?>js/modal.js"></script>
</body>
</html>
