@extends('layout-user')

@section('content')
<div class="container bg-white p-5 " style="margin-top: 10px">
    <h3 class="text-center my-5">ASPIRASI WARGA RT 04 KECAMATAN SUKAMAJU </h3>
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#createModal">
           Tuliskan Aspirasi Anda Disini </button>
            <div class="d-flex align-items-center gap-1">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">Search</span>
                    <input type="text" class="form-control" placeholder="Masukan ID Laporan" name="id" value="{{ request('id') }}">
                </div>
                <button class="btn btn-info"><i class="bi bi-search"></i></button>
            </div>
        </form>
</div>
@if (session()->has('alert'))
            <div class="alert alert-{{ session('alert')['type'] }}" role="alert">
                {{ session('alert')['message'] }}
            </div>
        @endif
    <div class="table-responsive">
        <table class="table table-striped shadow-sm">
            <thead>
                <tr>
                    <th scope="col">ID Laporan</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Ulasan</th>
                    <th scope="col">Umpan Balik</th>
                    <th scope="col">Dibuat Pada</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($aspirasis as $data)
                 <tr>
                    <th scope="row">{{ $data->id }}</th>
                    <td><img src="{{ asset('storage/' . $data->image) }}" width="100" alt="Tanpa Gambar"></td>
                    <td>{{ $data->nama }}</td>
                    <td> @if ($data->kategori_id == '1')
                        <span>Kebersihan</span>
                        @elseif ($data->kategori_id == '2')
                        <span>Keamanan</span>
                        @elseif ($data->kategori_id == '3')
                        <span>Jalanan</span>
                        @endif </td>
                    <td>{{ $data->isi }}</td>
                    <td>{{ $data->feedback }}</td>
                    <td>{{ $data->created_at->isoFormat('YYYY-MM-DD') }}</td>
                    <td>
                        @if ($data->status == 'Pending')
                        <span class="badge bg-warning text-dark">{{ $data->status }}</span>
                        @elseif ($data->status == 'Diproses')
                        <span class="badge bg-primary">{{ $data->status }}</span>
                        @elseif ($data->status == 'Selesai')
                        <span class="badge bg-success">{{ $data->status }}</span>
                        @endif
                    </td>
                </tr>
               @endforeach
            </tbody>
        </table>
        {{ $aspirasis->links() }}
    </div>
</div>

<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <form action="/aspirasi" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Buat Aspirasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori</label>
                        <select class="form-select" name="kategori_id" required>
                            <option selected>Pilih Kategori</option>
                            @foreach ($categories as $ct)
                                <option value="{{ $ct->id }}">{{ $ct->nama }}</option>
                            @endforeach
                          </select>
                    </div>
                    <div class="mb-3">
                        <label for="isi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="isi" id="isi" placeholder="Ulasan anda" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Foto Pendukung</label>
                        <input class="form-control" type="file" name="image" id="image">
                      </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Kejadian</label>
                        <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat Kejadian" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary">Hapus</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
