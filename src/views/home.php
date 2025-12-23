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
<!-- Banner -->
<div class="container-fluid p-0">
    <div class="banner d-flex align-items-center">
        <div class="container">
            <div class="banner-overlay p-4">
                <h2 class="fw-bold">LOREM IPSUM</h2>
                <p class="small">
                    Dolor sit Amet
                </p>
                <a href="#" class="btn btn-outline-light btn-sm">VER CURSO</a>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid py-5" style="background-color: #efefef;">
    <div class="container">
        <h1 class="mb-4 text-uppercase fw-bold">Meus Cursos</h1>
        <div class="row g-4">
            <?php if (!empty($cursos)): ?>
                <?php foreach ($cursos as $curso): ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card h-100 shadow-sm">
                            <?php if ($curso['picture']): ?>
                                <img src="/uploads/<?php echo htmlspecialchars($curso['picture']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($curso['name']); ?>" />
                            <?php endif; ?>
                            <div class="card-body d-flex flex-column">
                                <h6 class="fw-bold"><?php echo htmlspecialchars($curso['name']); ?></h6>
                                <p class="text-muted small flex-grow-1">
                                    <?php echo htmlspecialchars(substr($curso['description'], 0, 120)); ?>...
                                </p>
                                <a href="#" class="btn btn-success rounded-pill">Ver curso</a>
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
