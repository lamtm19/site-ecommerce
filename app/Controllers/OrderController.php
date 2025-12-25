<?php

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\Cart;
use Mini\Models\Order;
use Mini\Models\OrderItem;

class OrderController extends Controller
{
    // Get pour avoir l'id utilisateur
    private function getUserId(): ?int
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['user_id']) ? (int) $_SESSION['user_id'] : null;
    }

    // Validation du panier
    public function checkout()
    {
        $userId = $this->getUserId();

        if (!$userId) {
            // Pas connecté -> redirection vers login
            header('Location: /auth/login');
            exit;
        }

        $items = Cart::getItemsByUser($userId);
        $total = Cart::getTotalByUser($userId);

        if (empty($items)) {
            // Panier vide -> rediection au panier
            header('Location: /cart/index');
            exit;
        }

        $this->render('order/checkout', [
            'items' => $items,
            'total' => $total,
        ]);
    }

    // Creation de la commande
    public function confirm()
    {
        $userId = $this->getUserId();

        if (!$userId) {
            header('Location: /auth/login');
            exit;
        }

        $items = Cart::getItemsByUser($userId);
        $total = Cart::getTotalByUser($userId);

        if (empty($items)) {
            header('Location: /cart/index');
            exit;
        }

        // Créer la commande
        $orderId = Order::create($userId, $total, 'pending');

        if (!$orderId) {
            echo "Erreur lors de la création de la commande.";
            return;
        }

        // Créer les lignes de commande
        foreach ($items as $item) {
            OrderItem::create(
                $orderId,
                (int) $item['product_id'],
                (int) $item['quantity'],
                (float) $item['price']
            );
        }

        // Vider le panier
        Cart::clearByUser($userId);

        // Afficher la page de succès
        $this->render('order/success', [
            'orderId' => $orderId,
            'total' => $total,
        ]);
    }
}
