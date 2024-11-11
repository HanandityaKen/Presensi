<div id="sidebar" class="w-64 bg-white text-gray-700 p-4 fixed inset-y-0 left-0 transform -translate-x-full transition-transform duration-300 lg:translate-x-0 lg:relative">
    <div class="flex justify-center items-center mb-8">
        <h1 class="text-xl font-semibold text-blue-500 text-center w-full">Sistem Presensi</h1>
    </div>
    <ul>
        <li>
            <a href="{{ url('/data-user') }}" 
               class="flex items-center py-2 px-4 rounded-lg ml-7 
                      {{ Request::is('data-user') ? 'bg-blue-500 text-white' : 'text-gray-500 hover:bg-blue-500 hover:text-white' }}">
                <i class="fas fa-user w-6"></i>
                <span class="ml-3">Data User</span>
            </a>
        </li>
        <li class="mt-2"> 
            <a href="{{ url('/data-presensi') }}" 
               class="flex items-center py-2 px-4 rounded-lg ml-7
                      {{ Request::is('data-presensi') ? 'bg-blue-500 text-white' : 'text-gray-500 hover:bg-blue-500 hover:text-white' }}">
                <i class="fas fa-calendar-check w-6"></i>
                <span class="ml-3">Data Presensi</span>
            </a>
        </li>
    </ul>
</div>

