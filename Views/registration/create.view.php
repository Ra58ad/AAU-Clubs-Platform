
<?php require basePath("Views/partials/head.php") ?>

<body class="">

    <!-- Top Bar Nav -->
    <?php require basePath("Views/partials/header.php") ?>

    <div class="">
        <form action="/register" method="POST" class="mb-4 space-y-4" >
            <section id="register" class="section">
                <div class="container">
                    <div class="section-header"><h2>Join a Club</h2></div>
                    <?php if (isset($_GET['error']) && $_GET['error'] === 'email_taken') : ?>
                    <p style="color: red; text-align: center; font-weight: bold;">
                        This email is already registered. Please login or use a different email.
                    </p>
                    <?php endif; ?>
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="full_name" id="full_name" required>
                        <?php 
                            if(isset($errors['full_name'])): ?>

                                <p class="text-red-700 text-xs mt-3"><?= $errors['full_name'] ?></p>
                                
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" id="username" required>
                        <?php 
                            if(isset($errors['username'])): ?>

                                <p class="text-red-700 text-xs mt-3"><?= $errors['username'] ?></p>
                                
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="email" required>
                        <?php 
                            if(isset($errors['email'])): ?>

                                <p class="text-red-700 text-xs mt-3"><?= $errors['email'] ?></p>
                                
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
                    <div class="form-group">
                        <label>Select Club</label>
                        <select name="club" required>
                            <?php foreach ($clubs as $club): ?>
                                <option value="<?= $club['name'] ?>"><?= $club['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Registration</button>
                    <div style="display:flex; flex-direction: row;">
                        <input type="checkbox" class="" id="policyagreement" />
                        <label class=" p-0 " for="policyagreement">
                            I agree to
                            <a href="#" class="">privacy policy & terms</a>
                        </label>
                    </div>
                    <div class="form-group">
                        <p class=" mb-4 text-center">
                            Already have an account?
                            <a href="/login" class="">Sign in instead</a>
                        </p>
                    </div>
                </div>
            </section>
        </form>

        

    
    </div>

    <?php  require basePath("Views/partials/footer.php") ?>


</body>
</html>
