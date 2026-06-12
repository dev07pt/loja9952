<?php // templates/conta/ver.php ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($titulo ?? 'A minha conta') ?></title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 1100px; margin: 0 auto; padding: 20px; color: #222; }
        .topo { display: flex; justify-content: space-between; align-items: center; gap: 16px; margin-bottom: 24px; flex-wrap: wrap; }
        .topo a { color: #1565C0; text-decoration: none; }
        .painel { background: #f6f9fc; border: 1px solid #dce6ef; border-radius: 12px; padding: 18px; margin-bottom: 24px; }
        .tabela { width: 100%; border-collapse: collapse; background: #fff; border: 1px solid #e0e7ef; border-radius: 12px; overflow: hidden; }
        .tabela th, .tabela td { padding: 12px 14px; text-align: left; border-bottom: 1px solid #e8edf3; vertical-align: top; }
        .tabela th { background: #f1f5f9; font-weight: bold; }
        .tabela tr:last-child td { border-bottom: none; }
        .estado { display: inline-flex; padding: 6px 10px; border-radius: 999px; background: #e3f2fd; color: #0d47a1; font-weight: bold; font-size: .92rem; }
        .vazio { border: 1px dashed #cfd8dc; border-radius: 10px; padding: 30px; text-align: center; background: #fafcfd; color: #607d8b; }
        .sub { color: #546e7a; margin: 0; }
        .nome { margin: 6px 0 0; font-size: 1.35rem; }
        @media (max-width: 800px) {
            .tabela, .tabela tbody, .tabela tr, .tabela td, .tabela th { display: block; width: 100%; }
            .tabela thead { display: none; }
            .tabela tr { border-bottom: 1px solid #e8edf3; }
            .tabela td { border-bottom: none; }
            .tabela td::before { content: attr(data-label); display: block; font-size: .82rem; font-weight: bold; color: #607d8b; margin-bottom: 4px; }
        }
    </style>
</head>
<body>
    <?php require __DIR__ . '/../header.php'; ?>

    <div class="topo">
        <div>
            <a href="<?= htmlspecialchars(app_url('')) ?>">Voltar ao catálogo</a>
            <h1><?= htmlspecialchars($titulo ?? 'A minha conta') ?></h1>
        </div>
        <div>
            <a href="<?= htmlspecialchars(app_url('logout')) ?>">Terminar sessão</a>
        </div>
    </div>

    <div class="painel">
        <p class="sub">Cliente</p>
        <h2 class="nome"><?= htmlspecialchars($cliente['nome'] ?? 'Cliente') ?></h2>
        <p class="sub"><?= htmlspecialchars($cliente['email'] ?? '') ?></p>
    </div>

    <?php if (empty($reservas)): ?>
        <div class="vazio">
            <p>Ainda não tens reservas confirmadas.</p>
            <p>Explora o catálogo, adiciona veículos e conclui o checkout para veres as reservas aqui.</p>
        </div>
    <?php else: ?>
        <table class="tabela">
            <thead>
                <tr>
                    <th>Veículo</th>
                    <th>Ano</th>
                    <th>Preço</th>
                    <th>Estado</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservas as $reserva): ?>
                    <tr>
                        <td data-label="Veículo"><?= htmlspecialchars(($reserva['marca'] ?? '') . ' ' . ($reserva['modelo'] ?? '')) ?></td>
                        <td data-label="Ano"><?= htmlspecialchars((string) ($reserva['ano'] ?? '')) ?></td>
                        <td data-label="Preço"><?= number_format((float) ($reserva['preco'] ?? 0), 2, ',', '.') ?> EUR</td>
                        <td data-label="Estado"><span class="estado"><?= htmlspecialchars($reserva['estado'] ?? 'Pendente') ?></span></td>
                        <td data-label="Data"><?= htmlspecialchars($reserva['criado_em'] ?? '') ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php endif ?>
</body>
</html>
