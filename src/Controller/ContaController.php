<?php
namespace App\Controller;

use App\Auth;
use App\Model\ClienteModel;
use App\Model\ReservaModel;

class ContaController {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function ver(): void {
        Auth::verificar();

        $clienteId = (int) ($_SESSION['cliente_id'] ?? 0);
        $cliente   = (new ClienteModel())->getById($clienteId);
        $reservas  = (new ReservaModel())->getByCliente($clienteId);
        $titulo    = 'A minha conta';

        require __DIR__ . '/../../templates/conta/ver.php';
    }
}
