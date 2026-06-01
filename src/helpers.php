<?php

if (!function_exists('csrf_token')) {
    function csrf_token(): string
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }
}

if (!function_exists('csrf_validar')) {
    function csrf_validar(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $tokenPost = $_POST['csrf_token'] ?? '';
        $tokenSessao = $_SESSION['csrf_token'] ?? '';

        if ($tokenPost === '' || $tokenSessao === '' || !hash_equals($tokenSessao, $tokenPost)) {
            http_response_code(403);
            exit('Pedido inválido.');
        }
    }
}

if (!function_exists('app_url')) {
    function app_url(string $path = ''): string
    {
        $scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
        $basePath = rtrim(str_replace('\\', '/', dirname($scriptName)), '/');
        $basePath = $basePath === '/' ? '' : $basePath;

        $path = '/' . ltrim($path, '/');

        return $basePath . $path;
    }
}
