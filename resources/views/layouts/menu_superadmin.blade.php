<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="/home/superadmin" class="nav-link {{ Request::is('home/superadmin*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    Beranda
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/superadmin/peserta" class="nav-link {{ Request::is('superadmin/peserta*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Peserta
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="/superadmin/kategori" class="nav-link {{ Request::is('superadmin/kategori*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    Formasi
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/superadmin/soal" class="nav-link {{ Request::is('superadmin/soal*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    Soal
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="/superadmin/waktu" class="nav-link {{ Request::is('superadmin/waktu*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-clock"></i>
                <p>
                    Batas Waktu
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="/superadmin/pendaftaran"
                class="nav-link {{ Request::is('superadmin/pendaftaran*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-clock"></i>
                <p>
                    Waktu Pendaftaran
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/superadmin/gantipass" class="nav-link {{ Request::is('superadmin/gantipass*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-key"></i>
                <p>
                    Ganti Password
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="/logout" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                    Logout
                </p>
            </a>
        </li>
    </ul>
</nav>