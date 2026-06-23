<?php

use Core\App;
use Core\Database;

requireAdmin();

$db = App::resolve(Database::class);
$errors = [];

$id = $_POST['id'] ?? null;

if (!$id) {
    abort();
}

$event = $db->query('SELECT * FROM events WHERE id = ?', [$id])->find();

if (!$event) {
    abort();
}

$clubs = $db->query('SELECT id, name FROM clubs ORDER BY name ASC')->findAll();

$clubId = $_POST['club_id'] ?? '';
$title = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');
$eventDate = normalizeDatetime(trim($_POST['event_date'] ?? ''));
$type = $_POST['type'] ?? 'event';
$isHighlight = isset($_POST['is_highlight']) ? 1 : 0;
$currentMediaUrl = $_POST['current_media_url'] ?? $event['media_url'];
$currentMediaType = $_POST['current_media_type'] ?? $event['media_type'];

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

$upload = handleEventMediaUpload($_FILES['media'] ?? [], $currentMediaUrl, $currentMediaType);
if ($upload['error']) {
    $errors['media'] = $upload['error'];
}

if (!empty($errors)) {
    return view('admin/events/form.view.php', [
        'heading' => 'Edit Event',
        'event' => array_merge($event, $_POST, [
            'media_url' => $currentMediaUrl,
            'media_type' => $currentMediaType,
        ]),
        'clubs' => $clubs,
        'errors' => $errors,
    ]);
}

$db->query(
    'UPDATE events
     SET club_id = ?, title = ?, description = ?, event_date = ?, media_url = ?, media_type = ?, type = ?, is_highlight = ?
     WHERE id = ?',
    [
        $clubId,
        $title,
        $description ?: null,
        $eventDate,
        $upload['path'],
        $upload['type'],
        $type,
        $isHighlight,
        $id,
    ]
);

redirect('/admin/events');
