<?php

use Core\App;
use Core\Database;

requireAdmin();

$db = App::resolve(Database::class);
$clubs = $db->query('SELECT id, name FROM clubs ORDER BY name ASC')->findAll();
$errors = [];

$clubId = $_POST['club_id'] ?? '';
$title = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');
$eventDate = normalizeDatetime(trim($_POST['event_date'] ?? ''));
$type = $_POST['type'] ?? 'event';
$isHighlight = isset($_POST['is_highlight']) ? 1 : 0;

if (!Core\Validator::string($title, 1, 255)) {
    $errors['title'] = 'Event title is required (max 255 characters).';
}

if (!Core\Validator::string($eventDate, 1, 25)) {
    $errors['event_date'] = 'Event date is required.';
}

$club = $db->query('SELECT id FROM clubs WHERE id = ?', [$clubId])->find();
if (!$club) {
    $errors['club_id'] = 'Please select a valid club.';
}

$allowedTypes = ['event', 'deadline', 'meeting'];
if (!in_array($type, $allowedTypes, true)) {
    $errors['type'] = 'Please select a valid event type.';
}

$upload = handleEventMediaUpload($_FILES['media'] ?? []);
if ($upload['error']) {
    $errors['media'] = $upload['error'];
}

if (!empty($errors)) {
    return view('admin/events/form.view.php', [
        'heading' => 'Add Event',
        'event' => $_POST,
        'clubs' => $clubs,
        'errors' => $errors,
    ]);
}

$db->query(
    'INSERT INTO events (club_id, title, description, event_date, media_url, media_type, type, is_highlight)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?)',
    [
        $clubId,
        $title,
        $description ?: null,
        $eventDate,
        $upload['path'],
        $upload['type'],
        $type,
        $isHighlight,
    ]
);

redirect('/admin/events');
