<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  @vite('resources/css/app.css')
  <!-- FontAwesome Icons CDN -->
  <!-- <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</head>
<body class="bg-white flex justify-center items-center min-h-screen">
  <!-- Centered Login Form -->
  <div class="w-full max-w-md bg-white p-8 md:p-16 flex flex-col justify-center shadow-lg rounded-3xl">
    <h2 class="text-3xl font-semibold text-gray-700 mb-6 text-center">Login</h2>
    @if (session('error'))
      <div class="flex items-center p-4 mb-6 text-sm text-red-800 rounded-2xl bg-red-50" role="alert">
          <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
          </svg>
          <span class="sr-only">Info</span>
          <div>
              <span class="font-medium">{{session('error')}}</span>
          </div>
      </div>
    @endif
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
        <a href="{{route('oauth.google')}}" class="border border-gray-300 text-gray-700 font-bold py-2 px-4 rounded-2xl w-full flex items-center justify-center hover:bg-blue-400 hover:text-white gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="20px" height="20px" class="flex-shrink-0">
                <path fill="#EA4335" d="M24 9.5c3.5 0 6.2 1.4 8.1 2.6l6-6C34.6 3.1 29.8 1 24 1 14.7 1 7 6.8 3.3 14.2l7.6 5.8C12.7 13.1 17.9 9.5 24 9.5z"/>
                <path fill="#34A853" d="M46.4 24.1c0-1.5-.2-3-.5-4.4H24v8.9h12.7c-.5 3-2 5.5-4.1 7.3l6.3 4.9c3.6-3.3 5.7-8.1 5.7-13.8z"/>
                <path fill="#4A90E2" d="M9.9 27c-1.3-.9-2.4-2-3.2-3.3L0 27.4C2.8 32.6 7.9 36.4 14 37.4v-7.5c-2.4-.5-4.6-1.6-6.5-3.2z"/>
                <path fill="#FBBC05" d="M24 47c5.5 0 10.1-1.8 13.5-4.8l-6.3-4.9c-2.1 1.4-4.8 2.3-7.2 2.3-5.5 0-10.2-3.7-11.9-8.8H3.3v5.8C6.8 41.7 14.2 47 24 47z"/>
                <path fill="none" d="M0 0h48v48H0z"/>
            </svg>
            Login dengan Google
        </a>
      </div>
    </div>
  </div>
</body>
</html>
