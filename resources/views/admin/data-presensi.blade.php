@extends('layout.main') 

@section('content')

<div class="container mx-auto p-4">
    
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl text-blue-500 font-semibold">Data Presensi</h2>
                <div class="flex space-x-4">
                    <div>
                        <label for="filter-criteria" class="block text-sm font-medium text-gray-500">Filter Berdasarkan</label>
                        <select id="filter-criteria" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="create_at">Tanggal</option>
                            <option value="all">Semua</option>
                            <option value="user">Nama User</option>
                            <option value="role">Role</option>
                            <option value="clock_in_time">Jam Masuk</option>
                            <option value="clock_out_time">Jam Keluar</option>
                        </select>
                    </div>
                    <div class="mt-5">
                        <button id="filter-button" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Filter</button> 
                        <!-- <button id="filter-button" class="px-4 py-2 border border-dashed border-blue-500 text-blue-500 rounded-xl hover:bg-blue-500 hover:text-white">Filter</button>  -->
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table id="search-table">
                    <thead>
                        <tr>
                            <th>
                                <span class="flex items-center">
                                    No
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center">
                                    Nama User
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center">
                                    Role
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center">
                                    Lokasi
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center">
                                    Jam Masuk
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center">
                                    Foto Masuk
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center">
                                    Jam Keluar
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center">
                                    Foto Keluar
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center">
                                    Tempat Bekerja
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center">
                                    Masuk
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($presences as $index => $presence)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{$presence->user->username}}</td>
                                <td>{{$presence->user->role->name}}</td>
                                <td>{{$presence->location}}</td>
                                <td>{{$presence->clock_in_time}}</td>
                                <td>
                                    <button data-modal-target="photo-modal-in-{{ $presence->id }}" data-modal-toggle="photo-modal-in-{{ $presence->id }}" class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 ml-2">
                                        Lihat
                                    </button>
                                    <!-- <button type="button" data-modal-target="photo-modal-in-{{ $presence->id }}" data-modal-toggle="photo-modal-in-{{ $presence->id }}" class="text-blue-500 hover:text-blue-700">
                                        <img src="{{ asset('storage/' . $presence->image_url_in) }}" alt="Foto Masuk" width="100">
                                    </button> -->
                                </td>
                                <td>{{$presence->clock_out_time ?? '-- : --'}}</td>
                                <td>
                                    <button data-modal-target="photo-modal-out-{{ $presence->id }}" data-modal-toggle="photo-modal-out-{{ $presence->id }}" class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 ml-2">
                                        Lihat
                                    </button>
                                    <!-- <button type="button" data-modal-target="photo-modal-out-{{ $presence->id }}" data-modal-toggle="photo-modal-out-{{ $presence->id }}" class="text-blue-500 hover:text-blue-700">
                                        <img src="{{ asset('storage/' . $presence->image_url_out) }}" alt="Foto Keluar" width="100">
                                    </button> -->
                                </td>
                                <td>{{$presence->work_place}}</td>
                                <td>{{$presence->create_at}}</td>
                            </tr>

                            <!-- Modal for Foto Masuk -->
                            <!-- <div id="photo-modal-in-{{ $presence->id }}" tabindex="-1" class="hidden overflow-y-auto fixed inset-0 z-50 justify-center items-center flex bg-black bg-opacity-50">
                                <div class="relative p-4 bg-white rounded-lg max-w-lg w-full">
                                    <button data-modal-toggle="photo-modal-in-{{ $presence->id }}" class="absolute top-0 right-0 p-2 text-gray-500">
                                        <span class="sr-only">Close modal</span>
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <img src="{{ asset('storage/' . $presence->image_url_in) }}" alt="Foto Masuk" class="max-w-full max-h-[60vh] mx-auto">
                                </div>
                            </div> -->
                            <div id="photo-modal-in-{{ $presence->id }}" class="fixed inset-0 z-50 hidden items-center justify-center bg-gray-800 bg-opacity-50">
                                <div class="bg-white p-4 rounded-lg w-1/3">
                                    <div class="flex justify-between items-center">
                                        <h5 class="text-xl font-semibold">Foto Masuk</h5>
                                        <button data-modal-toggle="photo-modal-in-{{ $presence->id }}" class="text-gray-500">
                                            <span class="sr-only">Close modal</span>
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="mt-4">
                                        <img src="{{ asset('storage/' . $presence->image_url_in) }}" alt="Foto Masuk" class="w-full">
                                    </div>
                                </div>
                            </div>


                            <!-- Modal for Foto Keluar -->
                            <!-- <div id="photo-modal-out-{{ $presence->id }}" tabindex="-1" class="hidden overflow-y-auto fixed inset-0 z-50 justify-center items-center flex bg-black bg-opacity-50">
                                <div class="relative p-4 bg-white rounded-lg max-w-lg w-full">
                                    <button data-modal-toggle="photo-modal-out-{{ $presence->id }}" class="absolute top-0 right-0 p-2 text-gray-500">
                                        <span class="sr-only">Close modal</span>
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <img src="{{ asset('storage/' . $presence->image_url_out) }}" alt="Foto Keluar" class="max-w-full max-h-[60vh] mx-auto">
                                </div>
                            </div> -->
                            <div id="photo-modal-out-{{ $presence->id }}" class="fixed inset-0 z-50 hidden items-center justify-center bg-gray-800 bg-opacity-50">
                                <div class="bg-white p-4 rounded-lg w-1/3">
                                    <div class="flex justify-between items-center">
                                        <h5 class="text-xl font-semibold">Foto Keluar</h5>
                                        <button data-modal-toggle="photo-modal-out-{{ $presence->id }}" class="text-gray-500">
                                            <span class="sr-only">Close modal</span>
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="mt-4">
                                        <img src="{{ asset('storage/' . $presence->image_url_out) }}" alt="Foto Keluar" class="w-full">
                                    </div>
                                </div>
                            </div>

                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
</div>

@endsection

@push('scripts')
<script>
    if (document.getElementById("search-table") && typeof simpleDatatables.DataTable !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#search-table", {
            searchable: true,
            sortable: false
        });
    }
</script>
@endpush
