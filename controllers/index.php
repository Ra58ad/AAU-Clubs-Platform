<?php

$name = $_SESSION['username']??"Guest";
view('index.view.php', [
    'heading' => 'Min Blog',
    'name' => $name,
]);
