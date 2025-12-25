<?php

namespace Mini\Models;

use Mini\Core\Model;
use Mini\Core\Database;
use PDO;

class Order extends Model
{
    protected $user_id;
    protected $total_amount;
    protected $status;

    // Crée une nouvelle commande
    public static function create(int $userId, float $totalAmount, string $status = 'pending'): ?int
    {
        $pdo = Database::getPDO();

        $sql = "
            INSERT INTO orders (user_id, total_amount, status, created_at)
            VALUES (:user_id, :total_amount, :status, NOW())
        ";

        $stmt = $pdo->prepare($sql);

        $ok = $stmt->execute([
            'user_id'      => $userId,
            'total_amount' => $totalAmount,
            'status'       => $status,
        ]);

        if ($ok) {
            return (int) $pdo->lastInsertId();
        }

        return null;
    }

    // Récupère les commandes d'un utilisateur donné
    public static function findByUser(int $userId): array
    {
        $pdo = Database::getPDO();

        $sql = "
            SELECT *
            FROM orders
            WHERE user_id = :user_id
            ORDER BY created_at DESC
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
