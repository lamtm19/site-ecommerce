<?php if (!empty($needLogin) && $needLogin === true): ?>

    <!-- Message demandant à l'utilisateur de se connecter -->
    <h1>Votre panier</h1>
    <p>Vous devez être connecté pour accéder à votre panier.</p>

    <a href="/auth/login" class="btn btn-primary">
        Se connecter
    </a>

<?php else: ?>

    <!-- Affichage du panier -->

    <h1>Votre panier</h1>

    <?php if (empty($items)): ?>

        <p>Votre panier est vide.</p>

        <a href="/product/index" class="btn btn-primary">
            Voir les produits
        </a>

    <?php else: ?>

        <table class="table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Image</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['name']) ?></td>

                        <td>
                            <?php if (!empty($item['image'])): ?>
                                <img src="/assets/img/products/<?= htmlspecialchars($item['image']) ?>"
                                    alt="<?= htmlspecialchars($item['name']) ?>" width="80">
                            <?php endif; ?>
                        </td>

                        <td><?= number_format($item['price'], 2) ?> €</td>

                        <td><?= (int) $item['quantity'] ?></td>

                        <td>
                            <strong class="price">
                                <?= number_format($item['price'] * $item['quantity'], 2) ?> €
                            </strong>
                        </td>

                        <td>
                            <a href="/cart/remove?product_id=<?= $item['product_id'] ?>" class="btn btn-danger">
                                Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3 style="margin-top:18px;">
            Total :
            <span class="price"><?= number_format($total, 2) ?> €</span>
        </h3>

        <div style="margin-top:16px; display:flex; gap:12px; flex-wrap:wrap;">
            <a href="/cart/clear" class="btn btn-danger">
                Vider le panier
            </a>

            <a href="/order/checkout" class="btn btn-primary">
                Passer la commande
            </a>
        </div>

    <?php endif; ?>

<?php endif; ?>