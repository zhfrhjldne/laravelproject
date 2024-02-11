@extends('layouts.app')

@section('content')
    <div class="container bg-white p-5">
        <h1>Data Kategori Aspirasi</h1>
        <div class="mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                Tambah Kategori
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
                        <th scope="col">Nama</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategoris as $data)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $data->nama }}</td>
                            <td>
                                <button class="badge bg-warning text-dark border-0" data-bs-toggle="modal"
                                    data-bs-target="#editModal-{{ $data->id }}"><i
                                        class="bi bi-pencil-square"></i></button>
                                <div class="modal fade" id="editModal-{{ $data->id }}" tabindex="-1" aria-labelledby="editModalLabel"
                                    aria-hidden="true">
                                    <form action="/kategori/{{ $data->id }}" method="post">
                                        @method('put')
                                        @csrf
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Edit Kategori</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="nama" class="form-label">Nama Kategori</label>
                                                        <input type="text" class="form-control" id="nama"
                                                            name="nama"  value="{{ $data->nama }}" placeholder="Nama" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-warning">Edit</button>
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
                                    <form action="/kategori/{{ $data->id }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Hapus Kategori</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="nama" class="form-label">Nama Kategori</label>
                                                        <input type="text" class="form-control" id="nama"
                                                            name="nama" value="{{ $data->nama }}" placeholder="Nama" disabled>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
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
            {!! $kategoris->links() !!}
        </div>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <form action="/kategori" method="post">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Buat Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
