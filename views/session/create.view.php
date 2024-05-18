<?php require_once base_path('views/partials/head.php') ?>

<?php require_once base_path('views/partials/nav.php') ?>

<?php require_once base_path('views/partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-4xl py-6 sm:px-6 lg:px-8">
    <!-- Your content -->
        <form class="bg-gray-200 p-4 rounded-md flex flex-col gap-6" action="/login" method="POST">

            <h1 class="text-3xl font-bold capitalize text-center text-blue-900">
                login
            </h1>

            <?php if(error_exists('login_error')): ?>
                <span class="block text-xs text-red-500 text-center"><?= error('login_error') ?></span>
            <?php endif; ?>

            <div class="flex flex-col gap-2 capitalize">
                <label class="font-bold text-blue-800 capitalize" for="email">email</label>
                <input type="text" class="p-2 focus:outline-none rounded-md placeholder:capitalize" name="email" id="email" placeholder="enter your email : ******@example.com" value="<?= old('email') ?>" />
                <?php if(error_exists('email')): ?>
                    <span class="block text-xs text-red-500"><?= error('email') ?></span>
                <?php endif; ?>
            </div>

            <div class="flex flex-col gap-2 capitalize">
                <label class="font-bold text-blue-800 capitalize" for="password">password</label>
                <input type="password" class="p-2 focus:outline-none rounded-md placeholder:capitalize" name="password" id="password" placeholder="enter your password : *********" />
                <?php if(error_exists('password')): ?>
                    <span class="block text-xs text-red-500"><?= error('password') ?></span>
                <?php endif; ?>
            </div>

            <div class="flex flex-row-reverse items-center gap-3 text-sm">
                <button class="px-3 py-2 border border-blue-500 rounded-md text-blue-500 capitalize hover:bg-blue-500 hover:text-white">
                    submit
                </button>
                <a href="/notes"  class="block px-3 py-2 border border-red-500 rounded-md text-red-500 capitalize hover:bg-red-500 hover:text-white">
                    cancel
                </a>
            </div>
        </form>
    </div>
</main>
    
<?php require_once base_path('views/partials/footer.php') ?>