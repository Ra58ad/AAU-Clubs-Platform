<?php

requireAdmin();

view('admin/clubs/form.view.php', [
    'heading' => 'Add Club',
    'club' => null,
    'errors' => [],
]);
