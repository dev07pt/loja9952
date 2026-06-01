<?php // templates/veiculos/catalogo.php ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($titulo) ?></title>
    <style>
        body { font-family: Arial, sans-serif; max-width:1100px; margin:0 auto; padding:20px; }
        .filtros { background:#f0f4f8; padding:16px; border-radius:8px; margin-bottom:24px; display:flex; gap:12px; flex-wrap:wrap; }
        .filtros input, .filtros select { padding:8px; border:1px solid #ccc; border-radius:4px; }
        .filtros button { background:#1565C0; color:#fff; padding:8px 18px; border:none; border-radius:4px; cursor:pointer; }
        .grelha { display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:20px; }
        .card { border:1px solid #ddd; border-radius:8px; overflow:hidden; transition:box-shadow .2s; }
        .card:hover { box-shadow:0 4px 16px rgba(0,0,0,.12); }
        .card img { width:100%; height:180px; object-fit:cover; background:#eee; }
        .card-body { padding:14px; }
        .card-body h3 { margin:0 0 6px; font-size:1rem; color:#1A237E; }
        .preco { font-size:1.3rem; font-weight:bold; color:#1565C0; }
        .detalhe { display:inline-block; margin-top:10px; background:#1565C0; color:#fff;
                   padding:7px 14px; border-radius:4px; text-decoration:none; font-size:.9rem; }
        .adicionar { display:inline-block; margin-top:10px; background:#2e7d32; color:#fff;
                     padding:7px 14px; border:none; border-radius:4px; cursor:pointer; font-size:.9rem; }
        .acoes { display:flex; gap:10px; flex-wrap:wrap; align-items:center; margin-top:6px; }
        .topo { display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap; }
        .carrinho-link { color:#1565C0; text-decoration:none; font-weight:bold; }
    </style>
</head>
<body>
    <?php require __DIR__ . '/../header.php'; ?>

    <div class="topo">
        <h1>AutoShop - Catalogo de Veiculos</h1>
    </div>

    <form class="filtros" method="GET" action="">
        <select name="marca_id">
            <option value="">Todas as marcas</option>
            <?php foreach ($marcas as $m): ?>
            <option value="<?= $m['id'] ?>"
                <?= (($_GET['marca_id'] ?? '') == $m['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($m['nome']) ?>
            </option>
            <?php endforeach ?>
        </select>
        <select name="combustivel">
            <option value="">Combustivel</option>
            <?php foreach (['Gasolina', 'Diesel', 'Eletrico', 'Hibrido'] as $c): ?>
            <option value="<?= htmlspecialchars($c) ?>" <?= (($_GET['combustivel'] ?? '') === $c) ? 'selected' : '' ?>><?= htmlspecialchars($c) ?></option>
            <?php endforeach ?>
        </select>
        <input type="number" name="preco_max" placeholder="Preco max. (EUR)"
               value="<?= htmlspecialchars($_GET['preco_max'] ?? '') ?>">
        <input type="number" name="ano_min" placeholder="Ano minimo"
               value="<?= htmlspecialchars($_GET['ano_min'] ?? '') ?>">
        <input type="text" name="pesquisa" placeholder="Pesquisar modelo..."
               value="<?= htmlspecialchars($_GET['pesquisa'] ?? '') ?>">
        <button type="submit">Filtrar</button>
        <a href="<?= htmlspecialchars(app_url('')) ?>" style="padding:8px 14px;color:#555;text-decoration:none;">Limpar</a>
    </form>

    <p><?= count($veiculos) ?> veiculo(s) encontrado(s)</p>

    <?php if (empty($veiculos)): ?>
        <p style="color:#888;">Nenhum veiculo corresponde aos filtros selecionados.</p>
    <?php else: ?>
    <div class="grelha">
    <?php foreach ($veiculos as $v): ?>
        <div class="card">
            <img src="<?= !empty($v['imagem']) ? app_url('uploads/' . $v['imagem']) : app_url('img/placeholder.png') ?>"
                 alt="<?= htmlspecialchars($v['marca'] . ' ' . $v['modelo']) ?>">
            <div class="card-body">
                <h3><?= htmlspecialchars($v['marca'] . ' ' . $v['modelo']) ?></h3>
                <p><?= (int) $v['ano'] ?> | <?= number_format((float) $v['quilometros'], 0, '.', '.') ?> km | <?= htmlspecialchars($v['combustivel']) ?></p>
                <div class="preco"><?= number_format((float) $v['preco'], 2, ',', '.') ?> EUR</div>
                <div class="acoes">
                    <a class="detalhe" href="<?= htmlspecialchars(app_url('veiculo/detalhe/' . (int) $v['id'])) ?>">Ver detalhe</a>
                    <form method="POST" action="<?= htmlspecialchars(app_url('carrinho/adicionar')) ?>" style="margin:0;">
                        <input type="hidden" name="veiculo_id" value="<?= (int) $v['id'] ?>">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token()) ?>">
                        <button class="adicionar" type="submit">Adicionar ao carrinho</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    </div>
    <?php endif ?>
</body>
</html>
