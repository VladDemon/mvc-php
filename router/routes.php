<?php 
App\Services\Router::get("/","IndexController@index", [App\Components\Middleware\AuthMiddleware::class]);
App\Services\Router::get('/test', 'TestController@index', [App\Components\Middleware\AuthMiddleware::class]);
App\Services\Router::get('/signIn','LoginController@index');
App\Services\Router::get("/404", "Controller404@index");
App\Services\Router::get("/logout", "AuthController@logout", [App\Components\Middleware\AuthMiddleware::class]);
App\Services\Router::get('/profile', "Profile\ProfileController@index", [App\Components\Middleware\AuthMiddleware::class]);
App\Services\Router::get('/profile/edit', 'Profile\EditProfileController@page', [App\Components\Middleware\AuthMiddleware::class]);



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
App\Services\Router::post("/profile/edit/password/change", App\Controller\Profile\EditProfileController::class, 'pass_change', [
    new App\Components\Middleware\ValidateMiddleware([
        'password' => 'required|min:6'
    ])
]);
App\Services\Router::post("/profile/edit/name/change", App\Controller\Profile\EditProfileController::class, 'name_change', [
    new App\Components\Middleware\ValidateMiddleware([
        'name'  => "required|min:6"
    ])
]);
App\Services\Router::post("/profile/edit/email/change", App\Controller\Profile\EditProfileController::class, 'email_change', [
    new App\Components\Middleware\ValidateMiddleware([
        'email' => 'required|email',
    ])
]);

App\Services\Router::enable();
?>