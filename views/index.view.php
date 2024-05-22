<?php require_once base_path('views/partials/head.php') ?>

<?php require_once base_path('views/partials/nav.php') ?>

<?php require_once base_path('views/partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <!-- Your content -->
        <h1 class="capitalize">
            hello <?= \core\Session::user('username') ?? 'Guest' ?>, and welcome to the home page.
        </h1>
    </div>
</main>
    
<?php require_once base_path('views/partials/footer.php') ?>