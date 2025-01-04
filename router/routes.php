<?php 
App\Services\Router::get("/","IndexController@index");
App\Services\Router::get('/test', 'TestController@index');
App\Services\Router::get('/signIn','LoginController@index');
App\Services\Router::get("/404", "Controller404@index");
App\Services\Router::get("/logout", "AuthController@logout");

App\Services\Router::post("/auth/register", App\Controller\AuthController::class, "register");
App\Services\Router::post("/auth/login", App\Controller\AuthController::class, "login");

App\Services\Router::enable();
?>