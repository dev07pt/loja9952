<?php // templates/auth/registar.php ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($titulo ?? 'Criar conta') ?></title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 760px; margin: 0 auto; padding: 20px; color: #222; }
        .card { border: 1px solid #ddd; border-radius: 12px; padding: 24px; background: #fff; }
        .campo { display: grid; gap: 6px; margin-bottom: 14px; }
        .campo input { padding: 11px 12px; border: 1px solid #cfd8dc; border-radius: 8px; font-size: 1rem; }
        .acoes { display: flex; gap: 12px; align-items: center; flex-wrap: wrap; margin-top: 18px; }
        .btn { background: #1565C0; color: #fff; border: 0; border-radius: 8px; padding: 11px 16px; cursor: pointer; font-size: 1rem; text-decoration: none; display: inline-block; }
        .erros { background: #fff5f5; border: 1px solid #ef9a9a; color: #c62828; padding: 14px 16px; border-radius: 8px; margin-bottom: 16px; }
        .erros ul { margin: 0; padding-left: 18px; }
        .alternar { color: #1565C0; text-decoration: none; }
        label { font-weight: bold; }
    </style>
</head>
<body>
    <?php require __DIR__ . '/../header.php'; ?>
    <div class="card">
        <h1><?= htmlspecialchars($titulo ?? 'Criar conta') ?></h1>

        <?php if (!empty($erros)): ?>
            <div class="erros">
                <ul>
                    <?php foreach ($erros as $erro): ?>
                        <li><?= htmlspecialchars($erro) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>

        <form method="POST" action="<?= htmlspecialchars(app_url('registar')) ?>">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token()) ?>">

            <div class="campo">
                <label for="nome">Nome</label>
                <input id="nome" type="text" name="nome" value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>" required>
            </div>

            <div class="campo">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
            </div>

            <div class="campo">
                <label for="telefone">Telefone</label>
                <input id="telefone" type="text" name="telefone" value="<?= htmlspecialchars($_POST['telefone'] ?? '') ?>">
            </div>

            <div class="campo">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
            </div>

            <div class="campo">
                <label for="password2">Confirmar password</label>
                <input id="password2" type="password" name="password2" required>
            </div>

            <div class="acoes">
                <button class="btn" type="submit">Criar conta</button>
                <a class="alternar" href="<?= htmlspecialchars(app_url('login')) ?>">JÃ¡ tens conta? Fazer login</a>
            </div>
        </form>
    </div>
</body>
</html>
