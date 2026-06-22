<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($heading) ?> - Admin</title>
  <link rel="stylesheet" href="/style.css">
</head>
<body class="admin-page">

<?php view("partials/header.php") ?>

<main class="admin-main">
  <h1><?= htmlspecialchars($heading) ?></h1>

  <?php view("admin/partials/nav.php") ?>

  <?php
    $isEdit = !empty($event['id']);
    $action = $isEdit ? '/admin/events/update' : '/admin/events';
    $currentMediaUrl = $event['media_url'] ?? '';
    $currentMediaType = $event['media_type'] ?? '';
    $eventDateValue = !empty($event['event_date'])
        ? date('Y-m-d\TH:i', strtotime($event['event_date']))
        : '';
  ?>

  <form action="<?= $action ?>" method="POST" enctype="multipart/form-data" class="admin-form">
    <?php if ($isEdit): ?>
      <input type="hidden" name="id" value="<?= $event['id'] ?>">
      <input type="hidden" name="current_media_url" value="<?= htmlspecialchars($currentMediaUrl) ?>">
      <input type="hidden" name="current_media_type" value="<?= htmlspecialchars($currentMediaType) ?>">
    <?php endif; ?>

    <div class="form-group">
      <label for="club_id">Club</label>
      <select name="club_id" id="club_id" required>
        <option value="">Select a club</option>
        <?php foreach ($clubs as $club): ?>
          <option value="<?= $club['id'] ?>" <?= (string)($event['club_id'] ?? '') === (string)$club['id'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($club['name']) ?>
          </option>
        <?php endforeach; ?>
      </select>
      <?php if (isset($errors['club_id'])): ?>
        <p class="form-error"><?= $errors['club_id'] ?></p>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" name="title" id="title" value="<?= htmlspecialchars($event['title'] ?? '') ?>" required>
      <?php if (isset($errors['title'])): ?>
        <p class="form-error"><?= $errors['title'] ?></p>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label for="description">Description</label>
      <textarea name="description" id="description" rows="4"><?= htmlspecialchars($event['description'] ?? '') ?></textarea>
    </div>

    <div class="form-group">
      <label for="event_date">Date & Time</label>
      <input type="datetime-local" name="event_date" id="event_date" value="<?= $eventDateValue ?>" required>
      <?php if (isset($errors['event_date'])): ?>
        <p class="form-error"><?= $errors['event_date'] ?></p>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label for="type">Type</label>
      <select name="type" id="type" required>
        <?php foreach (['event' => 'Event', 'deadline' => 'Deadline', 'meeting' => 'Meeting'] as $value => $label): ?>
          <option value="<?= $value ?>" <?= ($event['type'] ?? 'event') === $value ? 'selected' : '' ?>>
            <?= $label ?>
          </option>
        <?php endforeach; ?>
      </select>
      <?php if (isset($errors['type'])): ?>
        <p class="form-error"><?= $errors['type'] ?></p>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label class="checkbox-label">
        <input type="checkbox" name="is_highlight" value="1" <?= !empty($event['is_highlight']) ? 'checked' : '' ?>>
        Show in club gallery (highlight)
      </label>
      <p class="form-hint">Unchecked events appear on the Key Dates page instead.</p>
    </div>

    <div class="form-group">
      <label for="media">Media (image or video)</label>
      <?php if ($currentMediaUrl): ?>
        <div class="hero-image-preview">
          <?php if ($currentMediaType === 'video'): ?>
            <video controls style="max-width:320px; max-height:180px;">
              <source src="<?= imageSrc($currentMediaUrl) ?>">
            </video>
          <?php else: ?>
            <img src="<?= imageSrc($currentMediaUrl) ?>" alt="Current event media">
          <?php endif; ?>
        </div>
      <?php endif; ?>
      <input type="file" name="media" id="media" accept="image/jpeg,image/png,image/gif,image/webp,video/mp4,video/webm,video/quicktime">
      <p class="form-hint"><?= $isEdit ? 'Leave empty to keep the current media.' : 'Optional. Upload an image or video.' ?></p>
      <?php if (isset($errors['media'])): ?>
        <p class="form-error"><?= $errors['media'] ?></p>
      <?php endif; ?>
    </div>

    <div class="admin-form-actions">
      <button type="submit" class="btn btn-primary"><?= $isEdit ? 'Update Event' : 'Create Event' ?></button>
      <a href="/admin/events" class="btn btn-secondary">Cancel</a>
    </div>
  </form>
</main>

</body>
</html>
