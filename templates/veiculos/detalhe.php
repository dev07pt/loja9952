<?php // templates/veiculos/detalhe.php ?>
<!DOCTYPE html><html lang="pt"><head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($titulo) ?> - AutoShop</title>
    <link rel="stylesheet" href="/css/estilo.css">
    <style>
        .topo { display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap; }
        .carrinho-link { color:#1565C0; text-decoration:none; font-weight:bold; }
        .estado { display:inline-block; padding:6px 10px; border-radius:999px; font-weight:bold; }
        .estado.disponivel { background:#e8f5e9; color:#2e7d32; }
        .estado.reservado { background:#ffebee; color:#c62828; }
    </style>
</head><body>
    <?php require __DIR__ . '/../header.php'; ?>
    <div class="topo">
        <a href="<?= htmlspecialchars(app_url('')) ?>">â† Voltar ao catÃ¡logo</a>
    </div>
    <h1><?= htmlspecialchars($veiculo['marca'].' '.$veiculo['modelo']) ?></h1>

    <img src="<?= htmlspecialchars(imagem_url($veiculo['imagem'] ?? null)) ?>"
         onerror="this.onerror=null;this.src='<?= htmlspecialchars(imagem_placeholder_svg()) ?>';"
         alt="" style="max-width:600px; border-radius:8px;">

    <table>
        <tr><th>Marca</th>      <td><?= htmlspecialchars($veiculo['marca']) ?></td></tr>
        <tr><th>Modelo</th>     <td><?= htmlspecialchars($veiculo['modelo']) ?></td></tr>
        <tr><th>Ano</th>        <td><?= $veiculo['ano'] ?></td></tr>
        <tr><th>QuilÃ³metros</th><td><?= number_format($veiculo['quilometros'],0,'.','.') ?> km</td></tr>
        <tr><th>CombustÃ­vel</th><td><?= htmlspecialchars($veiculo['combustivel']) ?></td></tr>
        <tr><th>Estado</th>
            <td>
                <span class="estado <?= ((int) ($veiculo['disponivel'] ?? 1) === 1) ? 'disponivel' : 'reservado' ?>">
                    <?= ((int) ($veiculo['disponivel'] ?? 1) === 1) ? 'DisponÃ­vel' : 'Reservado' ?>
                </span>
            </td>
        </tr>
        <?php if($veiculo['cilindrada']): ?>
        <tr><th>Cilindrada</th><td><?= htmlspecialchars($veiculo['cilindrada']) ?></td></tr>
        <?php endif ?>
        <tr><th>PreÃ§o</th>      <td><strong><?= number_format($veiculo['preco'],2,',','.') ?> â‚¬</strong></td></tr>
    </table>

    <?php if ($veiculo['descricao']): ?>
        <h3>DescriÃ§Ã£o</h3>
        <p><?= nl2br(htmlspecialchars($veiculo['descricao'])) ?></p>
    <?php endif ?>

    <form method="POST" action="<?= htmlspecialchars(app_url('carrinho/adicionar')) ?>">
        <input type="hidden" name="veiculo_id" value="<?= $veiculo['id'] ?>">
        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
        <button type="submit" <?= ((int) ($veiculo['disponivel'] ?? 1) === 1) ? '' : 'disabled' ?>>
            <?= ((int) ($veiculo['disponivel'] ?? 1) === 1) ? 'ðŸ›’ Adicionar Ã  lista de reservas' : 'Reservado' ?>
        </button>
    </form>
</body></html>
