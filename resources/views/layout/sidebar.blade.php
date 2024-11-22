<!-- <div id="sidebar" class="fixed left-0 z-40 w-64 h-[calc(100vh-4rem)] bg-white text-gray-700 p-4 top-16 transform -translate-x-full transition-transform duration-300"> -->
<div id="sidebar" class="fixed left-0 z-40 w-64 h-[calc(100vh-4rem)] bg-white text-gray-700 p-4 top-16 transform transition-transform duration-300">

    <ul>
        <li>
            <a href="{{ route('admin.user.index') }}" 
                class="flex items-center py-2 px-4 rounded-lg ml-5 
                    {{ Request::is('admin/user*') ? 'bg-blue-500 text-white' : 'text-gray-500 hover:bg-blue-500 hover:text-white' }}">
                <i class="fas fa-user w-6"></i>
                <span class="ml-3">Data User</span>
            </a>
        </li>
        <li class="mt-2"> 
            <a href="{{ route('admin.data-presensi.index') }}" 
                class="flex items-center py-2 px-4 rounded-lg ml-5
                    {{ Request::is('admin/data-presensi*') ? 'bg-blue-500 text-white' : 'text-gray-500 hover:bg-blue-500 hover:text-white' }}">
                <i class="fas fa-calendar-check w-6"></i>
                <span class="ml-3">Data Presensi</span>
            </a>
        </li>
        <li class="mt-2"> 
            <a href="{{ route('admin.role.index') }}" 
                class="flex items-center py-2 px-4 rounded-lg ml-5
                    {{ Request::is('admin/role*') ? 'bg-blue-500 text-white' : 'text-gray-500 hover:bg-blue-500 hover:text-white' }}">
                <i class="fas fa-briefcase w-6"></i>
                <span class="ml-3">Data Role</span>
            </a>
        </li>
        <li class="mt-2"> 
            <a href="{{ route('admin.work-hour.index') }}" 
                class="flex items-center py-2 px-4 rounded-lg ml-5
                    {{ Request::is('admin/work-hour*') ? 'bg-blue-500 text-white' : 'text-gray-500 hover:bg-blue-500 hover:text-white' }}">
                <i class="fas fa-clock w-6"></i>
                <span class="ml-3">Jam Kerja</span>
            </a>
        </li>
    </ul>
</div>