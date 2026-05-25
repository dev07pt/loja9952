<?php // templates/veiculos/detalhe.php ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($titulo) ?></title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 900px; margin: 0 auto; padding: 20px; }
        .card { border: 1px solid #ddd; border-radius: 8px; overflow: hidden; }
        .card img { width: 100%; max-height: 420px; object-fit: cover; background: #eee; }
        .content { padding: 18px; }
        .preco { font-size: 1.5rem; font-weight: bold; color: #1565C0; }
        .back { display: inline-block; margin-top: 18px; color: #1565C0; text-decoration: none; }
    </style>
</head>
<body>
    <div class="card">
        <img src="<?= !empty($veiculo['imagem']) ? '/uploads/' . htmlspecialchars($veiculo['imagem']) : '/img/placeholder.png' ?>"
             alt="<?= htmlspecialchars($veiculo['marca'] . ' ' . $veiculo['modelo']) ?>">
        <div class="content">
            <h1><?= htmlspecialchars($veiculo['marca'] . ' ' . $veiculo['modelo']) ?></h1>
            <p><?= (int) $veiculo['ano'] ?> | <?= number_format((float) $veiculo['quilometros'], 0, '.', '.') ?> km | <?= htmlspecialchars($veiculo['combustivel']) ?></p>
            <p class="preco"><?= number_format((float) $veiculo['preco'], 2, ',', '.') ?> EUR</p>
            <p><?= nl2br(htmlspecialchars($veiculo['descricao'] ?? 'Sem descricao disponivel.')) ?></p>
            <a class="back" href="/">Voltar ao catalogo</a>
        </div>
    </div>
</body>
</html>
