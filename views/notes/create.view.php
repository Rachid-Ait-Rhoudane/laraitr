<?php require_once base_path('views/partials/head.php') ?>

<?php require_once base_path('views/partials/nav.php') ?>

<?php require_once base_path('views/partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <!-- Your content -->
        <form class="bg-gray-200 p-4 rounded-md flex flex-col gap-6" action="/notes/create" method="POST">

            <h1 class="text-3xl font-bold capitalize text-center text-blue-900">create a new note</h1>

            <div class="flex flex-col gap-2 capitalize">
                <label class="text-xl font-bold text-blue-800" for="body">body</label>
                <textarea class="p-2 focus:outline-none rounded-md placeholder:capitalize h-40" name="body" id="body" placeholder="create a new note here"><?= $oldValue ?? '' ?></textarea>
                <?php if(isset($errors['body'])): ?>
                    <span class="text-xs text-red-500"><?= $errors['body'] ?></span>
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