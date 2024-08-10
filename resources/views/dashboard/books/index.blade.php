@extends('dashboard.layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="nk-block nk-block-lg">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Buku Saya</h3>
                </div>
                <div class="nk-block-head-content">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                        <em class="icon ni ni-plus me-1"></em>Tambah Buku
                    </button>
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
                                            style="width: 100px;"></td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->category ? $book->category->name : '-' }}</td>
                                    <td>
                                        {{ Str::words($book->description, 20, '...') }}
                                    </td>
                                    <td>{{ $book->quantity }}</td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-xs rounded-pill download-button"
                                            >
                                            <em class="ni ni-download"></em>
                                        </button>
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
@endsection
