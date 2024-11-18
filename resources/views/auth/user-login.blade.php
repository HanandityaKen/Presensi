<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  @vite('resources/css/app.css')
  <!-- FontAwesome Icons CDN -->
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
</head>
<body class="bg-white flex justify-center items-center min-h-screen">
  <!-- Centered Login Form -->
  <div class="w-full max-w-md bg-white p-8 md:p-16 flex flex-col justify-center shadow-lg rounded-3xl">
    <h2 class="text-3xl font-semibold text-gray-700 mb-6 text-center">Login</h2>
    <form method="POST" action="{{ route('user.login.proses') }}">
      @csrf
      <div class="mb-6">
        <input type="text" name="username" placeholder="Username" class="w-full py-3 px-4 border rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        @error('username')
          <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-6">
        <input type="password" name="password" placeholder="Password" class="w-full py-3 px-4 border rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        @error('password')
          <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
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
</body>
</html>
