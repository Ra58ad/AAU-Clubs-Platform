<?php

use Core\App;
use Core\Database;

requireAdmin();

$db = App::resolve(Database::class);

$events = $db->query(
    'SELECT events.*, clubs.name AS club_name
     FROM events
     LEFT JOIN clubs ON events.club_id = clubs.id
     ORDER BY events.event_date DESC'
)->findAll();

view('admin/events/index.view.php', [
    'heading' => 'Manage Events',
    'events' => $events,
]);
