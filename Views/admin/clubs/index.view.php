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
    <a href="/admin/clubs/create" class="btn btn-primary">Add Club</a>
  </div>

  <table class="admin-table">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Slug</th>
      <th>Contact Email</th>
      <th>Phone</th>
      <th>Created</th>
      <th>Actions</th>
    </tr>

    <?php if ($clubs): ?>
      <?php foreach ($clubs as $club): ?>
        <tr>
          <td><?= $club['id'] ?></td>
          <td><?= htmlspecialchars($club['name']) ?></td>
          <td><?= htmlspecialchars($club['slug']) ?></td>
          <td><?= htmlspecialchars($club['contact_email'] ?? '') ?></td>
          <td><?= htmlspecialchars($club['phone'] ?? '') ?></td>
          <td><?= $club['created_at'] ?></td>
          <td class="admin-actions">
            <a href="/admin/clubs/edit?id=<?= $club['id'] ?>" class="btn btn-secondary">Edit</a>
            <form method="POST" action="/admin/clubs" onsubmit="return confirm('Delete this club? Related events will also be removed.');">
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="id" value="<?= $club['id'] ?>">
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr><td colspan="7">No clubs found.</td></tr>
    <?php endif; ?>
  </table>
</main>

</body>
</html>
