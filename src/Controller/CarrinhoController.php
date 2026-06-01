<?php
namespace App\Controller;
 
use App\Model\VeiculoModel;
 
class CarrinhoController {
    private VeiculoModel $model;
 
    public function __construct() {
        session_start();
        $this->model = new VeiculoModel();
    }
 
    // Mostrar o carrinho
    public function ver(): void {
        $ids      = $_SESSION['carrinho'] ?? [];
        $veiculos = array_map(fn($id) => $this->model->getById($id), $ids);
        $veiculos = array_filter($veiculos); // remover IDs inválidos
        $titulo   = 'A minha lista de reservas';
        require __DIR__ . '/../../templates/carrinho/ver.php';
    }
 
    // Adicionar ao carrinho
    public function adicionar(): void {
        csrf_validar();
        $id = (int) ($_POST['veiculo_id'] ?? 0);
        if ($id > 0) {
            $carrinho = $_SESSION['carrinho'] ?? [];
            if (!in_array($id, $carrinho)) {
                $carrinho[] = $id;
                $_SESSION['carrinho'] = $carrinho;
                $_SESSION['msg_ok']   = 'Veículo adicionado à lista!';
            } else {
                $_SESSION['msg_info'] = 'Este veículo já está na tua lista.';
            }
        }
        header('Location: ' . app_url('carrinho'));
        exit;
    }
 
    // Remover do carrinho
    public function remover(): void {
        csrf_validar();
        $id = (int) ($_POST['veiculo_id'] ?? 0);
        $carrinho = $_SESSION['carrinho'] ?? [];
        $carrinho = array_values(array_filter($carrinho, fn($i) => $i !== $id));
        $_SESSION['carrinho'] = $carrinho;
        header('Location: ' . app_url('carrinho'));
        exit;
    }
}
