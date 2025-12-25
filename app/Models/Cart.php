<?php

namespace Mini\Models;

use Mini\Core\Model;
use Mini\Core\Database;
use PDO;

class Cart extends Model
{
    protected $user_id;
    protected $product_id;
    protected $quantity;

    // Récupère les articles du panier pour un utilisateur donné
    public static function getItemsByUser(int $userId): array
    {
        $pdo = Database::getPDO();

        $sql = "
            SELECT 
                c.product_id,
                c.quantity,
                p.name,
                p.price,
                p.image
            FROM carts c
            INNER JOIN products p ON p.id = c.product_id
            WHERE c.user_id = :user_id
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Calcule le total du panier pour un utilisateur donné
    public static function getTotalByUser(int $userId): float
    {
        $pdo = Database::getPDO();

        $sql = "
            SELECT SUM(c.quantity * p.price) AS total
            FROM carts c
            INNER JOIN products p ON p.id = c.product_id
            WHERE c.user_id = :user_id
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row && $row['total'] !== null ? (float) $row['total'] : 0.0;
    }

    // Ajoute un produit au panier
    public static function addProduct(int $userId, int $productId, int $quantity = 1): bool
    {
        $pdo = Database::getPDO();

        // On vérifie si le produit est déjà dans le panier
        $sql = "
            SELECT id, quantity 
            FROM carts 
            WHERE user_id = :user_id AND product_id = :product_id
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'user_id'    => $userId,
            'product_id' => $productId,
        ]);

        $cartItem = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cartItem) {
            // On met à jour la quantité
            $newQuantity = $cartItem['quantity'] + $quantity;

            $sql = "
                UPDATE carts 
                SET quantity = :quantity 
                WHERE id = :id
            ";
            $stmt = $pdo->prepare($sql);

            return $stmt->execute([
                'quantity' => $newQuantity,
                'id'       => $cartItem['id'],
            ]);
        } else {
            // On insère une nouvelle ligne
            $sql = "
                INSERT INTO carts (user_id, product_id, quantity, created_at)
                VALUES (:user_id, :product_id, :quantity, NOW())
            ";
            $stmt = $pdo->prepare($sql);

            return $stmt->execute([
                'user_id'    => $userId,
                'product_id' => $productId,
                'quantity'   => $quantity,
            ]);
        }
    }

    // Supprime un produit du panier
    public static function removeProduct(int $userId, int $productId): bool
    {
        $pdo = Database::getPDO();

        $sql = "
            DELETE FROM carts
            WHERE user_id = :user_id AND product_id = :product_id
        ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            'user_id'    => $userId,
            'product_id' => $productId,
        ]);
    }

    // Vide le panier d'un utilisateur
    public static function clearByUser(int $userId): bool
    {
        $pdo = Database::getPDO();

        $sql = "DELETE FROM carts WHERE user_id = :user_id";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute(['user_id' => $userId]);
    }

    public static function countItems(int $userId): int
    {
        $pdo = Database::getPDO();

        $sql = "SELECT SUM(quantity) FROM carts WHERE user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'user_id' => $userId
        ]);

        return (int) $stmt->fetchColumn();
    }


}
