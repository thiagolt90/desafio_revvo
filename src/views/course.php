<?php require_once '../src/views/components/banner.php'; ?>

<div class="container-fluid py-5" style="background-color: #efefef;">
    <div class="container">
        <h1 class="mb-4 text-uppercase fw-bold"><?php echo htmlspecialchars($course['name']); ?></h1>
        <div class="g-4">
            <?php echo htmlspecialchars($course['description']); ?>
        </div>
    </div>
</div>    
