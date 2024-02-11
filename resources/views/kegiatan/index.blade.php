@extends('layouts.app')

@section('content')
    <div class="container bg-white p-5">
        <h1>Data Kegiatan Warga</h1>
        <div class="mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                Kegiatan Baru
            </button>
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
                        <th scope="col">#</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Tanggal Dilaksanakan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kegiatans as $data)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td><img src="{{ asset('storage/' . $data->image) }}" width="100" alt="Tanpa Gambar"></td>
                            <td>{{ $data->judul }}</td>
                            <td>{{ $data->ulasan }}</td>
                            <td>{{ $data->tanggal_kegiatan }}</td>
                            <td>
                                <button class="badge bg-warning text-dark border-0" data-bs-toggle="modal"
                                    data-bs-target="#editModal-{{ $data->id }}"><i
                                        class="bi bi-pencil-square"></i></button>
                                <div class="modal fade" id="editModal-{{ $data->id }}" tabindex="-1" aria-labelledby="editModalLabel"
                                    aria-hidden="true">
                                    <form action="/kegiatan/{{ $data->id }}" method="post" enctype="multipart/form-data">
                                        @method('put')
                                        @csrf
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Edit Kegiatan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="judul" class="form-label">Nama Judul</label>
                                                        <input type="text" value="{{ $data->judul }}" class="form-control" id="judul" name="judul" placeholder="Judul"
                                                            required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="image" class="form-label">Gambar Kegiatan</label>
                                                        <input class="form-control" type="file" name="image" id="image">
                                                      </div>
                                                      <div class="mb-3">
                                                          <label for="ulasan" class="form-label">Deskripsi</label>
                                                          <textarea class="form-control" name="ulasan" id="ulasan" placeholder="Deskripsi Kegiatan" required>{{ $data->ulasan }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tanggal_kegiatan" class="form-label">Tanggal Kegiatan</label>
                                                            <input type="date" class="form-control" id="tanggal_kegiatan" name="tanggal_kegiatan" value="{{ $data->tanggal_kegiatan }}"
                                                                required>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="Reset" class="btn btn-secondary">Hapus</button>
                                                    <button type="submit" class="btn btn-warning">Kirim</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <button class="badge bg-danger text-white border-0" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal-{{ $data->id }}"><i
                                        class="bi bi-backspace-fill"></i></button>

                                <div class="modal fade" id="deleteModal-{{ $data->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
                                    aria-hidden="true">
                                    <form action="/kegiatan/{{ $data->id }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Hapus Kegiatan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="judul" class="form-label">Judul Kegiatan</label>
                                                        <input type="text" class="form-control" id="judul"
                                                            name="judul" value="{{ $data->judul }}" placeholder="judul" disabled>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $kegiatans->links() !!}
        </div>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <form action="/kegiatan" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Buat Kegiatan Warga</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Nama Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar Kegiatan</label>
                            <input class="form-control" type="file" name="image" id="image" required>
                          </div>
                          <div class="mb-3">
                              <label for="ulasan" class="form-label">Deskripsi</label>
                              <textarea class="form-control" name="ulasan" id="ulasan" placeholder="Deskripsi Kegiatan" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_kegiatan" class="form-label">Tanggal Kegiatan</label>
                                <input type="date" class="form-control" id="tanggal_kegiatan" name="tanggal_kegiatan"
                                    required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
