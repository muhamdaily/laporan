<header class="pc-header bg-dark ">
    <div class="header-wrapper">
        <div class="m-header d-flex align-items-center">
            <a href="index.html" class="b-brand">
                <!-- ========   change your logo hear   ============ -->
                <img src="{{ asset('assets/dashboard/images/logo.svg') }}" alt="" class="logo logo-lg">
            </a>
        </div>
        <div class="ms-auto">
            <ul class="list-unstyled">
                <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="https://placehold.jp/300x300.png" alt="user-image" class="user-avtar">
                        <span>
                            <span class="user-name">
                                {{ auth()->user()->name }}
                            </span>
                            <span class="user-desc">
                                {{ auth()->user()->nim }}
                            </span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end pc-h-dropdown">
                        <a href="user-profile.html" class="dropdown-item">
                            <i class="material-icons-two-tone">account_circle</i>
                            <span>Pengaturan Akun</span>
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item"
                            onclick="event.preventDefault(); document.getElementById('keluar').submit();">
                            <i class="material-icons-two-tone">chrome_reader_mode</i>
                            <span>Keluar</span>
                        </a>

                        <form action="{{ route('logout') }}" method="POST" id="keluar" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
