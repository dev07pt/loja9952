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

    public function cadastrar(): void
    {
        $marcas = $this->model->getMarcas();
        $erros = [];
        $dados = [
            'marca_id' => '',
            'modelo' => '',
            'ano' => '',
            'quilometros' => '',
            'combustivel' => '',
            'cilindrada' => '',
            'preco' => '',
            'descricao' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            csrf_validar();

            $dados['marca_id'] = (int) ($_POST['marca_id'] ?? 0);
            $dados['modelo'] = trim($_POST['modelo'] ?? '');
            $dados['ano'] = (int) ($_POST['ano'] ?? 0);
            $dados['quilometros'] = (int) ($_POST['quilometros'] ?? 0);
            $dados['combustivel'] = trim($_POST['combustivel'] ?? '');
            $dados['cilindrada'] = trim($_POST['cilindrada'] ?? '');
            $dados['preco'] = (float) ($_POST['preco'] ?? 0);
            $dados['descricao'] = trim($_POST['descricao'] ?? '');

            if ($dados['marca_id'] <= 0) $erros[] = 'Escolhe uma marca.';
            if (strlen($dados['modelo']) < 2) $erros[] = 'Indica um modelo válido.';
            if ($dados['ano'] < 1900) $erros[] = 'Indica um ano válido.';
            if ($dados['quilometros'] < 0) $erros[] = 'Os quilómetros não podem ser negativos.';
            if ($dados['combustivel'] === '') $erros[] = 'Indica o combustível.';
            if ($dados['preco'] <= 0) $erros[] = 'Indica um preço válido.';

            $imagem = null;
            if (!empty($_FILES['imagem']['name']) && ($_FILES['imagem']['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_OK) {
                $tmpName = $_FILES['imagem']['tmp_name'];
                $originalName = $_FILES['imagem']['name'];
                $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
                $permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

                if (!in_array($ext, $permitidas, true)) {
                    $erros[] = 'A imagem tem de ser JPG, PNG, GIF ou WEBP.';
                } else {
                    $uploadsDir = __DIR__ . '/../../uploads';
                    if (!is_dir($uploadsDir)) {
                        mkdir($uploadsDir, 0777, true);
                    }

                    $imagem = bin2hex(random_bytes(12)) . '.' . $ext;
                    $destino = $uploadsDir . '/' . $imagem;

                    if (!move_uploaded_file($tmpName, $destino)) {
                        $erros[] = 'Não foi possível guardar a imagem.';
                        $imagem = null;
                    }
                }
            }

            if (empty($erros)) {
                $this->model->criar([
                    'marca_id' => $dados['marca_id'],
                    'modelo' => $dados['modelo'],
                    'ano' => $dados['ano'],
                    'quilometros' => $dados['quilometros'],
                    'combustivel' => $dados['combustivel'],
                    'cilindrada' => $dados['cilindrada'] !== '' ? $dados['cilindrada'] : null,
                    'preco' => $dados['preco'],
                    'descricao' => $dados['descricao'] !== '' ? $dados['descricao'] : null,
                    'imagem' => $imagem,
                    'disponivel' => 1,
                ]);

                $_SESSION['msg_ok'] = 'Veículo cadastrado com sucesso.';
                header('Location: ' . app_url(''));
                exit;
            }
        }

        $titulo = 'Cadastrar veículo';
        require __DIR__ . '/../../templates/veiculos/cadastrar.php';
    }
}
