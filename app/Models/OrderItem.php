<?php

namespace Mini\Models;

use Mini\Core\Model;
use Mini\Core\Database;
use PDO;

class OrderItem extends Model
{
    protected $order_id;
    protected $product_id;
    protected $quantity;
    protected $unit_price;

    // Crée une nouvelle ligne de commande
    public static function create(int $orderId, int $productId, int $quantity, float $unitPrice): bool
    {
        $pdo = Database::getPDO();

        $sql = "
            INSERT INTO order_items (order_id, product_id, quantity, unit_price)
            VALUES (:order_id, :product_id, :quantity, :unit_price)
        ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            'order_id'   => $orderId,
            'product_id' => $productId,
            'quantity'   => $quantity,
            'unit_price' => $unitPrice,
        ]);
    }

    // Récupère les articles d'une commande donnée
    public static function findByOrder(int $orderId): array
    {
        $pdo = Database::getPDO();

        $sql = "
            SELECT oi.*, p.name, p.image
            FROM order_items oi
            INNER JOIN products p ON p.id = oi.product_id
            WHERE oi.order_id = :order_id
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['order_id' => $orderId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
