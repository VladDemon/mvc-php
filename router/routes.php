<?php 
App\Services\Router::page("/","IndexController@index");
App\Services\Router::page('/test', 'TestController@index');
App\Services\Router::page('/signIn','LoginController@index');
App\Services\Router::page('/register','RegisterController@index');
App\Services\Router::page("/404", "Controller404@index");


App\Services\Router::enable();
?>