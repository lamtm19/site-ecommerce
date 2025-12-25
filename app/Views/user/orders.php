<h1>Mes commandes</h1>

<!-- Affichage des commandes de l'utilisateur -->
<?php if (empty($ordersWithItems)): ?>

    <p>Vous n'avez encore passé aucune commande.</p>

    <a href="/product/index" class="btn btn-primary">
        Voir les produits
    </a>

<!-- Boucle à travers les commandes et leurs articles -->
<?php else: ?>

    <?php foreach ($ordersWithItems as $block): ?>
        <?php $order = $block['order']; ?>
        <?php $items = $block['items']; ?>

        <section class="card" style="margin-bottom:24px;">

            <div class="card__body">
                <h2 style="margin-top:0;">
                    Commande n° <?= htmlspecialchars($order['id']) ?>
                </h2>

                <p style="margin-bottom:14px;">
                    Date : <?= htmlspecialchars($order['created_at']) ?><br>
                    Statut : <strong><?= htmlspecialchars($order['status']) ?></strong><br>
                    Montant total :
                    <strong class="price">
                        <?= number_format($order['total_amount'], 2) ?> €
                    </strong>
                </p>

                <?php if (!empty($items)): ?>

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
                                                alt="<?= htmlspecialchars($item['name']) ?>" width="70">
                                        <?php endif; ?>
                                    </td>

                                    <td><?= number_format($item['unit_price'], 2) ?> €</td>

                                    <td><?= (int) $item['quantity'] ?></td>

                                    <td>
                                        <strong class="price">
                                            <?= number_format($item['unit_price'] * $item['quantity'], 2) ?> €
                                        </strong>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- Si aucun article n'est trouvé pour la commande -->
                <?php else: ?>

                    <p>Aucun produit trouvé pour cette commande.</p>

                <?php endif; ?>
            </div>

        </section>

    <?php endforeach; ?>

<?php endif; ?>