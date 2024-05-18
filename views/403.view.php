<?php require_once base_path('views/partials/head.php') ?>

<main>
    <!-- Your content -->
        <div class="w-screen h-screen grid place-items-center">
            <div class="w-1/2 h-1/2 p-4 bg-gray-200 rounded-md flex items-center justify-center flex-col gap-4 shadow-lg">
                <h1 class="text-3xl capitalize text-gray-500 font-black text-center">Access Forbidden : sorry you're not authorized to view this page</h1>
                <p class="block text-3xl text-gray-500">
                    <span class="uppercase">error code :</span> <span class="text-red-500 font-black">403</span>
                </p>
                <a href="/" class="block mt-4 px-3 py-2 border border-blue-500 rounded-md capitalize text-blue-500 cursor-pointer hover:bg-blue-600 hover:text-white">go home</a>
            </div>
        </div>
</main>
    
<?php require_once base_path('views/partials/footer.php') ?>