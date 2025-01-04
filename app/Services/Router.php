<?php

namespace App\Services;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Router
{
    private static $route_list = [];
    public static function page($uri, $controller) : void {
        self::$route_list[] = [
            "uri" => $uri,
            "controller" => $controller
        ];
    }

    public static function post (string $uri, string $method) : void {

    }

    public static function enable() : void {
        $query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $routeFound = false;

        $loader = new FilesystemLoader(__DIR__ . '/../View/');
        $twig = new Environment($loader);
        foreach (self::$route_list as $route) {
            if ($route['uri'] === $query) {
                $routeFound = true; 
                [$controller, $method] = explode('@', $route['controller']);
                $controller = "App\\Controller\\{$controller}";
                if (class_exists($controller) && method_exists($controller, $method)) {
                    $instance = new $controller();
                    echo $instance->$method();
                } else {
                    header("Location: 404");
                }
                break;
            }
        }
        if (!$routeFound) {
            header("Location: 404");
        }
    }
}
