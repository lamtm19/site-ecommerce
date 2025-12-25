<?php
declare(strict_types=1);

namespace Mini\Core;

final class Router
{
    /**
     * @var array<int, array{0:string,1:string,2:array{0:class-string,1:string}}>
     */
    private array $routes;

    public function __construct()
    {
        // On définit ici TOUTES les routes de ton projet
        $this->routes = [
            // Accueil
            ['GET', '/', [\Mini\Controllers\HomeController::class, 'index']],

            // Produits
            ['GET', '/product/index', [\Mini\Controllers\ProductController::class, 'index']],
            ['GET', '/product/show',  [\Mini\Controllers\ProductController::class, 'show']],

            // Panier
            ['GET', '/cart/index',  [\Mini\Controllers\CartController::class, 'index']],
            ['GET', '/cart/add',    [\Mini\Controllers\CartController::class, 'add']],
            ['GET', '/cart/remove', [\Mini\Controllers\CartController::class, 'remove']],
            ['GET', '/cart/clear',  [\Mini\Controllers\CartController::class, 'clear']],

            // Authentification
            ['GET',  '/auth/login',    [\Mini\Controllers\AuthController::class, 'login']],
            ['POST', '/auth/login',    [\Mini\Controllers\AuthController::class, 'login']],
            ['GET',  '/auth/register', [\Mini\Controllers\AuthController::class, 'register']],
            ['POST', '/auth/register', [\Mini\Controllers\AuthController::class, 'register']],
            ['GET',  '/auth/logout',   [\Mini\Controllers\AuthController::class, 'logout']],

            // Commandes
            ['GET',  '/order/checkout', [\Mini\Controllers\OrderController::class, 'checkout']],
            ['POST', '/order/confirm',  [\Mini\Controllers\OrderController::class, 'confirm']],

            // Espace client
            ['GET', '/user/orders', [\Mini\Controllers\UserController::class, 'orders']],
        ];
    }

    public function dispatch(string $method, string $uri): void
    {
        $path = parse_url($uri, PHP_URL_PATH) ?? '/';

        foreach ($this->routes as [$routeMethod, $routePath, $handler]) {
            if ($method === $routeMethod && $path === $routePath) {
                [$class, $action] = $handler;

                $controller = new $class();
                $controller->$action();

                return;
            }
        }

        http_response_code(404);
        echo '404 Not Found ('.$method.' '.$path.')';
    }
}
