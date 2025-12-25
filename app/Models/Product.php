<?php

namespace Mini\Models;

use Mini\Core\Model;
use Mini\Core\Database;
use PDO;

class Product extends Model
{
    protected $name;
    protected $description;
    protected $price;
    protected $image;
    protected $category_id;
    protected $stock;

    // Récupère tous les produits, avec option de filtrage par catégorie
    public static function findAll(?int $categoryId = null): array
    {
        $pdo = Database::getPDO();

        // Sans filtre
        if ($categoryId === null) {
            $sql = "
                SELECT p.*, c.name AS category_name
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.id
                ORDER BY p.created_at ASC
            ";

            $stmt = $pdo->query($sql);
        }
        // Avec filtre catégorie
        else {
            $sql = "
                SELECT p.*, c.name AS category_name
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE p.category_id = :category_id
                ORDER BY p.created_at ASC
            ";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'category_id' => $categoryId
            ]);
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupère un produit par son ID
    public static function findById(int $id): ?array
    {
        $pdo = Database::getPDO();

        $sql = "
            SELECT p.*, c.name AS category_name
            FROM products p
            LEFT JOIN categories c ON p.category_id = c.id
            WHERE p.id = :id
            LIMIT 1
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);

        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        return $product ?: null;
    }
}
