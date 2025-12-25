<?php

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\Order;
use Mini\Models\OrderItem;

class UserController extends Controller
{
    // Récupère l'ID de l'utilisateur connecté depuis la session
    private function getUserId(): ?int
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['user_id']) ? (int) $_SESSION['user_id'] : null;
    }

    // Affiche la liste des commandes de l'utilisateur connecté
    public function orders()
    {
        $userId = $this->getUserId();

        if (!$userId) {
            // Pas connecté => redirection vers login
            header('Location: /auth/login');
            exit;
        }

        // On récupère toutes les commandes de l'utilisateur
        $orders = Order::findByUser($userId);

        // Pour chaque commande, on récupère les articles associés
        $ordersWithItems = [];

        foreach ($orders as $order) {
            $items = OrderItem::findByOrder((int) $order['id']);

            $ordersWithItems[] = [
                'order' => $order,
                'items' => $items,
            ];
        }

        $this->render('user/orders', [
            'ordersWithItems' => $ordersWithItems,
        ]);
    }
}
