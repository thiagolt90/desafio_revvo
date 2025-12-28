<?php

function uploadImage($file, $module = "") {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $maxSize = 5 * 1024 * 1024;
    
    if (!isset($file['error']) || $file['error'] !== UPLOAD_ERR_OK) {
        return ['error' => 'Erro no upload'];
    }

    if ($file['size'] > $maxSize) {
        return ['error' => 'Imagem muito grande (máx 5MB)'];
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    
    if (!in_array($mime, $allowedTypes)) {
        return ['error' => 'Tipo inválido. Use JPG, PNG, GIF ou WebP'];
    }

    $uploadDir = __DIR__ . '/../../public/uploads/';
    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0755, true)) {
            return ['error' => 'Erro ao criar pasta de uploads'];
        }
    }

    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid($module . '_', true) . '_' . bin2hex(random_bytes(8)) . '.' . $extension;
    $uploadPath = $uploadDir . $filename;

    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
        return ['filename' => $filename];
    }

    return ['error' => 'Erro ao salvar imagem'];
}
