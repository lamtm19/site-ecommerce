<h1>Bienvenue sur Lam's Barber Shop</h1>

<p>Découvrez nos tondeuses, shavers, peignes et accessoires professionnels.</p>

<div class="grid">
    <!-- Affichage des produits récents -->
    <?php foreach ($products as $product): ?>
        <div class="card">

            <img class="card__img" src="/assets/img/products/<?= htmlspecialchars($product['image']) ?>"
                alt="<?= htmlspecialchars($product['name']) ?>">

            <div class="card__body">
                <h3 class="card__title"><?= htmlspecialchars($product['name']) ?></h3>

                <p class="price"><?= number_format($product['price'], 2) ?> €</p>

                <div class="actions">
                    <a class="btn" href="/product/show?id=<?= $product['id'] ?>">
                        Voir le produit
                    </a>

                    <a class="btn btn-primary" href="/cart/add?product_id=<?= $product['id'] ?>">
                        Ajouter au panier
                    </a>
                </div>
            </div>

        </div>
    <?php endforeach; ?>
</div>