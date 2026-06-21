<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$query = "SELECT * FROM events ORDER BY event_date ASC";

$items = $db->query($query)->findAll();
$upcomingEvents = filterByType($items, 'event');
$deadlines = filterByType($items, 'deadline');
$meetings = filterByType($items, 'meeting');


view('dates/index.view.php', [
    'upcomingEvents' => $upcomingEvents,
    'deadlines' => $deadlines,
    'meetings' => $meetings
]);
