<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/helpers.php';

$env = parse_ini_file(__DIR__ . '/../.env', false, INI_SCANNER_TYPED) ?: [];
foreach ($env as $k => $v) {
    $_ENV[$k] = $v;
}

$pdo = App\Database::getConnection();
$stmt = $pdo->prepare('UPDATE veiculos SET imagem = :imagem WHERE id = :id');

$map = [
    1  => 'bmw-3-series-g20.jpg',
    2  => 'bmw-x5.jpg',
    3  => 'mercedes-c-class-w205.jpg',
    4  => 'audi-a4.jpg',
    5  => 'vw-golf-v-gti.jpg',
    6  => 'toyota-gr-yaris.jpg',
    7  => 'renault-megane-e-tech.jpg',
    8  => 'peugeot-e-2008.jpg',
    9  => 'ford-mustang-mach-e.jpg',
    10 => 'volkswagen-t-roc.jpg',
];

foreach ($map as $id => $file) {
    $stmt->execute([
        ':imagem' => $file,
        ':id' => $id,
    ]);
}

echo "Imagens locais associadas com sucesso.\n";
