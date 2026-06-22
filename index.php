<?php

use Core\Router;

$heading = 'AAU Clubs';
const BASE_PATH = __DIR__ . '/';


require __DIR__ . '/Core/functions.php';

spl_autoload_register(function ($class){
    require basePath(str_replace('\\', '/', $class) . '.php');
});

session_start();

use Core\Container;
use Core\Database;
use Core\App;

$container = new Container();

$container->bind("Core\Database", function(){
    $config = require basePath('config.php');
    return new Database($config['database'], $config['username'], $config['password']);
});

App::setContainer($container);


$router = new Router();

$routes = require basePath('routes.php');

$url = parse_url($_SERVER['REQUEST_URI'])['path'];

$method =$_POST['_method']??$_SERVER['REQUEST_METHOD'];

try {

    $router->route($url, $method);
    
} catch(Core\ValidationException $exception) {

    Core\Session::flash('old', $exception->old);
    Core\Session::flash("errors", $exception->errors);
    return redirect($router->previousUrl());
}

Core\Session::unflash();
