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

  <div class="admin-toolbar">
    <a href="/admin/events/create" class="btn btn-primary">Add Event</a>
  </div>

  <table class="admin-table">
    <tr>
      <th>ID</th>
      <th>Title</th>
      <th>Club</th>
      <th>Date</th>
      <th>Type</th>
      <th>Highlight</th>
      <th>Actions</th>
    </tr>

    <?php if ($events): ?>
      <?php foreach ($events as $event): ?>
        <tr>
          <td><?= $event['id'] ?></td>
          <td><?= htmlspecialchars($event['title']) ?></td>
          <td><?= htmlspecialchars($event['club_name'] ?? '—') ?></td>
          <td><?= $event['event_date'] ?></td>
          <td><?= htmlspecialchars($event['type']) ?></td>
          <td><?= $event['is_highlight'] ? 'Yes' : 'No' ?></td>
          <td class="admin-actions">
            <a href="/admin/events/edit?id=<?= $event['id'] ?>" class="btn btn-secondary">Edit</a>
            <form method="POST" action="/admin/events" onsubmit="return confirm('Delete this event?');">
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="id" value="<?= $event['id'] ?>">
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr><td colspan="7">No events found.</td></tr>
    <?php endif; ?>
  </table>
</main>

</body>
</html>
