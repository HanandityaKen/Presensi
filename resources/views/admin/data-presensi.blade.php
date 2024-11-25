@extends('layout.main') 

@section('content')

<div class="container mx-auto p-4">
    
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl text-blue-500 font-semibold mb-6">Data Presensi</h2>
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
                                Username
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
                                Status
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
                            <td>{{$presence->location}}</td>
                            <td>{{$presence->clock_in_time}}</td>
                            <td>
                                <img src="{{ asset('storage/' . $presence->image_url_in) }}" alt="Image" width="100">
                            </td>
                            <td>{{$presence->clock_in_out ?? '-- : --'}}</td>
                            <td>
                                <img src="{{ asset('storage/' . $presence->image_url_out) }}" alt="Image" width="100">
                            </td>
                            <td>{{$presence->presence_status}}</td>
                            <td>{{$presence->work_place}}</td>
                            <td>{{$presence->create_at}}</td>
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

