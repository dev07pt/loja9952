<?php // templates/admin/veiculos.php ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo ?? 'Administração - Veículos') ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 24px;
            background: #f6f8fb;
            color: #1f2937;
        }
        .wrap {
            max-width: 1200px;
            margin: 0 auto;
        }
        .topbar {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }
        h1 {
            margin: 0;
            font-size: 2rem;
        }
        .muted {
            color: #6b7280;
            margin-top: 6px;
        }
        .btn {
            display: inline-block;
            padding: 11px 16px;
            border-radius: 10px;
            text-decoration: none;
            background: #1f2937;
            color: #fff;
            font-weight: 700;
        }
        .card {
            background: #fff;
            border: 1px solid #dbe4ee;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.05);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid #e5edf5;
            vertical-align: top;
        }
        th {
            background: #f8fafc;
            font-size: 0.92rem;
            color: #475569;
        }
        tr:last-child td {
            border-bottom: 0;
        }
        .acoes {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        .acao {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.92rem;
            font-weight: 700;
        }
        .acao.editar {
            background: #e5eef8;
            color: #1e3a5f;
        }
        .acao.apagar {
            background: #fee2e2;
            color: #991b1b;
        }
        .vazio {
            padding: 24px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="topbar">
            <div>
                <h1>Veículos</h1>
                <div class="muted">Gestão da frota no backoffice</div>
            </div>
            <a class="btn" href="/admin/veiculos/adicionar">Adicionar novo</a>
        </div>

        <div class="card">
            <?php if (!empty($veiculos) && is_array($veiculos)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Modelo</th>
                            <th>Marca</th>
                            <th>Ano</th>
                            <th>Preço</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($veiculos as $veiculo): ?>
                            <tr>
                                <td><?= htmlspecialchars((string) ($veiculo['id'] ?? '')) ?></td>
                                <td><?= htmlspecialchars((string) ($veiculo['modelo'] ?? '')) ?></td>
                                <td><?= htmlspecialchars((string) ($veiculo['marca'] ?? '')) ?></td>
                                <td><?= htmlspecialchars((string) ($veiculo['ano'] ?? '')) ?></td>
                                <td><?= htmlspecialchars((string) ($veiculo['preco'] ?? '')) ?></td>
                                <td>
                                    <div class="acoes">
                                        <a class="acao editar" href="/admin/veiculos/editar/<?= htmlspecialchars((string) ($veiculo['id'] ?? '')) ?>">Editar</a>
                                        <a class="acao apagar" href="/admin/veiculos/apagar/<?= htmlspecialchars((string) ($veiculo['id'] ?? '')) ?>">Apagar</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="vazio">Nenhum veículo encontrado.</div>
            <?php endif ?>
        </div>
    </div>
</body>
</html>
