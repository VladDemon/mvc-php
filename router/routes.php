<?php 
App\Services\Route::route("/","IndexController@index");
App\Services\Route::route('/test', 'TestController@index');
App\Services\Route::route('/signIn','LoginController@index');
App\Services\Route::route('/register','RegisterController@index');
App\Services\Route::route("/404", "Controller404@index");


App\Services\Route::enable();
?>