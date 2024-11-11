@extends('layout.main') <!-- Sesuaikan dengan layout yang kamu gunakan -->

@section('content')

<!-- Contoh tampilan tabel dengan Tailwind CSS -->
<div class="container mx-auto p-4">
    
    <!-- Card container for the table -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl text-blue-500 font-semibold mb-6">Data User</h2>
        <button class="mb-6 px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Tambah data</button>
        <div class="overflow-x-auto">
            <!-- <table class="min-w-full bg-white border border-gray-300"> -->
            <table class="mt-2 min-w-full bg-white border-gray-300">
                <thead>
                    <tr class="border-b">
                        <th class="text-left px-4 py-2">No</th>
                        <th class="text-left px-4 py-2">Nama Item</th>
                        <th class="text-left px-4 py-2">Deskripsi</th>
                        <th class="text-left px-4 py-2">Harga</th>
                        <th class="text-left px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Ulangi elemen <tr> ini sesuai jumlah data yang ingin ditampilkan -->
                    <tr class="border-b">
                        <td class="px-4 py-2">1</td>
                        <td class="px-4 py-2">Item 1</td>
                        <td class="px-4 py-2">Deskripsi Item 1</td>
                        <td class="px-4 py-2">Rp. 100,000</td>
                        <td class="px-4 py-2">
                            <!-- Action buttons -->
                            <button class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Lihat</button>
                            <button class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 ml-2">Edit</button>
                            <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 ml-2">Hapus</button>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2">2</td>
                        <td class="px-4 py-2">Item 2</td>
                        <td class="px-4 py-2">Deskripsi Item 2</td>
                        <td class="px-4 py-2">Rp. 200,000</td>
                        <td class="px-4 py-2">
                            <button class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Lihat</button>
                            <button class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 ml-2">Edit</button>
                            <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 ml-2">Hapus</button>
                        </td>
                    </tr>
                    <!-- Tambahkan lebih banyak item sesuai kebutuhan -->
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="mt-4 flex justify-between items-center">
            <div class="text-gray-600">
                Menampilkan 1 sampai 10 dari 50 data
            </div>
            <div class="flex space-x-2">
                <button class="px-3 py-1 bg-gray-200 text-gray-600 rounded hover:bg-gray-300">Sebelumnya</button>
                <button class="px-3 py-1 bg-gray-200 text-gray-600 rounded hover:bg-gray-300">1</button>
                <button class="px-3 py-1 bg-gray-200 text-gray-600 rounded hover:bg-gray-300">2</button>
                <button class="px-3 py-1 bg-gray-200 text-gray-600 rounded hover:bg-gray-300">3</button>
                <button class="px-3 py-1 bg-gray-200 text-gray-600 rounded hover:bg-gray-300">Selanjutnya</button>
            </div>
        </div>
    </div>
</div>

@endsection