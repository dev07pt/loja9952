<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$total_carrinho = count($_SESSION['carrinho'] ?? []);
?>
<header style="background:#1A237E;color:#fff;padding:14px 24px;display:flex;justify-content:space-between;align-items:center;gap:20px;flex-wrap:wrap;margin-bottom:24px;">
    <a href="<?= htmlspecialchars(app_url('')) ?>" style="color:#fff;font-size:1.3rem;font-weight:bold;text-decoration:none;">🚗 AutoShop</a>
    <nav style="display:flex;gap:20px;align-items:center;flex-wrap:wrap;">
        <a href="<?= htmlspecialchars(app_url('')) ?>" style="color:#fff;text-decoration:none;">Catálogo</a>
        <a href="<?= htmlspecialchars(app_url('carrinho')) ?>" style="color:#fff;text-decoration:none;">
            🛒 Lista (<?= $total_carrinho ?>)
        </a>
        <a href="<?= htmlspecialchars(app_url('veiculo/cadastrar')) ?>" style="color:#fff;text-decoration:none;">Cadastrar carro</a>
        <?php if ($_SESSION['logado'] ?? false): ?>
            <a href="<?= htmlspecialchars(app_url('conta')) ?>" style="color:#fff;text-decoration:none;">A minha conta</a>
            <a href="<?= htmlspecialchars(app_url('logout')) ?>" style="color:#ccc;text-decoration:none;">Sair</a>
        <?php else: ?>
            <a href="<?= htmlspecialchars(app_url('login')) ?>" style="color:#fff;text-decoration:none;">Entrar</a>
        <?php endif ?>
    </nav>
</header>
