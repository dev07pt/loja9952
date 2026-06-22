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

        if (str_ends_with($basePath, '/public')) {
            $basePath = substr($basePath, 0, -strlen('/public'));
        }

        $path = '/' . ltrim($path, '/');

        if (str_starts_with($path, '/uploads/')) {
            $ficheiro = substr($path, strlen('/uploads/'));
            return $basePath . '/imagem.php?f=' . rawurlencode($ficheiro);
        }

        if ($path === '/') {
            return $basePath . '/';
        }

        return $basePath . $path;
    }
}

if (!function_exists('imagem_placeholder_svg')) {
    function imagem_placeholder_svg(): string
    {
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="800" height="450" viewBox="0 0 800 450"><rect width="800" height="450" fill="#eef3f8"/><rect x="110" y="170" width="580" height="110" rx="18" fill="#d7e1ec"/><circle cx="230" cy="300" r="42" fill="#8aa0b5"/><circle cx="570" cy="300" r="42" fill="#8aa0b5"/><rect x="180" y="220" width="440" height="35" rx="8" fill="#b9c8d6"/><path d="M245 170h310c18 0 35 10 44 26l23 44H178l23-44c9-16 26-26 44-26z" fill="#9fb4c7"/><text x="400" y="395" font-family="Arial, sans-serif" font-size="28" text-anchor="middle" fill="#5f7285">Imagem indisponivel</text></svg>';
        return 'data:image/svg+xml;charset=UTF-8,' . rawurlencode($svg);
    }
}

if (!function_exists('imagem_url')) {
    function imagem_url(?string $imagem): string
    {
        $imagem = trim((string) $imagem);

        if ($imagem === '') {
            return imagem_placeholder_svg();
        }

        if (preg_match('#^https?://#i', $imagem)) {
            return $imagem;
        }

        return app_url('uploads/' . $imagem);
    }
}
