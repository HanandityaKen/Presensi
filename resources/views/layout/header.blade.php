<header class="fixed top-0 bg-white w-full py-4 px-6 sm:px-12 flex z-50">
    <div class="w-full justify-between items-center lg:flex">
        <div class="flex items-center space-x-6">
            <button id="sidebarToggle">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path fill="currentColor" d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32-14.3 32 32z"/>
                </svg>
            </button>
            <span class="text-blue-500 font-semibold text-xl">Sistem Presensi</span>
        </div>
    </div>
    <div class="flex items-center space-x-4 mr-4">
        <img src="https://via.placeholder.com/30" alt="User Avatar" class="rounded-full w-8 h-8">
        <span class="text-gray-500">{{$admin->display_name}}</span>
    </div>
</header>