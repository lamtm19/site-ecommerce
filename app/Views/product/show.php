<h1><?= htmlspecialchars($product['name']) ?></h1>

<div style="display:flex; gap:32px; flex-wrap:wrap; margin-top:18px;">

    <!--Image produit-->
    <div style="flex:1; min-width:260px;">
        <?php if (!empty($product['image'])): ?>
            <img src="/assets/img/products/<?= htmlspecialchars($product['image']) ?>"
                alt="<?= htmlspecialchars($product['name']) ?>" class="card__img"
                style="max-width:100%; border-radius:14px;">
        <?php endif; ?>
    </div>

    <!--Informations produit-->
    <div style="flex:1; min-width:260px;">

        <p style="font-size:20px; margin-top:0;">
            <strong class="price">
                <?= number_format($product['price'], 2) ?> €
            </strong>
        </p>

        <?php if (!empty($product['category_name'])): ?>
            <p style="color:var(--muted);">
                Catégorie :
                <strong><?= htmlspecialchars($product['category_name']) ?></strong>
            </p>
        <?php endif; ?>

        <p style="margin-top:14px;">
            <?= nl2br(htmlspecialchars($product['description'])) ?>
        </p>

        <div style="margin-top:20px; display:flex; gap:12px; flex-wrap:wrap;">
            <a href="/cart/add?product_id=<?= $product['id'] ?>" class="btn btn-primary">
                Ajouter au panier
            </a>

            <a href="/product/index" class="btn">
                ← Retour aux produits
            </a>
        </div>

    </div>

</div>