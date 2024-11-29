@extends('layout.main') 

@section('content')

<div class="container mx-auto p-4">
    
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl text-blue-500 font-semibold mb-6">Data Role</h2>
            <a href="{{route('admin.role.create')}}" class="px-3 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Tambah data</a>
        </div>
        @if (session('success'))
            <div class="flex items-center p-4 mt-5 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif
        <div class="overflow-x-auto mt-2">
            <!-- <table class="min-w-full bg-white border border-gray-300"> -->
            <!-- <table class="min-w-full bg-white border-gray-300"> -->
            <table id="search-table">
                <thead>
                    <tr class="border-b">
                        <th><span class="flex items-center">No</span></th>
                        <th><span class="flex items-center">Nama</span></th>
                        <th><span class="flex items-center">Action</span></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $index => $role)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$role->name}}</td>
                            <td>
                                <button 
                                    class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600 ml-2"
                                    onclick="confirmDelete({{ $role->id }})">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                <form id="delete-form-{{ $role->id }}" action="{{route('admin.role.destroy', $role->id)}}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr> 
                    @empty

                    @endforelse
                </tbody>
            </table>
            
            {{-- <table id="role-table">
                <thead>
                    <tr>
                        <th>
                            <span class="flex items-center">
                                No
                            </span>
                        </th>
                        <th>
                            <span class="flex items-center">
                                Nama Role
                            </span>
                        </th>
                        <th>
                            <span class="flex items-center">
                                Aksi
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $index => $role)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$role->name}}</td>
                            <td>
                                <button 
                                    class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 ml-2"
                                    onclick="confirmDelete({{ $role->id }})">
                                    Hapus
                                </button>
                                <form id="delete-form-{{ $role->id }}" action="{{route('role.destroy', $role->id)}}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>
                                <span>Data Not Found</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table> --}}
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script>
        // $(document).ready(function() {
        //     if ($("#role-table").length) {
        //         const dataTable = new simpleDatatables.DataTable("#role-table", {
        //             searchable: true,
        //             sortable: false
        //         });
        //     }
        // });

        if (document.getElementById("search-table") && typeof simpleDatatables.DataTable !== 'undefined') {
            const dataTable = new simpleDatatables.DataTable("#search-table", {
                searchable: true,
                sortable: false
            });
        }

        function confirmDelete(roleId) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data role akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#delete-form-${roleId}`).submit();
                }
            })
        }

    </script>
    

@endpush
