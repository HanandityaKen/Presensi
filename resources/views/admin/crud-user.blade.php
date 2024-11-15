@extends('layout.main') 

@section('content')

<div class="container mx-auto p-4">
    
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl text-blue-500 font-semibold">Data User</h2>
            <a href="{{route('admin.user.create')}}" class="px-3 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Tambah data</a>
        </div>
        @if (session('success'))
            <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif
        <div class="overflow-x-auto">
            <!-- <table class="min-w-full bg-white border border-gray-300"> -->
            <table class="mt-2 min-w-full bg-white border-gray-300">
                <thead class="bg-gray-50">
                    <tr class="border-b">
                        <th class="px-4 py-4">
                            <span class="flex items-center">
                                No
                            </span>
                        </th>
                        <th class="px-4 py-4">
                            <span class="flex items-center">
                                Username
                            </span>
                        </th>
                        <th class="px-4 py-4">
                            <span class="flex items-center">
                                Role
                            </span>
                        </th>
                        <th class="px-4 py-4">
                            <span class="flex items-center">
                                Action
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $index => $user) 
                        <tr class="border-b">
                            <td class="px-4 py-2">{{$index + 1}}</td>
                            <td class="px-4 py-2">{{$user->username}}</td>
                            <td class="px-4 py-2">{{$user->role}}</td>
                            <td>
                                <a href="{{route('admin.user.edit', $user->id)}}">
                                    <button class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 ml-2">
                                        Update
                                    </button>
                                </a>
                                <button 
                                    class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 ml-2"
                                    onclick="confirmDelete({{ $user->id }})">
                                    Hapus
                                </button>
                                <form id="delete-form-{{ $user->id }}" action="{{route('admin.user.destroy', $user->id)}}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script>
        function confirmDelete(roleId) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data user akan dihapus secara permanen!",
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
