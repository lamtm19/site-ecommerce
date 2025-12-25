<?php

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\Cart;
use Mini\Models\Product;

class CartController extends Controller
{
    // Get pour avoir l'id utilisateur
    private function getUserId(): ?int
    {
        return isset($_SESSION['user_id']) ? (int) $_SESSION['user_id'] : null;
    }


    // Affichage du panier
    public function index()
    {
        $userId = $this->getUserId();

        if (!$userId) {
            $this->render('cart/index', [
                'needLogin' => true,
                'items' => [],
                'total' => 0,
            ]);
            return;
        }

        $items = Cart::getItemsByUser($userId);
        $total = Cart::getTotalByUser($userId);

        $this->render('cart/index', [
            'needLogin' => false,
            'items' => $items,
            'total' => $total,
        ]);
    }

    // Ajout d'un produit au panier
    public function add()
    {
        $userId = $this->getUserId();

        if (!$userId) {
            header('Location: /auth/login');
            exit;
        }

        $productId = isset($_GET['product_id']) ? (int) $_GET['product_id'] : 0;

        if ($productId <= 0) {
            echo "Produit introuvable.";
            return;
        }

        $product = Product::findById($productId);

        if (!$product) {
            echo "Produit introuvable.";
            return;
        }

        Cart::addProduct($userId, $productId, 1);

        $_SESSION['flash_success'] = "Produit ajouté au panier avec succès.";


        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/cart/index'));
        exit;
    }

    // Suppression d'un produit du panier
    public function remove()
    {
        $userId = $this->getUserId();

        if (!$userId) {
            header('Location: /auth/login');
            exit;
        }

        $productId = isset($_GET['product_id']) ? (int) $_GET['product_id'] : 0;

        if ($productId <= 0) {
            header('Location: /cart/index');
            exit;
        }

        Cart::removeProduct($userId, $productId);

        header('Location: /cart/index');
        exit;
    }

    // Vider le panier
    public function clear()
    {
        $userId = $this->getUserId();

        if (!$userId) {
            header('Location: /auth/login');
            exit;
        }

        Cart::clearByUser($userId);

        header('Location: /cart/index');
        exit;
    }
}
