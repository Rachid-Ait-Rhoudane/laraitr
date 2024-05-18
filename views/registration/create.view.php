<?php require_once base_path('views/partials/head.php') ?>

<?php require_once base_path('views/partials/nav.php') ?>

<?php require_once base_path('views/partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-4xl py-6 sm:px-6 lg:px-8">
    <!-- Your content -->
        <form class="bg-gray-200 p-4 rounded-md flex flex-col gap-6" action="/register" method="POST">

            <h1 class="text-3xl font-bold capitalize text-center text-blue-900">create a new note</h1>

            <div class="flex flex-col gap-2 capitalize">
                <label class="font-bold text-blue-800 capitalize" for="firstname">first name</label>
                <input type="text" class="p-2 focus:outline-none rounded-md placeholder:capitalize" name="firstname" id="firstname" placeholder="enter your first name" value="<?= old('firstname') ?>" />
                <?php if(error_exists('firstname')): ?>
                    <span class="text-xs text-red-500"><?= error('firstname') ?></span>
                <?php endif; ?>
            </div>

            <div class="flex flex-col gap-2 capitalize">
                <label class="font-bold text-blue-800 capitalize" for="lastname">last name</label>
                <input type="text" class="p-2 focus:outline-none rounded-md placeholder:capitalize" name="lastname" id="lastname" placeholder="enter your last name" value="<?= old('lastname') ?>" />
                <?php if(error_exists('lastname')): ?>
                    <span class="text-xs text-red-500"><?= error('lastname') ?></span>
                <?php endif; ?>
            </div>

            <div class="flex flex-col gap-2 capitalize">
                <label class="font-bold text-blue-800 capitalize" for="username">username</label>
                <input type="text" class="p-2 focus:outline-none rounded-md placeholder:capitalize" name="username" id="username" placeholder="enter your username" value="<?= old('username') ?>" />
                <?php if(error_exists('username')): ?>
                    <span class="text-xs text-red-500"><?= error('username') ?></span>
                <?php endif; ?>
            </div>

            <div class="flex flex-col gap-2 capitalize">
                <label class="font-bold text-blue-800 capitalize" for="email">email</label>
                <input type="text" class="p-2 focus:outline-none rounded-md placeholder:capitalize" name="email" id="email" placeholder="enter your email : ******@example.com" value="<?= old('email') ?>" />
                <?php if(error_exists('email')): ?>
                    <span class="text-xs text-red-500"><?= error('email') ?></span>
                <?php endif; ?>
            </div>

            <div class="flex flex-col gap-2 capitalize">
                <label class="font-bold text-blue-800 capitalize" for="password">password</label>
                <input type="password" class="p-2 focus:outline-none rounded-md placeholder:capitalize" name="password" id="password" placeholder="enter your password : *********" />
                <?php if(error_exists('password')): ?>
                    <span class="text-xs text-red-500"><?= error('password') ?></span>
                <?php endif; ?>
            </div>

            <div class="flex flex-col gap-2 capitalize">
                <label class="font-bold text-blue-800 capitalize" for="confirm_password">confitm password</label>
                <input type="password" class="p-2 focus:outline-none rounded-md placeholder:capitalize" name="confirm_password" id="confirm_password" placeholder="confirm your password" />
                <?php if(error_exists('confirm_password')): ?>
                    <span class="text-xs text-red-500"><?= error('confirm_password') ?></span>
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