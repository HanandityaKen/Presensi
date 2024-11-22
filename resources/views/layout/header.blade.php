<header class="fixed top-0 bg-white w-full py-5 px-6 sm:px-12 flex z-50">
    <div class="w-full justify-between items-center lg:flex">
        <div class="flex items-center space-x-6">
            <button id="sidebarToggle">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path fill="currentColor" d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32-14.3 32 32z"/>
                </svg>
            </button>
            <span class="text-gray-500 font-semibold text-xl">Sistem Presensi</span>
        </div>
    </div>
    <div class="relative flex items-center space-x-4 mr-4">
        {{-- <img src="https://via.placeholder.com/30" alt="User Avatar" class="rounded-full w-8 h-8"> --}}
        <button id="dropdownToggle" class="flex items-center space-x-2 text-gray-500 hover:text-gray-700">
            <span>{{$admin->display_name}}</span>
            <svg id="dropdownIcon" class="w-4 h-4 translate-y-[2px] transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                <path fill="currentColor" d="M143 352.3L7 216.3C-2.3 207-2.3 192.9 7 183.6l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0L160 258.7l96.5-96.7c9.4-9.4 24.6-9.4 33.9 0L313 183.6c9.4 9.4 9.4 24.6 0 33.9L177 352.3c-9.4 9.4-24.6 9.4-34 0z"/>
            </svg>
        </button>
        <!-- Dropdown -->
        <div id="dropdownMenu" class="hidden absolute right-0 top-[50px] w-48 bg-white border border-gray-200 rounded-lg shadow-md">
            <a href="/profile-admin" class="flex items-center px-4 py-2 text-gray-500 hover:bg-gray-100">
                <i class="fas fa-user w-5 h-5 mr-3"></i>
                Akun
            </a>
            <form method="POST" action="{{ route('admin.logout.admin') }}">
                @csrf
                <button type="submit" class="flex items-center w-full text-left px-4 py-2 text-gray-500 hover:bg-gray-100">
                    <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
                    Logout
                </button>
            </form>
        </div>
    </div>
</header>

<script>
    document.getElementById('dropdownToggle').addEventListener('click', function () {
        const dropdownMenu = document.getElementById('dropdownMenu');
        dropdownMenu.classList.toggle('hidden');
    });
</script>

<!-- <script>
    document.getElementById('dropdownToggle').addEventListener('click', function () {
        const dropdownMenu = document.getElementById('dropdownMenu');
        const dropdownIcon = document.getElementById('dropdownIcon');

        // Toggle visibility of dropdown
        dropdownMenu.classList.toggle('hidden');

        // Toggle rotation of the icon
        if (dropdownMenu.classList.contains('hidden')) {
            dropdownIcon.style.transform = 'rotate(0deg)'; // Default (ke bawah)
        } else {
            dropdownIcon.style.transform = 'rotate(180deg)'; // Ke atas
        }
    });
</script> -->