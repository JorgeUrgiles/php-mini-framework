<nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl flex h-16 items-center justify-center">
        <div class="flex gap-4">
            <a href="/" class="<?= tint_slected_nav_item('/') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?> rounded-md px-3 py-2 text-sm font-medium">Inicio</a>
            <a href="/about" class="<?= tint_slected_nav_item('/about') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?> rounded-md px-3 py-2 text-sm font-medium">Acerca de</a>
            <a href="/links" class="<?= tint_slected_nav_item('/links')  ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?> rounded-md px-3 py-2 text-sm font-medium">Proyectos</a>
            <a href="/blog" class="<?= tint_slected_nav_item('/blog') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?> rounded-md px-3 py-2 text-sm font-medium">Blog</a>
            <?php if (isAuthenticated()) {?>
            <form action="/logout" method="POST">                
                <button type="submit" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium cursor-pointer">
                    Cerrar sesión
                </button>
            </form>
            <?php } else { ?>
            <a href="/login" class="<?= tint_slected_nav_item('login') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?> rounded-md px-3 py-2 text-sm font-medium">Iniciar sesión</a>
            <?php } ?>
        </div>
    </div>
</nav>