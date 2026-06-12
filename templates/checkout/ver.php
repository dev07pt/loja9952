<?php // templates/checkout/ver.php ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo ?? 'Confirmar reserva') ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1100px;
            margin: 0 auto;
            padding: 20px;
            color: #222;
            background: #f7f9fc;
        }

        .topo {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .topo a {
            color: #1565C0;
            text-decoration: none;
            font-weight: bold;
        }

        h1 {
            margin: 0;
            color: #1A237E;
        }

        .resumo {
            background: #e8eef9;
            padding: 12px 16px;
            border-radius: 10px;
            font-weight: bold;
            color: #1A237E;
        }

        .caixa {
            background: #fff;
            border: 1px solid #dbe3ee;
            border-radius: 14px;
            padding: 18px;
            box-shadow: 0 6px 18px rgba(26, 35, 126, 0.06);
        }

        .lista {
            display: grid;
            gap: 14px;
            margin-bottom: 22px;
        }

        .item {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 12px;
            align-items: center;
            border: 1px solid #e4e9f1;
            border-radius: 12px;
            padding: 14px 16px;
            background: #fafcff;
        }

        .marca {
            margin: 0 0 4px;
            font-size: 0.92rem;
            color: #607d8b;
        }

        .modelo {
            margin: 0 0 6px;
            font-size: 1.1rem;
            font-weight: bold;
            color: #1A237E;
        }

        .preco {
            margin: 0;
            font-weight: bold;
            color: #1565C0;
        }

        .campo {
            display: grid;
            gap: 8px;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #1A237E;
        }

        textarea {
            width: 100%;
            min-height: 120px;
            resize: vertical;
            border: 1px solid #cfd8dc;
            border-radius: 10px;
            padding: 12px 14px;
            font: inherit;
            box-sizing: border-box;
            background: #fff;
        }

        .aviso {
            background: #fff8e1;
            color: #8a6d00;
            border: 1px solid #ffe08a;
            border-radius: 10px;
            padding: 14px 16px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .rodape {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .botao {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: none;
            border-radius: 10px;
            padding: 13px 18px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
        }

        .confirmar {
            background: #1565C0;
            color: #fff;
        }

        .voltar {
            background: #e3eaf3;
            color: #1A237E;
        }

        @media (max-width: 700px) {
            .topo, .rodape {
                flex-direction: column;
                align-items: stretch;
            }

            .item {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <?php require __DIR__ . '/../header.php'; ?>
    <?php $totalVeiculos = count($veiculos ?? []); ?>

    <div class="topo">
        <div>
            <a href="<?= htmlspecialchars(app_url('carrinho')) ?>">Voltar ao carrinho</a>
            <h1><?= htmlspecialchars($titulo ?? 'Confirmar reserva') ?></h1>
        </div>
        <div class="resumo">Total de veículos a reservar: <?= $totalVeiculos ?></div>
    </div>

    <form class="caixa" method="POST" action="<?= htmlspecialchars(app_url('checkout/confirmar')) ?>">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token()) ?>">

        <div class="lista">
            <?php foreach ($veiculos as $veiculo): ?>
                <div class="item">
                    <div>
                        <p class="marca"><?= htmlspecialchars($veiculo['marca'] ?? '') ?></p>
                        <p class="modelo"><?= htmlspecialchars($veiculo['modelo'] ?? '') ?></p>
                    </div>
                    <p class="preco"><?= number_format((float) ($veiculo['preco'] ?? 0), 2, ',', '.') ?> EUR</p>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="campo">
            <label for="mensagem">Informações adicionais para o vendedor</label>
            <textarea id="mensagem" name="mensagem" placeholder="Escreve aqui qualquer informação adicional, se quiseres."></textarea>
        </div>

        <div class="aviso">
            Esta é uma reserva simulada — sem pagamento online.
        </div>

        <div class="rodape">
            <a class="botao voltar" href="<?= htmlspecialchars(app_url('carrinho')) ?>">Voltar ao carrinho</a>
            <button class="botao confirmar" type="submit">Confirmar reserva</button>
        </div>
    </form>
</body>
</html>
