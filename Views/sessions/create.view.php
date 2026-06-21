
<?php require basePath("Views/partials/head.php") ?>

<body class="">

    <?php  require basePath("Views/partials/header.php") ?>

    <div
    class=""
    >
        <form action="/sessions" method="POST" class="mb-4 space-y-4" >
            <section id="register" class="section">
                <div class="container">
                    <div class="section-header"><h2>Login</h2></div>

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" id="username" required>
                            <?php 
                                if(isset($errors['username'])): ?>

                                    <p class="text-red-700 text-xs mt-3"><?= $errors['username'] ?></p>
                                    
                            <?php endif; ?>
                        </div>
                        
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" id="password" required>
                            <?php 
                                if(isset($errors['password'])): ?>

                                    <p class="text-red-700 text-xs mt-3"><?= $errors['password'] ?></p>
                                    
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </section>
        </form>
                
    </div>

    <?php  require basePath("Views/partials/footer.php") ?>


</body>
</html>
