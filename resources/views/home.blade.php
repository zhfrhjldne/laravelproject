@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <div class="row gap-1">
                            <div class="col bg-white shadow-sm">
                                <div class="d-flex align-items-center gap-3 flex-wrap">
                                    <div>
                                        <i class="bi bi-list-ol fs-1 text-primary"></i>
                                    </div>
                                    <div>
                                        <h5>Total Aspirasi Warga</h5>
                                        <h6>{{ $total_aspirasi }}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col bg-white shadow-sm">
                                <div class="d-flex align-items-center gap-3 flex-wrap">
                                    <div>
                                        <i class="bi bi-list-ol fs-1 text-primary"></i>
                                    </div>
                                    <div>
                                        <h5>Total Kegiatan Warga</h5>
                                        <h6>{{ $total_kegiatan }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
