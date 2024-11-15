<!-- <div id="sidebar" class="fixed left-0 z-40 w-64 h-[calc(100vh-4rem)] bg-white text-gray-700 p-4 top-16 transform -translate-x-full transition-transform duration-300"> -->
<div id="sidebar" class="fixed left-0 z-40 w-64 h-[calc(100vh-4rem)] bg-white text-gray-700 p-4 top-16 transform transition-transform duration-300">

    <ul>
        <li>
            <a href="{{ url('/data-user') }}" 
               class="flex items-center py-2 px-4 rounded-lg ml-4 
                      {{ Request::is('data-user') ? 'bg-blue-500 text-white' : 'text-gray-500 hover:bg-blue-500 hover:text-white' }}">
                <i class="fas fa-user w-6"></i>
                <span class="ml-3">Data User</span>
            </a>
        </li>
        <li class="mt-2"> 
            <a href="{{ url('/data-presensi') }}" 
               class="flex items-center py-2 px-4 rounded-lg ml-4
                      {{ Request::is('data-presensi') ? 'bg-blue-500 text-white' : 'text-gray-500 hover:bg-blue-500 hover:text-white' }}">
                <i class="fas fa-calendar-check w-6"></i>
                <span class="ml-3">Data Presensii</span>
            </a>
        </li>
        <li class="mt-2"> 
            <a href="{{ url('/data-role') }}" 
               class="flex items-center py-2 px-4 rounded-lg ml-4
                      {{ Request::is('data-role') ? 'bg-blue-500 text-white' : 'text-gray-500 hover:bg-blue-500 hover:text-white' }}">
                <i class="fas fa-briefcase w-6"></i>
                <span class="ml-3">Data Role</span>
            </a>
        </li>
    </ul>
</div>