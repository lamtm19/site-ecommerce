<h1>Nos produits</h1>

<!-- Filtrage par catégorie -->
<?php if (!empty($categories)): ?>
    <div class="filters">
        <a href="/product/index" class="filter <?= empty($categoryId) ? 'active' : '' ?>">
            Tous
        </a>

        <?php foreach ($categories as $category): ?>
            <a href="/product/index?category_id=<?= $category['id'] ?>"
                class="filter <?= (!empty($categoryId) && (int) $categoryId === (int) $category['id']) ? 'active' : '' ?>">
                <?= htmlspecialchars($category['name']) ?>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>


<!-- Affichage des produits -->
<?php if (empty($products)): ?>

    <p>Aucun produit disponible pour le moment.</p>

<?php else: ?>

    <div class="grid">
        <?php foreach ($products as $product): ?>
            <div class="card">

                <?php if (!empty($product['image'])): ?>
                    <img class="card__img" src="/assets/img/products/<?= htmlspecialchars($product['image']) ?>"
                        alt="<?= htmlspecialchars($product['name']) ?>">
                <?php endif; ?>

                <div class="card__body">
                    <h3 class="card__title">
                        <?= htmlspecialchars($product['name']) ?>
                    </h3>

                    <p class="price">
                        <?= number_format($product['price'], 2) ?> €
                    </p>

                    <div class="actions">
                        <a href="/product/show?id=<?= $product['id'] ?>" class="btn">
                            Voir le produit
                        </a>

                        <a href="/cart/add?product_id=<?= $product['id'] ?>" class="btn btn-primary">
                            Ajouter au panier
                        </a>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>
    </div>

<?php endif; ?>