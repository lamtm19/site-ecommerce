<!-- Affichage du message de succès de la commande -->
<h1>Merci pour votre commande !</h1>

<!-- Détails de la commande -->
<p>
    Votre commande n°
    <strong><?= htmlspecialchars($orderId) ?></strong>
    a bien été enregistrée.
</p>

<p style="font-size:18px; margin-top:10px;">
    Montant total :
    <span class="price"><?= number_format($total, 2) ?> €</span>
</p>

<div style="margin-top:18px;">
    <p>
        Vos tondeuses et accessoires seront préparés avec soin 💈<br>
        Livraison en cours de traitement.
    </p>
</div>

<div style="margin-top:22px; display:flex; gap:12px; flex-wrap:wrap;">
    <a href="/user/orders" class="btn">
        Voir mes commandes
    </a>

    <a href="/product/index" class="btn btn-primary">
        Continuer mes achats
    </a>
</div>