@extends('layout-user')

@section('content')
    <div class="container" style="margin-top: 100px">
        <h3 class="text-center mb-5">DOKUMENTASI KEGIATAN WARGA RT 04</h3>
        <div class="row">
            @foreach ($kegiatans as $data)
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="card">
                    <img src="{{ asset('storage/' . $data->image) }}" class="card-img-top">
                    <div class="card-body">
                      <h5 class="card-title">{{ $data->judul }}</h5>
                      <p class="card-text">{{ $data->ulasan }}</p>
                      <p class="card-text mt-2">Tanggal Kegiatan : {{ $data->tanggal_kegiatan }}</p>
                    </div>
                  </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
