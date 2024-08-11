@extends('dashboard.layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="nk-block nk-block-lg">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Dashboard</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mt-3">
                <div class="card text-white bg-primary">
                    <div class="card-header">Buku Saya</div>
                    <div class="card-inner">
                        <h3 class="card-title d-flex align-items-center"><em
                                class="icon ni ni-book me-1"></em>{{ $totalMyBooks }} Buku</h3>
                        <a href="{{ route('books.index') }}" class="d-flex justify-content-end mt-2"><span
                                class="badge badge-dim rounded-pill bg-primary">Lihat
                                Buku Saya</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @can('admin-access')
        <div class="col-md-12 mt-5">
            <div class="nk-block nk-block-lg">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Admin</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mt-3">
                    <div class="card text-white bg-info">
                        <div class="card-header">Semua Buku</div>
                        <div class="card-inner">
                            <h3 class="card-title d-flex align-items-center"><em
                                    class="icon ni ni-book me-1"></em>{{ $totalAllBooks }} Buku</h3>
                            <a href="{{ route('books.all') }}" class="d-flex justify-content-end mt-2"><span
                                    class="badge badge-dim rounded-pill bg-info">Lihat
                                    Semua Buku</span></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="card text-white bg-success">
                        <div class="card-header">Kategori</div>
                        <div class="card-inner">
                            <h3 class="card-title d-flex align-items-center"><em
                                    class="icon ni ni-folders me-1"></em>{{ $totalCategories }} Kategori</h3>
                            <a href="{{ route('categories.index') }}" class="d-flex justify-content-end mt-2"><span
                                    class="badge badge-dim rounded-pill bg-success">Lihat
                                    Kategori</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
