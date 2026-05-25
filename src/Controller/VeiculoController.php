<?php
namespace App\Controller;

use App\Model\VeiculoModel;

class VeiculoController
{
    private VeiculoModel $model;

    public function __construct()
    {
        $this->model = new VeiculoModel();
    }

    public function catalogo(): void
    {
        $filtros = [
            'marca_id' => (int) ($_GET['marca_id'] ?? 0) ?: null,
            'combustivel' => $_GET['combustivel'] ?? null,
            'preco_max' => (float) ($_GET['preco_max'] ?? 0) ?: null,
            'ano_min' => (int) ($_GET['ano_min'] ?? 0) ?: null,
            'pesquisa' => trim($_GET['pesquisa'] ?? ''),
        ];

        $filtros = array_filter($filtros, static fn ($valor) => $valor !== null && $valor !== '');

        $veiculos = $this->model->listar($filtros);
        $marcas = $this->model->getMarcas();
        $titulo = 'Catalogo de Veiculos';

        require __DIR__ . '/../../templates/veiculos/catalogo.php';
    }

    public function detalhe(int $id): void
    {
        $veiculo = $this->model->getById($id);

        if ($veiculo === false) {
            http_response_code(404);
            echo 'Veiculo nao encontrado.';
            return;
        }

        $titulo = 'Detalhe do Veiculo';
        require __DIR__ . '/../../templates/veiculos/detalhe.php';
    }
}
