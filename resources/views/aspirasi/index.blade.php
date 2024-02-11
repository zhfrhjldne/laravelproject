@extends('layouts.app')

@section('content')
    <div class="container bg-white p-5">
        <h1>Data Aspirasi</h1>
        <div class="mb-3" style="width: fit-content">
            <form action="{{ url('/aspirasi') }}" method="get">
                <div class="d-flex gap-1 align-items-center">
                    <div>
                       
                        <input type="date" class="form-control" value="{{ request('start_date') }}" name="start_date" id="start_date" />
                    </div>
                    <div>
                        
                        <input type="date" class="form-control" value="{{ request('end_date') }}" name="end_date" id="end_date" />
                    </div>
                    <div>
                    
                        <select name="kategori" class="form-select" id="kategori">
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $ct)
                                <option value="{{ $ct->id }}" {{ request('kategori') == $ct->id ? 'selected' : '' }}>{{ $ct->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ url('/aspirasi') }}" class="btn btn-danger border-0">Clear Filter</a>
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
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($aspirasis as $data)
                     <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td><img src="{{ asset('storage/' . $data->image) }}" width="100" alt="Tanpa Gambar"></td>
                        <td>{{ $data->nama }}</td>
                        <td> @if ($data->kategori_id == '1')
                            <span>Jalanan</span>
                            @elseif ($data->kategori_id == '2')
                            <span>Keamanan</span>
                            @elseif ($data->kategori_id == '3')
                            <span>Kebersihan</span>
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
                        <td>
                            @if ($data->status == 'Pending')
                                <button class="badge bg-primary border-0" data-bs-toggle="modal" data-bs-target="#prosesModal-{{$data->id}}">Proses Aspirasi</button>
                                <div class="modal fade" id="prosesModal-{{$data->id}}" tabindex="-1" aria-labelledby="prosesModalLabel" aria-hidden="true">
                                    <form action="/aspirasi/{{ $data->id }}" method="post">
                                        @method('put')
                                        @csrf
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="prosesModalLabel">Proses Aspirasi</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="feedback" class="form-label">Umpan Balik</label>
                                                        <textarea class="form-control" name="feedback" id="feedback" placeholder="Umpan balik" required></textarea>
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
                            @endif
                            @if ($data->status == 'Diproses')
                            <button class="badge bg-success border-0" data-bs-toggle="modal" data-bs-target="#prosesModal-{{$data->id}}">Tandai Selesai</button>
                            <div class="modal fade" id="prosesModal-{{$data->id}}" tabindex="-1" aria-labelledby="prosesModalLabel" aria-hidden="true">
                                <form action="/aspirasi/{{ $data->id }}" method="post">
                                    @method('put')
                                    @csrf
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="prosesModalLabel">Aspirasi Selesai</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="feedback" class="form-label">Umpan Balik</label>
                                                    <textarea class="form-control" name="feedback" id="feedback" placeholder="Umpan balik" required></textarea>
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
                            @else
                            -
                            @endif
                        </td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
            {{ $aspirasis->links() }}
        </div>
    </div>
@endsection
