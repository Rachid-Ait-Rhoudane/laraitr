<?php require_once base_path('views/partials/head.php') ?>

<?php require_once base_path('views/partials/nav.php') ?>

<?php require_once base_path('views/partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">

    <!-- Your content -->
        <ul class="list-disc space-y-4">
            <?php foreach ($notes as $note) : ?>
                <li>
                    <a href="/notes/show/<?= $note['id'] ?>" class="text-blue-500 hover:underline">
                        <?= htmlspecialchars($note['body']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

        <p class="mt-6">
            <a href="/notes/create" class="px-3 py-2 border border-blue-500 text-blue-500 rounded-md hover:bg-blue-500 hover:text-white capitalize text-sm">
                create a new note
            </a>
        </p>

    </div>
</main>
    
<?php require_once base_path('views/partials/footer.php') ?>