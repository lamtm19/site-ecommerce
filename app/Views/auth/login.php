<h1>Connexion</h1>

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

<!-- Formulaire de connexion -->
<form action="/auth/login" method="post" class="form">

    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>" required>
    </div>

    <div>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" required>
    </div>

    <button type="submit" class="btn btn-primary">
        Se connecter
    </button>

</form>


<!--Lien vers la page d'inscription -->
<p style="text-align:center; margin-top:16px;">
    Pas encore de compte ?
    <a href="/auth/register" style="color: var(--khaki); font-weight:700;">
        Créer un compte
    </a>
</p>