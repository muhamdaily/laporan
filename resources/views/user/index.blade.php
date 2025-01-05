@extends('template', [
    'title' => 'Manajemen Pengguna',
])

@section('content')
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5>
                            Manajemen Pengguna
                        </h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            Manajemen pengguna yang dapat mengakses sistem ini.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
                        <!-- Judul -->
                        <h5 class="mb-2 mb-md-0" style="max-width: 200px;" title="Daftar Kegiatan">
                            Daftar Pengguna
                        </h5>

                        <!-- Input dan Tombol -->
                        <div class="input-group input-group-sm w-100 w-md-auto" style="max-width: 300px;">
                            <!-- Input Pencarian -->
                            <input type="text" class="form-control" placeholder="Cari data pengguna" id="search-custom">
                            <!-- Tombol Tambah Data -->
                            <button type="button" class="btn btn-info ms-2" data-bs-toggle="modal"
                                data-bs-target="#modal-tambah" title="Tambah Data Pengguna">
                                <i class="fas fa-folder-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body table-border-style">
                    <div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="table-custom">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">NIM</th>
                                        <th class="text-center">Nama Lengkap</th>
                                        <th class="text-center">Username</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">
                                            <i class="fas fa-th"></i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $pengguna)
                                        <tr class="text-center">
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                <span class="fw-bold">
                                                    {{ $pengguna->nim }}
                                                </span>
                                            </td>
                                            <td>
                                                {{ $pengguna->name }}
                                            </td>
                                            <td>
                                                {{ $pengguna->username }}
                                            </td>
                                            <td>
                                                {{ $pengguna->email }}
                                            </td>
                                            <td class="dropdown">
                                                <a class="dropdown-toggle arrow-none" data-bs-toggle="dropdown"
                                                    style="cursor: pointer;">
                                                    <i class="material-icons-two-tone">more_horiz</i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="{{ route('kegiatan.show', $pengguna->id) }}"
                                                        class="dropdown-item">
                                                        <i class="material-icons-two-tone">visibility</i>
                                                        <span>Lihat Detail</span>
                                                    </a>

                                                    <a href="#" class="dropdown-item"
                                                        onclick="event.preventDefault();" data-bs-toggle="modal"
                                                        data-bs-target="#modal-ubah-{{ $pengguna->id }}"
                                                        title="Ubah Data {{ $pengguna->name }}">
                                                        <i class="material-icons-two-tone">edit</i>
                                                        <span>Ubah Data</span>
                                                    </a>

                                                    <div role="separator" class="dropdown-divider"></div>

                                                    <a href="javascript:void(0);" class="dropdown-item"
                                                        onclick="event.preventDefault(); document.getElementById('hapus-pengguna-{{ $pengguna->id }}').submit();">
                                                        <i class="material-icons-two-tone">delete</i>
                                                        <span>Hapus Data</span>
                                                    </a>

                                                    <form action="{{ route('user.destroy', $pengguna->id) }}" method="POST"
                                                        id="hapus-pengguna-{{ $pengguna->id }}" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- [ Modal Tambah ] start -->
    <div id="modal-tambah" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">
                        Tambah Data Pengguna
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group date">
                                    <label class="form-label" for="nim">
                                        NIM Pengguna <span class="text-danger">*</span>
                                    </label>

                                    <input type="text" id="nim" name="nim"
                                        class="form-control @error('nim') is-invalid @enderror"
                                        placeholder="Masukkan nomor induk mahasiswa" value="{{ old('nim') }}"
                                        autocomplete="off" />

                                    @error('tanggal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group date">
                                    <label class="form-label" for="name">
                                        Nama Mahasiswa <span class="text-danger">*</span>
                                    </label>

                                    <input type="text" id="name" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Masukkan nama mahasiswa" value="{{ old('name') }}"
                                        autocomplete="off" />

                                    @error('tanggal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group date">
                                    <label class="form-label" for="prodi">
                                        Program Studi <span class="text-danger">*</span>
                                    </label>

                                    <input type="text" id="prodi" name="prodi"
                                        class="form-control @error('prodi') is-invalid @enderror"
                                        placeholder="Masukkan program studi" value="{{ old('prodi') }}"
                                        autocomplete="off" />

                                    @error('tanggal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <hr>

                            <div class="col-12 col-md-6">
                                <div class="form-group date">
                                    <label class="form-label" for="username">
                                        Username <span class="text-danger">*</span>
                                    </label>

                                    <input type="text" id="username" name="username"
                                        class="form-control @error('username') is-invalid @enderror"
                                        placeholder="Masukkan username" value="{{ old('username') }}"
                                        autocomplete="off" />

                                    @error('tanggal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group date">
                                    <label class="form-label" for="email">
                                        Alamat Email <span class="text-danger">*</span>
                                    </label>

                                    <input type="text" id="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Masukkan alamat email" value="{{ old('email') }}"
                                        autocomplete="off" />

                                    @error('tanggal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group date">
                                    <label class="form-label" for="password">
                                        Kata Sandi <span class="text-danger">*</span>
                                    </label>

                                    <input type="text" id="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Tetapkan kata sandi" value="{{ old('password') }}"
                                        autocomplete="off" />

                                    @error('tanggal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                            Tutup
                        </button>

                        <button type="submit" class="btn btn-sm btn-primary">
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- [ Modal Tambah ] end -->

    <!-- [ Modal Ubah ] start -->
    @foreach ($data as $pengguna)
        <div id="modal-ubah-{{ $pengguna->id }}" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false"
            role="dialog" aria-labelledby="modalTambahLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahLabel">
                            Ubah Data {{ $pengguna->name }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('user.update', $pengguna->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group date">
                                        <label class="form-label" for="nim">
                                            NIM Pengguna <span class="text-danger">*</span>
                                        </label>

                                        <input type="text" id="nim" name="nim"
                                            class="form-control @error('nim') is-invalid @enderror"
                                            placeholder="Masukkan nomor induk mahasiswa" value="{{ $pengguna->nim }}"
                                            autocomplete="off" />

                                        @error('tanggal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group date">
                                        <label class="form-label" for="name">
                                            Nama Mahasiswa <span class="text-danger">*</span>
                                        </label>

                                        <input type="text" id="name" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Masukkan nama mahasiswa" value="{{ $pengguna->name }}"
                                            autocomplete="off" />

                                        @error('tanggal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group date">
                                        <label class="form-label" for="prodi">
                                            Program Studi <span class="text-danger">*</span>
                                        </label>

                                        <input type="text" id="prodi" name="prodi"
                                            class="form-control @error('prodi') is-invalid @enderror"
                                            placeholder="Masukkan program studi" value="{{ $pengguna->prodi }}"
                                            autocomplete="off" />

                                        @error('tanggal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <hr>

                                <div class="col-12 col-md-6">
                                    <div class="form-group date">
                                        <label class="form-label" for="username">
                                            Username <span class="text-danger">*</span>
                                        </label>

                                        <input type="text" id="username" name="username"
                                            class="form-control @error('username') is-invalid @enderror"
                                            placeholder="Masukkan username" value="{{ $pengguna->username }}"
                                            autocomplete="off" />

                                        @error('tanggal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group date">
                                        <label class="form-label" for="email">
                                            Alamat Email <span class="text-danger">*</span>
                                        </label>

                                        <input type="text" id="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Masukkan alamat email" value="{{ $pengguna->email }}"
                                            autocomplete="off" />

                                        @error('tanggal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group date">
                                        <label class="form-label" for="password">
                                            Kata Sandi <small class="text-muted">
                                                (Kosongkan jika tidak ingin mengubah kata sandi)
                                            </small>
                                        </label>

                                        <input type="text" id="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            value="{{ old('password') }}" autocomplete="off" />

                                        @error('tanggal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                                Tutup
                            </button>

                            <button type="submit" class="btn btn-sm btn-primary">
                                Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    <!-- [ Modal Ubah ] end -->
    <!-- [ Main Content ] end -->
@endsection

@push('styles')
    <style>
        .dataTables_filter {
            display: none;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('assets/custom/pages/manajemen-pengguna.js') }}"></script>
@endpush
