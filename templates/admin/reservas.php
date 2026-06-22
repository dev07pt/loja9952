<?php // templates/admin/reservas.php ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo ?? 'Administração - Reservas') ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 24px;
            background: #f6f8fb;
            color: #1f2937;
        }
        .wrap {
            max-width: 1280px;
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
        select {
            padding: 9px 10px;
            border: 1px solid #cfd8dc;
            border-radius: 8px;
            background: #fff;
            font-size: 0.95rem;
        }
        .acoes {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
        }
        .vazio {
            padding: 24px;
            color: #6b7280;
        }
        .estado {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            background: #eef2f7;
            color: #334155;
            font-size: 0.9rem;
            font-weight: 700;
        }
        .estado.pendente {
            background: #fff8db;
            color: #9a6b00;
        }
        .estado.confirmada {
            background: #e8f5e9;
            color: #2e7d32;
        }
        .estado.cancelada {
            background: #ffebee;
            color: #c62828;
        }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="topbar">
            <div>
                <h1>Reservas</h1>
                <div class="muted">Gestão de reservas do backoffice</div>
            </div>
            <a class="btn" href="/admin">Voltar ao dashboard</a>
        </div>

        <div class="card">
            <?php if (!empty($reservas) && is_array($reservas)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Veículo</th>
                            <th>Estado</th>
                            <th>Data</th>
                            <th>Mudar estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservas as $reserva): ?>
                            <tr>
                                <td><?= htmlspecialchars((string) ($reserva['id'] ?? '')) ?></td>
                                <td><?= htmlspecialchars((string) ($reserva['cliente_nome'] ?? $reserva['cliente'] ?? '')) ?></td>
                                <td><?= htmlspecialchars((string) ($reserva['veiculo_nome'] ?? $reserva['veiculo'] ?? '')) ?></td>
                                <?php $estadoReserva = strtolower((string) ($reserva['estado'] ?? '')); ?>
                                <td>
                                    <span class="estado <?= htmlspecialchars($estadoReserva) ?>">
                                        <?= htmlspecialchars((string) ($reserva['estado'] ?? '')) ?>
                                    </span>
                                </td>
                                <td><?= htmlspecialchars((string) ($reserva['data'] ?? $reserva['created_at'] ?? '')) ?></td>
                                <td>
                                    <form class="acoes" method="POST" action="<?= htmlspecialchars($actionEstado ?? '/admin/reservas/estado') ?>">
                                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token()) ?>">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars((string) ($reserva['id'] ?? '')) ?>">
                                        <select name="estado">
                                            <?php
                                            $estadoAtual = (string) ($reserva['estado'] ?? '');
                                            $opcoes = ['pendente' => 'Pendente', 'confirmada' => 'Confirmada', 'cancelada' => 'Cancelada', 'concluida' => 'Concluída'];
                                            foreach ($opcoes as $valor => $label):
                                            ?>
                                                <option value="<?= htmlspecialchars($valor) ?>" <?= $estadoAtual === $valor ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($label) ?>
                                                </option>
                                            <?php endforeach ?>
                                        </select>
                                        <button class="btn" type="submit">Atualizar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="vazio">Nenhuma reserva encontrada.</div>
            <?php endif ?>
        </div>
    </div>
</body>
</html>
