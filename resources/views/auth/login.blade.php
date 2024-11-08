<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <!-- Tailwind CSS CDN -->
  {{-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" /> --}}
  @vite('resources/css/app.css')
  <!-- FontAwesome Icons CDN -->
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
  <div class="flex flex-col md:flex-row w-full h-screen">
    
    <!-- Right Side with Rounded Right Edge (Sign in form on the Left) -->
    <div class="md:w-1/2 w-full bg-blue-500 flex justify-center items-center">
      <div class="w-full h-full bg-white md:rounded-r-3xl p-8 md:p-16 flex flex-col justify-center shadow-lg">
        <h2 class="text-4xl font-semibold text-gray-700 mb-6">Login</h2>
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="mb-6">
            <input type="text" name="username" placeholder="Username" class="w-full py-3 px-4 border rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
          <div class="mb-6">
            <input type="password" name="password" placeholder="Password" class="w-full py-3 px-4 border rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
          <button type="submit" class="w-full bg-blue-500 text-white py-3 px-4 rounded-2xl font-semibold hover:bg-blue-600">Login</button>
        </form>

        <div class="mt-8 text-center">
          <p>Atau Masuk dengan platform sosial</p>
          <div class="flex justify-center space-x-6 mt-4">
            <a href="#" class="text-gray-500 hover:text-blue-600"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="text-gray-500 hover:text-blue-600"><i class="fab fa-twitter"></i></a>
            <a href="#" class="text-gray-500 hover:text-blue-600"><i class="fab fa-google"></i></a>
            <a href="#" class="text-gray-500 hover:text-blue-600"><i class="fab fa-linkedin-in"></i></a>
          </div>
        </div>
      </div>
    </div>

    <!-- Left Side (Blue background with Sign Up prompt) -->
    <div class="md:w-1/2 w-full bg-blue-500 text-white p-8 md:p-16 flex flex-col items-center justify-center">
      <h2 class="text-4xl font-semibold mb-4">Selamat Datang</h2>
      <p class="text-center mb-6">Masuk untuk mengakses dashboard pribadi Anda dan banyak lagi.</p>
      <!-- <a href="#" class="bg-white text-blue-500 py-2 px-6 rounded-full font-semibold">Sign Up</a> -->
      <div class="flex justify-center items-center mb-8">
                <img src="{{ asset('assets/login.png') }}" alt="Illustration" class="w-25 h-auto hidden md:block">
            </div>
    </div>
    
  </div>
</body>
</html>
