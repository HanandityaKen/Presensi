<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-800">

    <div class="flex h-screen">

    <!-- Sidebar -->
    @include('layout.sidebar')

    <!-- Main Content -->
    <div class="flex-1 overflow-y-auto">
        
        <!-- Header -->
        @include('layout.header')

        <!-- Page Content -->
        <main id="mainContent" class="flex-1 p-6 pt-28 lg:ml-64 transition-all duration-300">
            @yield('content')
        </main>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const sidebar = $('#sidebar');
            const mainContent = $('#mainContent');

            // Pastikan sidebar terbuka saat halaman pertama dimuat
            sidebar.removeClass('-translate-x-full');
            mainContent.addClass('lg:ml-64');

            // Toggle Sidebar tanpa backdrop
            $('#sidebarToggle').click(function() {
                sidebar.toggleClass('-translate-x-full'); 

                if (sidebar.hasClass('-translate-x-full')) {
                    mainContent.removeClass('lg:ml-64');
                } else {
                    mainContent.addClass('lg:ml-64');
                }
            });

            $(window).resize(function() {
                if ($(window).width() >= 1024) {
                    sidebar.removeClass('-translate-x-full');
                    mainContent.addClass('lg:ml-64');
                } else {
                    sidebar.addClass('-translate-x-full');
                    mainContent.removeClass('lg:ml-64');
                }
            }).trigger('resize');
        });

    </script>


<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>

@stack('scripts')


</body>
</html>
