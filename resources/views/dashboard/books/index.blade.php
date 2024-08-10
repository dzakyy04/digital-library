@extends('dashboard.layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="nk-block nk-block-lg">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Buku Saya</h3>
                </div>
                <div class="nk-block-head-content">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#filterModal">
                        <em class="icon ni ni-filter me-2"></em>Filter
                    </button>
                    <a href="{{ route('books.create') }}" class="btn btn-primary">
                        <em class="icon ni ni-plus me-1"></em>Tambah Buku
                    </a>

                </div>
            </div>

            <div class="card card-bordered card-preview mt-3">
                <div class="card-inner">
                    <table class="datatable-init nk-tb-list nk-tb-ulist table table-hover table-responsive-md"
                        data-auto-responsive="false">
                        <thead>
                            <tr class="table-light nk-tb-item nk-tb-head">
                                <th class="text-nowrap">No</th>
                                <th class="text-nowrap">Cover</th>
                                <th class="text-nowrap">Judul</th>
                                <th class="text-nowrap">Kategori</th>
                                <th class="text-nowrap">Deskripsi</th>
                                <th class="text-nowrap">Jumlah</th>
                                <th class="text-nowrap no-export">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $index => $book)
                                <tr class="align-middle">
                                    <td>{{ $index + 1 }}</td>
                                    <td><img src="{{ $book->cover_path }}" alt="{{ $book->title }}" class="img-thumbnail"
                                            style="width: 200px;"></td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->category ? $book->category->name : '-' }}</td>
                                    <td>
                                        {{ Str::words($book->description, 20, '...') }}
                                    </td>
                                    <td>{{ $book->quantity }}</td>
                                    <td>
                                        <a href="{{ route('books.download', $book->slug) }}"
                                            class="btn btn-success btn-xs rounded-pill download-button">
                                            <em class="ni ni-download"></em>
                                        </a>
                                        <button type="button" class="btn btn-primary btn-xs rounded-pill show-button"
                                            data-slug="{{ $book->slug }}">
                                            <em class="ni ni-eye"></em>
                                        </button>
                                        <button type="button" class="btn btn-warning btn-xs rounded-pill edit-button"
                                            data-slug="{{ $book->slug }}">
                                            <em class="ni ni-edit"></em>
                                        </button>
                                        <button class="btn btn-danger btn-xs rounded-pill delete-button"
                                            data-slug="{{ $book->slug }}">
                                            <em class="ni ni-trash"></em>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter modal --}}
    <div class="modal fade" id="filterModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Filter Buku</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="{{ route('books.index') }}" method="GET">
                        <div class="form-group">
                            <label class="fw-bold">Kategori</label>
                            <div class="form-check mt-1">
                                <input class="form-check-input" type="checkbox" name="kategori[]" value="-"
                                    id="kategori_none" {{ in_array('-', request('kategori', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="kategori_none">
                                    Tanpa Kategori
                                </label>
                            </div>
                            @foreach ($categories as $category)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="kategori[]"
                                        value="{{ $category->slug }}" id="kategori_{{ $category->slug }}"
                                        {{ in_array($category->slug, request('kategori', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="kategori_{{ $category->slug }}">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary"><em class="ni ni-filter"></em> Filter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/js/example-toastr.js?ver=3.0.3') }}"></script>
    <script>
        $(document).ready(function() {
            // Toastr
            @if (session()->has('success'))
                let message = @json(session('success'));
                NioApp.Toast(`<h5>Berhasil</h5><p>${message}</p>`, 'success', {
                    position: 'top-right',
                });
            @endif

            @if (session()->has('error'))
                let message = @json(session('error'));
                NioApp.Toast(`<h5>Gagal</h5><p>${message}</p>`, 'error', {
                    position: 'top-right',
                });
            @endif
            c
        });
    </script>
@endpush
