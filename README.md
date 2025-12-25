# README.md — Lam's Barber Shop

## Présentation

**Lam’s Barber Shop** est un site e-commerce développé en **PHP Vanilla** selon une architecture **MVC**, permettant d’acheter en ligne des produits professionnels de coiffure (tondeuses, shavers, accessoires, etc.).

---

## Technologies utilisées

* PHP 8+
* MySQL
* HTML / CSS
* Architecture MVC

---

## Installation de la base de données (phpMyAdmin)

### 1) Démarrer XAMPP
1. Ouvrir **XAMPP Control Panel**
2. Cliquer sur **Start** pour :
   - ✅ **Apache**
   - ✅ **MySQL**

Ensuite, ouvrir phpMyAdmin :
- http://localhost/phpmyadmin

---

### 2) Créer la base de données
Créer une base nommée :

```sql
CREATE DATABASE lams_barber CHARACTER SET utf8mb4;
```

3. Sélectionner la base **lams_barber**

4. Créer les tables suivantes :

### Table `users`

```sql
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(50),
    lastname VARCHAR(50),
    email VARCHAR(100),
    password VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
```

### Table `categories`

```sql
CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100)
);
```

### Table `products`

```sql
CREATE TABLE products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(150),
    description TEXT,
    price DECIMAL(10,2),
    image VARCHAR(150),
    category_id INT,
    stock INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
```

### Table `carts`

```sql
CREATE TABLE carts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    product_id INT,
    quantity INT
);
```

### Table `orders`

```sql
CREATE TABLE orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    total_amount DECIMAL(10,2),
    status VARCHAR(50),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
```

### Table `order_items`

```sql
CREATE TABLE order_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT,
    product_id INT,
    unit_price DECIMAL(10,2),
    quantity INT
);
```

---

## Lancer le projet

1. Démarrer **Apache + MySQL** (XAMPP)
2. Placer le projet dans `htdocs`
3. Ouvrir un terminal dans le dossier du projet
4. Lancer le serveur PHP :

```bash
php -S 127.0.0.1:3004 -t public
```

5. Ouvrir dans le navigateur :

```
http://127.0.0.1:3004
```

---

## Identifiants de test

Compte utilisateur de test :

| Email                                     | Mot de passe |
| ----------------------------------------- | ------------ |
| [test@barber.com](mailto:test@barber.com) | test123      |

---

## Dossier important

* `app/Controllers` → logique métier
* `app/Models` → accès base de données
* `app/Views` → affichage
* `public/` → point d’entrée du site

---

## Fonctionnalités

* Authentification (inscription / connexion)
* Catalogue produits
* Filtres par catégories
* Panier utilisateur
* Passage de commande
* Historique des commandes
