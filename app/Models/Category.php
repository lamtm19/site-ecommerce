<?php

namespace Mini\Models;

use Mini\Core\Model;
use Mini\Core\Database;
use PDO;

class Category extends Model
{
    protected $name;
    protected $slug;

    // Récupère toutes les catégories
    public static function findAll()
    {
        $pdo = Database::getPDO();

        $sql = "SELECT * FROM categories ORDER BY name DESC";
        $stmt = $pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //  Récupère une catégorie par son ID
    public static function findById($id)
    {
        $pdo = Database::getPDO();

        $sql = "SELECT * FROM categories WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        $category = $stmt->fetch(PDO::FETCH_ASSOC);

        return $category ?: null;
    }
}
