<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite('resources/css/app.css')
</head>
<body class="bg-blue-50 text-gray-800">

    <div class="flex h-screen">

        <!-- Sidebar -->
        @include('layout.sidebar')

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto">
            
            <!-- Header -->
            @include('layout.header')

            <!-- Page Content -->
            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const toggleButton = document.getElementById('sidebarToggle');

        // Cek apakah elemen ada sebelum menambahkan event listener
        if (sidebar && toggleButton) {
            toggleButton.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
            });
        }
    });
</script>

@stack('scripts')


</body>
</html>
