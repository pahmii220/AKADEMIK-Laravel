<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="submenu {{set_active(['home'])}}">
                    <a>
                        <i class="fas fa-tachometer-alt"></i>
                        <span> Dashboard</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('home') }}" class="{{set_active(['home'])}}">Admin Dashboard</a></li>
                    </ul>
                </li>

                {{-- Role Admin dan Super Admin --}}
                @if (Session::get('role_name') === 'Admin' || Session::get('role_name') === 'Super Admin')
                    {{-- Manajemen Pengguna --}}
                    <li class="submenu {{set_active(['list/users'])}}">
                        <a href="#"><i class="fas fa-shield-alt"></i>
                            <span> Manajemen Pengguna</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li><a href="{{ route('list/users') }}">List Pengguna</a></li>
                        </ul>
                    </li>

                    {{-- Berita --}}
                    <li class="submenu {{ request()->routeIs('berita.*') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-info-circle"></i><span>Informasi</span><span
                                class="menu-arrow"></span></a>
                        <ul style="{{ request()->routeIs('berita.*') ? 'display: block;' : '' }}">
                            <li><a href="{{ route('berita.list') }}">Daftar Berita</a></li>
                            <li><a href="{{ route('berita.create') }}">Tambah Berita</a></li>
                        </ul>
                    </li>
                @else
                    {{-- Berita - Role Guru --}}
                    <li>
                        <a href="{{ route('berita.list') }}"><i class="fas fa-info-circle"></i><span>Daftar
                                Berita</span></a>
                    </li>
                @endif

                {{-- Siswa --}}
                <li class="submenu {{set_active(['student/list'])}}">
                    <a href="#"><i class="fas fa-graduation-cap"></i><span> Siswa</span><span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('student/list') }}">Daftar Siswa</a></li>
                        @if(Session::get('role_name') === 'Admin' || Session::get('role_name') === 'Super Admin')
                            <li><a href="{{ route('student/add/page') }}">Tambah Siswa</a></li>
                        @endif
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-file-alt"></i> <span> Nilai </span> <span class="menu-arrow"></span></a>
                    <ul>                    
                        @php $role = Session::get('role_name'); @endphp
                        
                        {{-- Hanya Teacher bisa input nilai --}}
                        @if ($role === 'Teachers')
                            <li><a href="{{ route('nilai.create') }}">Input Nilai</a></li>
                        @endif
                        
                        <li class="{{ request()->is('nilai') ? 'active' : '' }}">
                        </li>
                        

                        <li class="{{ request()->is('nilai') ? 'active' : '' }}">
                            <a href="{{ route('nilai.list') }}">
                                <span>Data Nilai</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                {{-- Guru --}}
                <li class="submenu {{ request()->routeIs('guru.*') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-chalkboard-teacher"></i><span>Guru</span><span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('guru.list') }}">Data Guru</a></li>
                        @if(Session::get('role_name') === 'Admin' || Session::get('role_name') === 'Super Admin')
                            <li><a href="{{ route('guru.create') }}">Tambah Guru</a></li>
                        @endif
                    </ul>
                </li>

                {{-- Jurusan --}}
                <li class="submenu {{set_active(['jurusan', 'jurusan/create'])}}">
                    <a href="#"><i class="fas fa-building"></i><span>Jurusan</span><span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('jurusan.list') }}">Data Jurusan</a></li>
                        @if(Session::get('role_name') === 'Admin' || Session::get('role_name') === 'Super Admin')
                            <li><a href="{{ route('jurusan.create') }}">Tambah Data Jurusan</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>