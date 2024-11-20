@extends('layout.main') 

@section('content')
    <div class="container mx-auto p-4">
        <div class="flex flex-wrap -mx-4 mb-10">
            <!-- Detail Profil -->
            <div class="w-full px-4">
                <div class="bg-white rounded-lg shadow p-6">
                    <h6 class="text-lg font-bold text-blue-500 mb-4">Detail Profil</h6>
                    <form id="editForm" method="POST" class="space-y-4">
                        <!-- Nama -->
                        <div>
                            <label for="display_name" class="block text-gray-700 font-medium">Nama</label>
                            <input type="text" id="display_name" name="display_name" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <!-- Username -->
                        <div>
                            <label for="username" class="block text-gray-700 font-medium">Username</label>
                            <input type="text" id="nama" name="nama" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <!-- Password Lama -->
                        <div>
                            <label for="user-old-pass" class="block text-gray-700 font-medium">Password Lama</label>
                            <input type="password" id="user-old-pass" name="old-password" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <!-- Password Baru -->
                        <div>
                            <label for="user-new-pass" class="block text-gray-700 font-medium">Password Baru</label>
                            <input type="password" id="user-new-pass" name="new-password" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <!-- Konfirmasi Password -->
                        <div>
                            <label for="user-confirm-pass" class="block text-gray-700 font-medium">Konfirmasi Password</label>
                            <input type="password" id="user-confirm-pass" name="confirm-password" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <!-- Tombol Edit Profil -->
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                Edit Profil
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

