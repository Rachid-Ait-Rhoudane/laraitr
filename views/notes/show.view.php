<?php require_once base_path('views/partials/head.php') ?>

<?php require_once base_path('views/partials/nav.php') ?>

<?php require_once base_path('views/partials/banner.php') ?>

<main>
    <div class="bg-gray-200 mt-24 mx-auto max-w-7xl rounded-md">
    <!-- Your content -->
        <h1 class="capitalize py-8 bg-gray-100 px-2 border-2 border-gray-200 rounded-t-md">
            <span class="text-xl fon-bold text-blue-500">=></span> <?= htmlspecialchars($note['body']) ?>
        </h1>
        <div class="flex flex-row-reverse items-center gap-3 bg-gray-200 p-4">
            <form action="/note" method="POST">
                <input type="hidden" name="__method" value="DELETE" />
                <input type="hidden" name="id" value="<?= $note['id'] ?>" />
                <input class="block w-fit px-3 py-2 rounded-md border border-red-500 text-red-500 text-sm capitalize hover:bg-red-500 hover:text-white cursor-pointer" type="submit" value="delete" />
            </form>
            <a href = "/notes/edit?id=<?= $note['id'] ?>" class="block w-fit px-3 py-2 rounded-md border border-green-500 text-green-500 text-sm capitalize hover:bg-green-500 hover:text-white">
                edit
            </a>
            <a href = "/notes" class="block w-fit px-3 py-2 rounded-md border border-blue-500 text-blue-500 text-sm capitalize hover:bg-blue-500 hover:text-white">
                go back to notes
            </a>
        </div>
    </div>
</main>
    
<?php require_once base_path('views/partials/footer.php') ?>