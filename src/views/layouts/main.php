<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Desafio Revvo'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-3">
        <div class="container">
            <a class="navbar-brand" href="/"><img src="./img/logo.png" alt="Logo TLT"></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarHeader">
                <form class="mx-auto my-2 my-lg-0 w-50">
                    <div class="input-group">
                        <input type="text" class="form-control rounded-pill" placeholder="Pesquisar cursos..." style="background-color: #efefef;">
                    </div>
                </form>
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <img src="https://placehold.co/40x40" class="rounded-circle me-2" alt="Avatar">
                            <span class="d-none d-lg-inline">Thiago Lopes Teixeira</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Meu perfil</a></li>
                            <li><a class="dropdown-item" href="#">Configurações</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#">Sair</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <?php require_once '../src/views/' . $view . '.php'; ?>
    </main>

    <footer>
        <div class="container py-4">
            <div class="row align-items-center text-center text-md-start">
            <div class="col-md-6 mb-3 mb-md-0">
                <img src="./img/logo-footer.png" alt="Logo TLT">
                <p class="text-muted small mb-0">
                    Lorem Ipsum
                </p>
            </div>
            <div class="col-md-3 mb-3 mb-md-0">
                <h6 class="text-uppercase fw-bold mb-2">// Contato</h6>
                <p class="mb-1 text-muted small">(11) 99312-6993</p>
                <p class="mb-0 text-muted small">thiagolt90@gmail.com</p>
            </div>
            <div class="col-md-3">
                <h6 class="text-uppercase fw-bold mb-2">// Redes Sociais</h6>
                <a href="#" class="text-muted me-3 fs-5"><i class="bi bi-twitter"></i></a>
                <a href="#" class="text-muted me-3 fs-5"><i class="bi bi-youtube"></i></a>
                <a href="#" class="text-muted fs-5"><i class="bi bi-pinterest"></i></a>
            </div>

            </div>
        </div>
        <div class="py-2" style="background-color: #e5e1e2">
            <div class="container">
                <small class="text-muted">
                    Copyright © <?= date("Y"); ?> - All right reserved.
                </small>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/app.js"></script>
</body>
</html>
