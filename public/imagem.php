<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/helpers.php';

$ficheiro = $_GET['f'] ?? '';
$ficheiro = str_replace(["\\", "\0"], ['/', ''], $ficheiro);
$ficheiro = ltrim($ficheiro, '/');

if ($ficheiro === '' || str_contains($ficheiro, '..') || str_contains($ficheiro, '/')) {
    http_response_code(404);
    exit;
}

$caminho = __DIR__ . '/../uploads/' . $ficheiro;

if (!is_file($caminho)) {
    http_response_code(404);
    exit;
}

$extensao = strtolower(pathinfo($caminho, PATHINFO_EXTENSION));
$tipos = [
    'jpg' => 'image/jpeg',
    'jpeg' => 'image/jpeg',
    'png' => 'image/png',
    'gif' => 'image/gif',
    'webp' => 'image/webp',
    'svg' => 'image/svg+xml',
];

header('Content-Type: ' . ($tipos[$extensao] ?? 'application/octet-stream'));
header('Content-Length: ' . filesize($caminho));
readfile($caminho);
