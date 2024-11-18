@extends('layout.main') 

@section('content')

<div class="container mx-auto p-4">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl text-blue-500 font-semibold mb-6">Edit Jam Kerja</h2>

        <form action="{{route('admin.work-hour.update', $workHour->id)}}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="clock_in" class="block text-gray-700">
                    Jam Masuk
                    <span class="text-red-500 font-semibold">*</span> 
                </label>
                <input type="time" id="clock_in" name="clock_in" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan Jam Masuk" value="{{ old('clock_in', $workHour->clock_in) }}" required>
            </div>

            <div class="mb-4">
                <label for="clock_out" class="block text-gray-700">
                    Jam Keluar
                    <span class="text-red-500 font-semibold">*</span> 
                </label>
                <input type="time" id="clock_out" name="clock_out" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan Jam Keluar" value="{{ old('clock_out', $workHour->clock_out) }}" required>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection
