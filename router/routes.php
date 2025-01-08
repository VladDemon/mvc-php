<?php 
App\Services\Router::get("/","IndexController@index", [App\Components\Middleware\AuthMiddleware::class]);
App\Services\Router::get('/test', 'TestController@index', [App\Components\Middleware\AuthMiddleware::class]);
App\Services\Router::get('/signIn','LoginController@index');
App\Services\Router::get("/404", "Controller404@index");
App\Services\Router::get("/logout", "AuthController@logout");
App\Services\Router::get('/profile', "ProfileController@index", [App\Components\Middleware\AuthMiddleware::class]);




App\Services\Router::post("/auth/register", App\Controller\AuthController::class, "register", [
    new App\Components\Middleware\ValidateMiddleware(
        [
            'name' => 'min:6',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]
    )
]);
App\Services\Router::post("/auth/login", App\Controller\AuthController::class, "login", [
    new App\Components\Middleware\ValidateMiddleware([
        'email' => 'required|email',
        'password' => 'required|min:6'
    ])
]);

App\Services\Router::enable();
?>