
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel - AAU Clubs</title>
  <link rel="stylesheet" href="/style.css">
</head>

<body class="admin-page">

<?php view("partials/header.php") ?>

<main class="admin-main">
  <h1>AAU Clubs - Admin Dashboard</h1>

  <?php view("admin/partials/nav.php") ?>

  <table class="admin-table">
    <tr>
      <th>ID</th>
      <th>Full Name</th>
      <th>Email</th>
      <th>Club</th>
      <th>Role</th>
      <th>Created At</th>
    </tr>

    <?php if ($users): ?>
      <?php foreach ($users as $user): ?>
        <tr>
          <td><?= $user['id'] ?></td>
          <td><?= htmlspecialchars($user['full_name']) ?></td>
          <td><?= htmlspecialchars($user['email']) ?></td>
          <td><?= htmlspecialchars($user['club']) ?></td>
          <td><?= htmlspecialchars($user['role']) ?></td>
          <td><?= $user['created_at'] ?></td>
        </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr><td colspan="6">No users found</td></tr>
    <?php endif; ?>
  </table>
</main>

</body>
</html>
