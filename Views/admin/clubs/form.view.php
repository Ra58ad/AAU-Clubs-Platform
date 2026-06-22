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
    $isEdit = !empty($club['id']);
    $action = $isEdit ? '/admin/clubs/update' : '/admin/clubs';
    $currentHeroImage = $club['hero_image'] ?? '';
  ?>

  <form action="<?= $action ?>" method="POST" enctype="multipart/form-data" class="admin-form">
    <?php if ($isEdit): ?>
      <input type="hidden" name="id" value="<?= $club['id'] ?>">
      <input type="hidden" name="current_hero_image" value="<?= htmlspecialchars($currentHeroImage) ?>">
    <?php endif; ?>

    <div class="admin-form-row">
      <div class="form-group">
        <label for="name">Club Name</label>
        <input type="text" name="name" id="name" value="<?= htmlspecialchars($club['name'] ?? '') ?>" required>
        <?php if (isset($errors['name'])): ?>
          <p class="form-error"><?= $errors['name'] ?></p>
        <?php endif; ?>
      </div>

      <div class="form-group">
        <label for="slug">Slug</label>
        <input type="text" name="slug" id="slug" value="<?= htmlspecialchars($club['slug'] ?? '') ?>" placeholder="auto-generated from name if left blank">
        <?php if (isset($errors['slug'])): ?>
          <p class="form-error"><?= $errors['slug'] ?></p>
        <?php endif; ?>
      </div>
    </div>

    <div class="form-group">
      <label for="description">Short Description</label>
      <textarea name="description" id="description" rows="4"><?= htmlspecialchars($club['description'] ?? '') ?></textarea>
    </div>

    <div class="form-group">
      <label for="about_us">About Us</label>
      <textarea name="about_us" id="about_us" rows="6"><?= htmlspecialchars($club['about_us'] ?? '') ?></textarea>
    </div>

    <div class="admin-form-row">
      <div class="form-group">
        <label for="contact_email">Contact Email</label>
        <input type="email" name="contact_email" id="contact_email" value="<?= htmlspecialchars($club['contact_email'] ?? '') ?>">
        <?php if (isset($errors['contact_email'])): ?>
          <p class="form-error"><?= $errors['contact_email'] ?></p>
        <?php endif; ?>
      </div>

      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone" value="<?= htmlspecialchars($club['phone'] ?? '') ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="hero_image">Hero Image</label>
      <?php if ($currentHeroImage): ?>
        <div class="hero-image-preview">
          <img src="<?= imageSrc($currentHeroImage) ?>" alt="Current hero image">
        </div>
      <?php endif; ?>
      <input type="file" name="hero_image" id="hero_image" accept="image/jpeg,image/png,image/gif,image/webp">
      <p class="form-hint"><?= $isEdit ? 'Leave empty to keep the current image.' : 'Upload a JPG, PNG, GIF, or WebP image.' ?></p>
      <?php if (isset($errors['hero_image'])): ?>
        <p class="form-error"><?= $errors['hero_image'] ?></p>
      <?php endif; ?>
    </div>

    <div class="admin-form-actions">
      <button type="submit" class="btn btn-primary"><?= $isEdit ? 'Update Club' : 'Create Club' ?></button>
      <a href="/admin/clubs" class="btn btn-secondary">Cancel</a>
    </div>
  </form>
</main>

</body>
</html>
