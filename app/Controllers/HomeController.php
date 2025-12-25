<?php

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\Product;
use Mini\Models\Category;

class HomeController extends Controller
{
    // Page d'accueil
    public function index()
    {
        $products = Product::findAll();

        $categories = Category::findAll();

        $this->render('main/index', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
