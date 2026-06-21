<?php 

use \Core\Router;


$router->get("/", "index.php");

$router->get("/clubs", "clubs/index.php");

$router->get("/club", "clubs/show.php");

$router->get("/key-dates", "dates/index.php");

$router->get("/contact", "contact.php");

$router->get('/register', 'registration/create.php');

$router->post('/register', 'registration/store.php');

$router->get('/login', 'sessions/create.php');

$router->post('/sessions', 'sessions/store.php');

$router->delete('/logout','sessions/destroy.php');
