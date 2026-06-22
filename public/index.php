<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/helpers.php';

$env = parse_ini_file(__DIR__ . '/../.env', false, INI_SCANNER_TYPED) ?: [];
foreach ($env as $k => $v) {
    $_ENV[$k] = $v;
}

use App\Controller\VeiculoController;
use App\Controller\CarrinhoController;
use App\Controller\CheckoutController;
use App\Controller\AuthController;
use App\Controller\ContaController;
use App\Controller\AdminController;

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
$rota    = $recurso . '/' . $acao;

$ctrl = new VeiculoController();
$carrinhoCtrl = new CarrinhoController();
$checkoutCtrl = new CheckoutController();
$authCtrl = new AuthController();
$contaCtrl = new ContaController();
$adminCtrl = new AdminController();

match($rota) {
    '' => $ctrl->catalogo(),
    'veiculo/detalhe' => $ctrl->detalhe($id),
    'veiculo/cadastrar' => $ctrl->cadastrar(),
    'carrinho/' => $carrinhoCtrl->ver(),
    'carrinho/adicionar' => $carrinhoCtrl->adicionar(),
    'carrinho/remover' => $carrinhoCtrl->remover(),
    'checkout/' => $checkoutCtrl->ver(),
    'checkout/confirmar' => $checkoutCtrl->confirmar(),
    'conta/' => $contaCtrl->ver(),
    'login/' => $authCtrl->login(),
    'admin' => $adminCtrl->dashboard(),
    'admin/' => $adminCtrl->dashboard(),
    'admin/login' => $authCtrl->adminLogin(),
    'admin/login/' => $authCtrl->adminLogin(),
    'admin/veiculos' => $adminCtrl->veiculosLista(),
    'admin/veiculos/' => $adminCtrl->veiculosLista(),
    'admin/veiculos/criar' => $adminCtrl->veiculoCriar(),
    'admin/veiculos/criar/' => $adminCtrl->veiculoCriar(),
    'admin/reservas' => $adminCtrl->reservasLista(),
    'admin/reservas/' => $adminCtrl->reservasLista(),
    'admin/reservas/estado' => $adminCtrl->reservaEstado(),
    'admin/reservas/estado/' => $adminCtrl->reservaEstado(),
    'registar/' => $authCtrl->registar(),
    'logout/' => $authCtrl->logout(),
    default => $ctrl->catalogo(),
};
