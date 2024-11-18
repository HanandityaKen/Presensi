@extends('layout.main') 

@section('content')

<div class="container mx-auto p-4">
    
    <div class="bg-white shadow-md rounded-lg p-6">
        <!-- <h2 class="text-2xl text-blue-500 font-semibold mb-6">Work Hour</h2> -->
        <div class="mb-6">
            <h2 class="text-2xl text-blue-500 font-semibold">Jam Kerja</h2>
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
                                Waktu Masuk
                            </span>
                        </th>
                        <th>
                            <span class="flex items-center">
                                Waktu Keluar
                            </span>
                        </th>
                        <th>
                            <span class="flex items-center">
                                Action
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($workHours as $index => $workHour)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$workHour->clock_in}}</td>
                            <td>{{$workHour->clock_out}}</td>
                            <td>
                                <a href="{{route('admin.work-hour.edit', $workHour->id)}}">
                                    <button class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 ml-2">
                                        Update
                                    </button>
                                </a>
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
    if (document.getElementById("search-table") && typeof simpleDatatables.DataTable !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#search-table", {
            searchable: true,
            sortable: false
        });
    } 
</script>
@endpush

