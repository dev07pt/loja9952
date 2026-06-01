<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/helpers.php';

$env = parse_ini_file(__DIR__ . '/../.env', false, INI_SCANNER_TYPED) ?: [];
foreach ($env as $k => $v) {
    $_ENV[$k] = $v;
}
 
use App\Controller\VeiculoController;
use App\Controller\CarrinhoController;
 
$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';
$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
$basePath = rtrim(str_replace('\\', '/', dirname($scriptName)), '/');
$basePath = $basePath === '/' ? '' : $basePath;

if ($basePath !== '' && str_starts_with($requestPath, $basePath)) {
    $requestPath = substr($requestPath, strlen($basePath));
}

if (str_starts_with($requestPath, '/index.php')) {
    $requestPath = substr($requestPath, strlen('/index.php'));
}

$uri    = trim($requestPath, '/');
$partes = explode('/', $uri);
$recurso = $partes[0] ?? '';
$acao    = $partes[1] ?? '';
$id      = (int)($partes[2] ?? 0);
 
$ctrl = new VeiculoController();
$carrinhoCtrl = new CarrinhoController();
 
match("$recurso/$acao") {
    ''           => $ctrl->catalogo(),
    'veiculo/detalhe' => $ctrl->detalhe($id),
    'carrinho/'       => $carrinhoCtrl->ver(),
    'carrinho/adicionar' => $carrinhoCtrl->adicionar(),
    'carrinho/remover'   => $carrinhoCtrl->remover(),
    default      => $ctrl->catalogo(),
};
