<?php // templates/admin/dashboard.php ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo ?? 'Administração') ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 24px;
            background: #f6f8fb;
            color: #1f2937;
        }
        .wrap {
            max-width: 1100px;
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
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }
        .card {
            background: #fff;
            border: 1px solid #dbe4ee;
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.05);
        }
        .card h2 {
            margin: 0 0 8px;
            font-size: 1rem;
            color: #475569;
            font-weight: 700;
        }
        .metric {
            font-size: 2.2rem;
            font-weight: 800;
            color: #111827;
        }
        .links {
            background: #fff;
            border: 1px solid #dbe4ee;
            border-radius: 14px;
            padding: 20px;
        }
        .links h2 {
            margin: 0 0 14px;
            font-size: 1.1rem;
        }
        .link-list {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }
        .link {
            display: inline-block;
            padding: 10px 14px;
            border-radius: 10px;
            text-decoration: none;
            background: #1f2937;
            color: #fff;
        }
        .link.secondary {
            background: #e5eef8;
            color: #1e3a5f;
        }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="topbar">
            <div>
                <h1>Dashboard</h1>
                <div class="muted">Resumo rápido da administração</div>
            </div>
        </div>

        <div class="grid">
            <div class="card">
                <h2>Total de veículos</h2>
                <div class="metric"><?= htmlspecialchars((string) ($totalVeiculos ?? '0')) ?></div>
            </div>
            <div class="card">
                <h2>Total de reservas</h2>
                <div class="metric"><?= htmlspecialchars((string) ($totalReservas ?? '0')) ?></div>
            </div>
            <div class="card">
                <h2>Reservas pendentes</h2>
                <div class="metric"><?= htmlspecialchars((string) ($reservasPendentes ?? '0')) ?></div>
            </div>
        </div>

        <div class="links">
            <h2>Secções</h2>
            <div class="link-list">
                <a class="link" href="/admin/veiculos">Veículos</a>
                <a class="link" href="/admin/reservas">Reservas</a>
                <a class="link secondary" href="/admin/reservas?estado=pendente">Pendentes</a>
            </div>
        </div>
    </div>
</body>
</html>
