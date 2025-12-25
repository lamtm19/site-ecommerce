<?php
// Session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use Mini\Models\Cart;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Lam's Barber Shop</title>
    <link rel="stylesheet" href="/assets/css/style.css?v=1">
</head>

<body>

    <!-- Flash Messages -->
    <?php if (!empty($_SESSION['flash_success'])): ?>
        <div class="flash-success">
            <?= htmlspecialchars($_SESSION['flash_success']) ?>
        </div>
        <?php unset($_SESSION['flash_success']); ?>
    <?php endif; ?>

    <!-- Header -->
    <header class="site-header">
        <div class="container site-header__inner">

            <!-- Logo -->
            <div class="brand">
                <img src="/assets/img/logo.png" alt="Lam's Barber Shop">
            </div>

            <!-- Navigation -->
            <nav class="nav">

                <a href="/">
                    <span class="icon">
                        <img src="/assets/icons/accueil.png" alt="">
                    </span>
                    Accueil
                </a>

                <a href="/product/index">
                    <span class="icon">
                        <img src="/assets/icons/produits.png" alt="">
                    </span>
                    Produits
                </a>

                <?php
                $cartCount = 0;
                if (!empty($_SESSION['user_id'])) {
                    $cartCount = Cart::countItems($_SESSION['user_id']);
                }
                ?>

                <a href="/cart/index">
                    <span class="icon">
                        <img src="/assets/icons/panier.png" alt="">
                    </span>
                    Panier
                    <?php if ($cartCount > 0): ?>
                        <span class="cart-count"><?= $cartCount ?></span>
                    <?php endif; ?>
                </a>

                <?php if (!empty($_SESSION['user_id'])): ?>

                    <a href="/user/orders">
                        <span class="icon">
                            <img src="/assets/icons/commandes.png" alt="">
                        </span>
                        Mes commandes
                    </a>

                    <span class="nav__hello">
                        Bonjour <?= htmlspecialchars($_SESSION['user_name']) ?>
                    </span>

                    <a href="/auth/logout">
                        <span class="icon">
                            <img src="/assets/icons/deconnexion.png" alt="">
                        </span>
                        Déconnexion
                    </a>

                <?php else: ?>

                    <a href="/auth/login">
                        <span class="icon">
                            <img src="/assets/icons/connexion.png" alt="">
                        </span>
                        Connexion
                    </a>

                    <a href="/auth/register">
                        <span class="icon">
                            <img src="/assets/icons/inscription.png" alt="">
                        </span>
                        Inscription
                    </a>

                <?php endif; ?>

            </nav>
        </div>
    </header>

    <!-- Contenu principal -->
    <main class="container">
        <?= $content ?? '' ?>
    </main>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container site-footer__inner" style="justify-content:center;">
            <p>
                &copy; <?= date('Y') ?> Lam's Barber Shop — Produits de coiffure professionnels
            </p>
        </div>
    </footer>


</body>

</html>