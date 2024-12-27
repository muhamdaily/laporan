<nav class="pc-sidebar light-sidebar">
    <div class="navbar-wrapper">
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item">
                    <a href="{{ route('dashboard') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="material-icons-two-tone">dashboard</i>
                        </span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>
                <li class="pc-item pc-caption">
                    <label>Menu Utama</label>
                </li>
                <li class="pc-item">
                    <a href="{{ route('kegiatan.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="material-icons-two-tone">book</i>
                        </span>
                        <span class="pc-mtext">
                            Kegiatan Harian
                        </span>

                        <span class="pc-arrow">
                            <span class="badge bg-primary" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Total data kegiatan harian">
                                {{ $total }}
                            </span>
                        </span>
                    </a>

                </li>
                <li class="pc-item pc-caption">
                    <label>Lainnya</label>
                </li>
                @if (auth()->user()->role == 'admin')
                    <li class="pc-item">
                        <a href="{{ route('user.index') }}" class="pc-link">
                            <span class="pc-micon">
                                <i class="material-icons-two-tone">supervised_user_circle</i>
                            </span>
                            <span class="pc-mtext">
                                Manajemen Pengguna
                            </span>
                        </a>
                    </li>
                @endif
                <li class="pc-item">
                    <a href="{{ route('laporan.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="material-icons-two-tone">article</i>
                        </span>
                        <span class="pc-mtext">
                            Laporan Kegiatan
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
