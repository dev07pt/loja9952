<?php
namespace App;

class Auth {
    public static function verificar(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['logado']) || empty($_SESSION['cliente_id'])) {
            header('Location: ' . app_url('login'));
            exit;
        }
    }
}
