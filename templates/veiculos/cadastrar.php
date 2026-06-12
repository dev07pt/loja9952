<?php // templates/veiculos/cadastrar.php ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo ?? 'Cadastrar veículo') ?></title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 1100px; margin: 0 auto; padding: 20px; color: #222; background: #f7f9fc; }
        .topo { display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap; margin-bottom:24px; }
        .topo a { color:#1565C0; text-decoration:none; font-weight:bold; }
        h1 { margin:0; color:#1A237E; }
        .painel { background:#fff; border:1px solid #dbe3ee; border-radius:14px; padding:20px; box-shadow:0 6px 18px rgba(26,35,126,.06); }
        .erros { background:#ffebee; border:1px solid #ffcdd2; color:#b71c1c; padding:14px 16px; border-radius:10px; margin-bottom:18px; }
        .erros ul { margin:0; padding-left:18px; }
        .grid { display:grid; grid-template-columns:repeat(2, minmax(0, 1fr)); gap:16px; }
        .campo { display:grid; gap:8px; }
        .campo.full { grid-column:1 / -1; }
        label { font-weight:bold; color:#1A237E; }
        input, select, textarea {
            width:100%;
            border:1px solid #cfd8dc;
            border-radius:10px;
            padding:12px 14px;
            font:inherit;
            box-sizing:border-box;
            background:#fff;
        }
        textarea { min-height:120px; resize:vertical; }
        .acoes { display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap; margin-top:18px; }
        .botao {
            display:inline-flex; align-items:center; justify-content:center;
            border:none; border-radius:10px; padding:13px 18px;
            font-weight:bold; cursor:pointer; text-decoration:none;
        }
        .primario { background:#1565C0; color:#fff; }
        .secundario { background:#e3eaf3; color:#1A237E; }
        .nota { color:#607d8b; font-size:.95rem; }
        @media (max-width: 700px) {
            .grid { grid-template-columns:1fr; }
            .acoes { flex-direction:column; align-items:stretch; }
        }
    </style>
</head>
<body>
    <?php require __DIR__ . '/../header.php'; ?>

    <div class="topo">
        <div>
            <a href="<?= htmlspecialchars(app_url('')) ?>">Voltar ao catálogo</a>
            <h1><?= htmlspecialchars($titulo ?? 'Cadastrar veículo') ?></h1>
        </div>
    </div>

    <div class="painel">
        <?php if (!empty($erros)): ?>
            <div class="erros">
                <strong>Corrige estes campos:</strong>
                <ul>
                    <?php foreach ($erros as $erro): ?>
                        <li><?= htmlspecialchars($erro) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= htmlspecialchars(app_url('veiculo/cadastrar')) ?>" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token()) ?>">

            <div class="grid">
                <div class="campo">
                    <label for="marca_id">Marca</label>
                    <select id="marca_id" name="marca_id" required>
                        <option value="">Seleciona uma marca</option>
                        <?php foreach ($marcas as $marca): ?>
                            <option value="<?= (int) $marca['id'] ?>" <?= ((int) ($dados['marca_id'] ?? 0) === (int) $marca['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($marca['nome']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="campo">
                    <label for="modelo">Modelo</label>
                    <input id="modelo" name="modelo" type="text" value="<?= htmlspecialchars($dados['modelo'] ?? '') ?>" required>
                </div>

                <div class="campo">
                    <label for="ano">Ano</label>
                    <input id="ano" name="ano" type="number" min="1900" step="1" value="<?= htmlspecialchars((string) ($dados['ano'] ?? '')) ?>" required>
                </div>

                <div class="campo">
                    <label for="quilometros">Quilómetros</label>
                    <input id="quilometros" name="quilometros" type="number" min="0" step="1" value="<?= htmlspecialchars((string) ($dados['quilometros'] ?? '')) ?>" required>
                </div>

                <div class="campo">
                    <label for="combustivel">Combustível</label>
                    <select id="combustivel" name="combustivel" required>
                        <option value="">Seleciona</option>
                        <?php foreach (['Gasolina', 'Diesel', 'Eletrico', 'Hibrido'] as $combustivel): ?>
                            <option value="<?= htmlspecialchars($combustivel) ?>" <?= (($dados['combustivel'] ?? '') === $combustivel) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($combustivel) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="campo">
                    <label for="cilindrada">Cilindrada</label>
                    <input id="cilindrada" name="cilindrada" type="text" value="<?= htmlspecialchars($dados['cilindrada'] ?? '') ?>" placeholder="Ex.: 2.0">
                </div>

                <div class="campo">
                    <label for="preco">Preço</label>
                    <input id="preco" name="preco" type="number" min="0" step="0.01" value="<?= htmlspecialchars((string) ($dados['preco'] ?? '')) ?>" required>
                </div>

                <div class="campo">
                    <label for="imagem">Foto do carro</label>
                    <input id="imagem" name="imagem" type="file" accept="image/jpeg,image/png,image/gif,image/webp">
                    <div class="nota">Opcional. Formatos aceites: JPG, PNG, GIF e WEBP.</div>
                </div>

                <div class="campo full">
                    <label for="descricao">Descrição</label>
                    <textarea id="descricao" name="descricao" placeholder="Descrição opcional do veículo"><?= htmlspecialchars($dados['descricao'] ?? '') ?></textarea>
                </div>
            </div>

            <div class="acoes">
                <a class="botao secundario" href="<?= htmlspecialchars(app_url('')) ?>">Cancelar</a>
                <button class="botao primario" type="submit">Guardar veículo</button>
            </div>
        </form>
    </div>
</body>
</html>
