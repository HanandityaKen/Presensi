@extends('layout.main') 

@section('content')

<div class="container mx-auto p-4">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl text-blue-500 font-semibold mb-6">Edit Data User</h2>

        <form>
            <div class="mb-4">
                <label for="nama_item" class="block text-gray-700">
                    Nama Item
                    <span class="text-red-500 font-semibold">*</span> 
                </label>
                <input type="text" id="nama_item" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan nama item" required>
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700">
                    Deskripsi
                    <span class="text-red-500 font-semibold">*</span> 
                </label>
                <textarea id="deskripsi" rows="4" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan deskripsi" required></textarea>
            </div>

            <div class="mb-4">
                <label for="harga" class="block text-gray-700">
                    Harga
                    <span class="text-red-500 font-semibold">*</span> 
                </label>
                <input type="number" id="harga" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan harga" required>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection
