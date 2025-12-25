<h1>Créer un compte</h1>

<!-- Affichage des messages d'erreur -->
<?php if (!empty($errors)): ?>
    <div class="flash-error">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<!-- Formulaire d'inscription -->
<form action="/auth/register" method="post" class="form">

    <div>
        <label for="firstname">Prénom</label>
        <input type="text" name="firstname" id="firstname" value="<?= htmlspecialchars($old['firstname'] ?? '') ?>"
            required>
    </div>

    <div>
        <label for="lastname">Nom</label>
        <input type="text" name="lastname" id="lastname" value="<?= htmlspecialchars($old['lastname'] ?? '') ?>"
            required>
    </div>

    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>" required>
    </div>

    <div>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" required>
    </div>

    <div>
        <label for="password_confirm">Confirmer le mot de passe</label>
        <input type="password" name="password_confirm" id="password_confirm" required>
    </div>

    <button type="submit" class="btn btn-primary">
        S'inscrire
    </button>

</form>


<!--Lien vers la page de connexion -->
<p style="text-align:center; margin-top:16px;">
    Déjà un compte ?
    <a href="/auth/login" style="color: var(--khaki); font-weight:700;">
        Se connecter
    </a>
</p>