<?php

namespace App\Services;

class Router
{
    private static $route_list = [];
    public static function get($uri, $controller, $is_private = false) : void {
        self::$route_list[] = [
            "uri"           => $uri,
            "controller"    => $controller,
            'type'          => 'get',
            'private'       => $is_private,
        ];
    }

    public static function post (string $uri, $controller ,string $method) : void {
        self::$route_list[] = [
            "uri"           => $uri,
            "controller"    => $controller,
            'method'        => $method,
            'type'          => "post"
        ];
    }


    private static function format_post_data (array $data) : array {
        $result = [];
        foreach($data as $key => $value) {
            $result[$key] = htmlspecialchars($value);
        }
        return $result;
    }

    public static function enable() : void {
        $query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $routeFound = false;
        foreach (self::$route_list as $route) {
            if ($route['uri'] === $query) {
                if($route['type'] == 'post' && $_SERVER['REQUEST_METHOD'] == 'POST') {
                    $action = new $route['controller'];
                    $method = $route['method'];
                    $action->$method(self::format_post_data($_POST));
                    die();
                } else {
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
        }
        if (!$routeFound) {
            header("Location: 404");
        }
    }

    public static function redirect($uri): void {
        header("Location: " . $uri);
    }
}
