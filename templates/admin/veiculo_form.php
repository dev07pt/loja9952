<?php // templates/admin/veiculo_form.php ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo ?? 'Administração - Veículo') ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 24px;
            background: #f6f8fb;
            color: #1f2937;
        }
        .wrap {
            max-width: 980px;
            margin: 0 auto;
        }
        .card {
            background: #fff;
            border: 1px solid #dbe4ee;
            border-radius: 14px;
            padding: 24px;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.05);
        }
        h1 {
            margin: 0 0 8px;
            font-size: 2rem;
        }
        .muted {
            color: #6b7280;
            margin-bottom: 20px;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 14px;
        }
        .campo {
            display: grid;
            gap: 6px;
        }
        label {
            font-weight: 700;
            color: #374151;
        }
        input, select, textarea {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #cfd8dc;
            border-radius: 8px;
            font-size: 1rem;
            box-sizing: border-box;
            background: #fff;
        }
        textarea {
            min-height: 120px;
            resize: vertical;
        }
        .full {
            grid-column: 1 / -1;
        }
        .acoes {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 20px;
        }
        .btn {
            background: #1f2937;
            color: #fff;
            border: 0;
            border-radius: 10px;
            padding: 11px 16px;
            cursor: pointer;
            font-size: 1rem;
            text-decoration: none;
            display: inline-block;
            font-weight: 700;
        }
        .btn.secundario {
            background: #e5eef8;
            color: #1e3a5f;
        }
        .preview {
            margin-top: 12px;
            display: inline-block;
            max-width: 220px;
            border-radius: 10px;
            border: 1px solid #dbe4ee;
        }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="card">
            <h1><?= htmlspecialchars($titulo ?? 'Veículo') ?></h1>
            <div class="muted">Formulário para criar ou editar veículos.</div>

            <form method="POST" enctype="multipart/form-data" action="<?= htmlspecialchars($action ?? '') ?>">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token()) ?>">
                <?php if (!empty($veiculo['id'])): ?>
                    <input type="hidden" name="id" value="<?= htmlspecialchars((string) $veiculo['id']) ?>">
                <?php endif ?>

                <div class="grid">
                    <div class="campo">
                        <label for="marca">Marca</label>
                        <input id="marca" type="text" name="marca" value="<?= htmlspecialchars($veiculo['marca'] ?? '') ?>" required>
                    </div>

                    <div class="campo">
                        <label for="modelo">Modelo</label>
                        <input id="modelo" type="text" name="modelo" value="<?= htmlspecialchars($veiculo['modelo'] ?? '') ?>" required>
                    </div>

                    <div class="campo">
                        <label for="ano">Ano</label>
                        <input id="ano" type="number" name="ano" min="1900" max="2100" value="<?= htmlspecialchars((string) ($veiculo['ano'] ?? '')) ?>" required>
                    </div>

                    <div class="campo">
                        <label for="preco">Preço</label>
                        <input id="preco" type="number" step="0.01" min="0" name="preco" value="<?= htmlspecialchars((string) ($veiculo['preco'] ?? '')) ?>" required>
                    </div>

                    <div class="campo">
                        <label for="cor">Cor</label>
                        <input id="cor" type="text" name="cor" value="<?= htmlspecialchars($veiculo['cor'] ?? '') ?>">
                    </div>

                    <div class="campo">
                        <label for="combustivel">Combustível</label>
                        <input id="combustivel" type="text" name="combustivel" value="<?= htmlspecialchars($veiculo['combustivel'] ?? '') ?>">
                    </div>

                    <div class="campo">
                        <label for="transmissao">Transmissão</label>
                        <input id="transmissao" type="text" name="transmissao" value="<?= htmlspecialchars($veiculo['transmissao'] ?? '') ?>">
                    </div>

                    <div class="campo">
                        <label for="km">Quilometragem</label>
                        <input id="km" type="number" min="0" name="km" value="<?= htmlspecialchars((string) ($veiculo['km'] ?? '')) ?>">
                    </div>

                    <div class="campo">
                        <label for="estado">Estado</label>
                        <input id="estado" type="text" name="estado" value="<?= htmlspecialchars($veiculo['estado'] ?? '') ?>">
                    </div>

                    <div class="campo">
                        <label for="imagem">Imagem</label>
                        <input id="imagem" type="file" name="imagem" accept="image/*">
                        <?php if (!empty($veiculo['imagem'])): ?>
                            <img class="preview" src="<?= htmlspecialchars(imagem_url($veiculo['imagem'])) ?>" alt="Imagem atual">
                        <?php endif ?>
                    </div>

                    <div class="campo full">
                        <label for="descricao">Descrição</label>
                        <textarea id="descricao" name="descricao"><?= htmlspecialchars($veiculo['descricao'] ?? '') ?></textarea>
                    </div>
                </div>

                <div class="acoes">
                    <button class="btn" type="submit"><?= htmlspecialchars($botao ?? 'Guardar') ?></button>
                    <a class="btn secundario" href="/admin/veiculos">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
