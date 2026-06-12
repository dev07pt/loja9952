<?php // templates/carrinho/ver.php ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($titulo ?? 'Carrinho') ?></title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 1100px; margin: 0 auto; padding: 20px; color: #222; }
        .topo { display: flex; justify-content: space-between; align-items: center; gap: 16px; margin-bottom: 24px; }
        .topo a { color: #1565C0; text-decoration: none; }
        .resumo { background: #f0f4f8; padding: 10px 14px; border-radius: 8px; font-weight: bold; }
        .lista { display: grid; gap: 16px; }
        .item { display: grid; grid-template-columns: 110px 1fr auto; gap: 16px; align-items: center; border: 1px solid #ddd; border-radius: 10px; padding: 14px; background: #fff; }
        .thumb { width: 110px; height: 78px; object-fit: cover; border-radius: 8px; background: #eee; }
        .marca { font-size: .92rem; color: #666; margin: 0 0 4px; }
        .modelo { font-size: 1.1rem; font-weight: bold; margin: 0 0 8px; color: #1A237E; }
        .preco { font-size: 1.15rem; font-weight: bold; color: #1565C0; margin: 0; }
        .acoes { display: flex; flex-direction: column; align-items: flex-end; gap: 10px; }
        .remover { background: #c62828; color: #fff; border: none; border-radius: 6px; padding: 10px 14px; cursor: pointer; }
        .prosseguir { display: inline-flex; align-items: center; justify-content: center; background: #1565C0; color: #fff; border: none; border-radius: 6px; padding: 12px 18px; text-decoration: none; font-weight: bold; }
        .vazio { border: 1px dashed #cfd8dc; border-radius: 10px; padding: 30px; text-align: center; background: #fafcfd; color: #607d8b; }
        .rodape { display: flex; justify-content: space-between; align-items: center; gap: 16px; margin-top: 24px; }
        @media (max-width: 700px) {
            .topo, .rodape { flex-direction: column; align-items: stretch; }
            .item { grid-template-columns: 1fr; }
            .thumb { width: 100%; height: 180px; }
            .acoes { align-items: stretch; }
        }
    </style>
</head>
<body>
    <?php require __DIR__ . '/../header.php'; ?>
    <?php $totalVeiculos = count($veiculos ?? []); ?>

    <div class="topo">
        <div>
            <a href="<?= htmlspecialchars(app_url('')) ?>">Voltar ao catalogo</a>
            <h1><?= htmlspecialchars($titulo ?? 'Carrinho') ?></h1>
        </div>
        <div class="resumo">Total de veiculos: <?= $totalVeiculos ?></div>
    </div>

    <?php if ($totalVeiculos === 0): ?>
        <div class="vazio">
            <p>O teu carrinho esta vazio.</p>
            <p>Adiciona veiculos ao catalogo para os veres aqui.</p>
        </div>
    <?php else: ?>
        <div class="lista">
            <?php foreach ($veiculos as $veiculo): ?>
                <div class="item">
                    <img class="thumb"
                         src="<?= htmlspecialchars(imagem_url($veiculo['imagem'] ?? null)) ?>"
                         onerror="this.onerror=null;this.src='<?= htmlspecialchars(imagem_placeholder_svg()) ?>';"
                         alt="<?= htmlspecialchars(($veiculo['marca'] ?? '') . ' ' . ($veiculo['modelo'] ?? '')) ?>">

                    <div>
                        <p class="marca"><?= htmlspecialchars($veiculo['marca'] ?? '') ?></p>
                        <p class="modelo"><?= htmlspecialchars($veiculo['modelo'] ?? '') ?></p>
                        <p class="preco"><?= number_format((float) ($veiculo['preco'] ?? 0), 2, ',', '.') ?> EUR</p>
                    </div>

                    <div class="acoes">
                        <form method="POST" action="<?= htmlspecialchars(app_url('carrinho/remover')) ?>">
                            <input type="hidden" name="veiculo_id" value="<?= (int) ($veiculo['id'] ?? 0) ?>">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token()) ?>">
                            <button class="remover" type="submit">Remover</button>
                        </form>
                    </div>
                </div>
            <?php endforeach ?>
        </div>

        <div class="rodape">
            <div class="resumo">Veiculos na lista: <?= $totalVeiculos ?></div>
            <a class="prosseguir" href="<?= htmlspecialchars(app_url('checkout')) ?>">Prosseguir</a>
        </div>
    <?php endif ?>
</body>
</html>
