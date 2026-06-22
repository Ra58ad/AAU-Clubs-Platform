<?php 

use \Core\Router;


$router->get("/", "index.php");

$router->get("/admin", "admin.php");

$router->get("/admin/clubs", "admin/clubs/index.php");
$router->get("/admin/clubs/create", "admin/clubs/create.php");
$router->post("/admin/clubs", "admin/clubs/store.php");
$router->get("/admin/clubs/edit", "admin/clubs/edit.php");
$router->post("/admin/clubs/update", "admin/clubs/update.php");
$router->delete("/admin/clubs", "admin/clubs/destroy.php");

$router->get("/admin/events", "admin/events/index.php");
$router->get("/admin/events/create", "admin/events/create.php");
$router->post("/admin/events", "admin/events/store.php");
$router->get("/admin/events/edit", "admin/events/edit.php");
$router->post("/admin/events/update", "admin/events/update.php");
$router->delete("/admin/events", "admin/events/destroy.php");

$router->get("/clubs", "clubs/index.php");

$router->get("/club", "clubs/show.php");

$router->get("/key-dates", "dates/index.php");

$router->get("/contact", "contact.php");

$router->get('/register', 'registration/create.php');

$router->post('/register', 'registration/store.php');

$router->get('/login', 'sessions/create.php');

$router->post('/sessions', 'sessions/store.php');

$router->delete('/logout','sessions/destroy.php');
