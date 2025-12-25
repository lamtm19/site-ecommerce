<h1>Validation de votre commande</h1>

<?php if (empty($items)): ?>

    <p>Votre panier est vide.</p>

    <a href="/product/index" class="btn btn-primary">
        Voir les produits
    </a>

<?php else: ?>

    <!-- Affichage des détails de la commande -->
    <table class="table">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Image</th>
                <th>Prix unitaire</th>
                <th>Quantité</th>
                <th>Total</th>
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
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Affichage du total et bouton de confirmation -->
    <h3 style="margin-top:18px;">
        Total :
        <span class="price"><?= number_format($total, 2) ?> €</span>
    </h3>

    <form action="/order/confirm" method="post" style="margin-top:16px;">
        <button type="submit" class="btn btn-primary">
            Confirmer la commande
        </button>
    </form>

    <p style="margin-top:16px;">
        <a href="/cart/index" class="btn">
            Retour au panier
        </a>
    </p>

<?php endif; ?>