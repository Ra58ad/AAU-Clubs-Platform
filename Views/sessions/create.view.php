
<?php require basePath("Views/partials/head.php") ?>

<body class="">

    <?php  require basePath("Views/partials/header.php") ?>

    <div
    class="flex  min-h-screen items-center justify-center py-10"
    >
        <div class="flex w-3/5 h-full items-center justify-center px-4 ">
            <div class=" bg-blue-50 shadow-base-300/20 z-1 w-full space-y-6 rounded-xl p-6 shadow-md sm:min-w-md lg:p-8">
                <div class="flex justify">
                    <h3 class="text-base-content mb-1.5 text-2xl font-semibold">Login</h3>
                </div>
                <div class="space-y-4">
                    <form action="/sessions" method="POST" class="mb-4 space-y-4" >
                        <div class="flex flex-col">
                            <label class="label-text" for="username">Username</label>
                            <input type="text" name="username" placeholder="Enter your username" class="mt-4 flex items-center border-2 border-black rounded-xl bg-white/5 pl-3 outline-1 -outline-offset-1 outline-gray-600 " id="username" required 
                            value="<?= old('username') ?>"/>
                            <?php 
                                if(isset($errors['username'])): ?>

                                    <p class="text-red-700 text-xs mt-3"><?= $errors['username'] ?></p>
                                    
                                <?php endif; ?>
                        </div>

                        <div class="flex flex-col">
                            <label class="label-text" for="password">Password</label>
                            <input id="password" name="password" class="mt-4 flex items-center border-2 border-black rounded-xl bg-white/5 pl-3 outline-1 -outline-offset-1 outline-gray-600 "type="password" placeholder="············" required />
                            <?php 
                                if(isset($errors['password'])): ?>

                                    <p class="text-red-700 text-xs mt-3"><?= $errors['password'] ?></p>
                                    
                                <?php endif; ?>
                        </div>
                        
                        <div class="bg-gray-50 sm:px-6">
                            <button type="submit"
                                class="inline-flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                OK
                            </button>
                        </div>
                    </form>
                
                </div>
            </div>
        </div>
    </div>

    <?php  require basePath("Views/partials/footer.php") ?>


</body>
</html>
