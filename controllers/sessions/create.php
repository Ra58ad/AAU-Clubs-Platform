<?php

view('sessions/create.view.php', [
        'heading' => 'Login',
        'errors' => Core\Session::get("errors"),
    ]);

