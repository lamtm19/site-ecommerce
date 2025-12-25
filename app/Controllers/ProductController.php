<?php

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\Product;
use Mini\Models\Category;

class ProductController extends Controller
{
    // Liste des produits avec filtre par catégorie
    public function index()
    {
        $categoryId = null;
        if (!empty($_GET['category_id'])) {
            $categoryId = (int) $_GET['category_id'];
        }

        // Produits (filtrés ou non)
        $products = Product::findAll($categoryId);

        // Toutes les catégories (pour les filtres)
        $categories = Category::findAll();

        $this->render('product/index', [
            'products' => $products,
            'categories' => $categories,
            'categoryId' => $categoryId,
        ]);
    }

    // Détail d'un produit
    public function show()
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

        if ($id <= 0) {
            echo "Produit introuvable (id manquant).";
            return;
        }

        $product = Product::findById($id);

        if (!$product) {
            echo "Produit introuvable.";
            return;
        }

        $this->render('product/show', [
            'product' => $product,
        ]);
    }
}
