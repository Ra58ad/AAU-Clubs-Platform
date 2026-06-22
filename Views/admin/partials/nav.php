<nav class="admin-nav">
  <a href="/admin" class="<?= urlIs('/admin') ? 'active' : '' ?>">Users</a>
  <a href="/admin/clubs" class="<?= str_starts_with($_SERVER['REQUEST_URI'], '/admin/clubs') ? 'active' : '' ?>">Clubs</a>
  <a href="/admin/events" class="<?= str_starts_with($_SERVER['REQUEST_URI'], '/admin/events') ? 'active' : '' ?>">Events</a>
</nav>
