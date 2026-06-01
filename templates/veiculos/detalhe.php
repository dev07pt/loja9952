<?php // templates/veiculos/detalhe.php
// Inclui o cabeçalho da página (cria templates/header.php reutilizável)
?>
<!DOCTYPE html><html lang="pt"><head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($titulo) ?> — AutoShop</title>
    <link rel="stylesheet" href="/css/estilo.css">
    <style>
        .topo { display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap; }
        .carrinho-link { color:#1565C0; text-decoration:none; font-weight:bold; }
    </style>
</head><body>
    <?php require __DIR__ . '/../header.php'; ?>
    <div class="topo">
        <a href="<?= htmlspecialchars(app_url('')) ?>">← Voltar ao catálogo</a>
    </div>
    <h1><?= htmlspecialchars($veiculo['marca'].' '.$veiculo['modelo']) ?></h1>
 
    <img src="<?= htmlspecialchars(app_url('uploads/' . ($veiculo['imagem'] ?? 'placeholder.png'))) ?>"
         alt="" style="max-width:600px; border-radius:8px;">
 
    <table>
        <tr><th>Marca</th>      <td><?= htmlspecialchars($veiculo['marca']) ?></td></tr>
        <tr><th>Modelo</th>     <td><?= htmlspecialchars($veiculo['modelo']) ?></td></tr>
        <tr><th>Ano</th>        <td><?= $veiculo['ano'] ?></td></tr>
        <tr><th>Quilómetros</th><td><?= number_format($veiculo['quilometros'],0,'.','.') ?> km</td></tr>
        <tr><th>Combustível</th><td><?= htmlspecialchars($veiculo['combustivel']) ?></td></tr>
        <?php if($veiculo['cilindrada']): ?>
        <tr><th>Cilindrada</th><td><?= htmlspecialchars($veiculo['cilindrada']) ?></td></tr>
        <?php endif ?>
        <tr><th>Preço</th>      <td><strong><?= number_format($veiculo['preco'],2,',','.') ?> €</strong></td></tr>
    </table>
 
    <?php if ($veiculo['descricao']): ?>
        <h3>Descrição</h3>
        <p><?= nl2br(htmlspecialchars($veiculo['descricao'])) ?></p>
    <?php endif ?>
 
    <form method="POST" action="<?= htmlspecialchars(app_url('carrinho/adicionar')) ?>">
        <input type="hidden" name="veiculo_id" value="<?= $veiculo['id'] ?>">
        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
        <button type="submit">🛒 Adicionar à lista de reservas</button>
    </form>
</body></html>
