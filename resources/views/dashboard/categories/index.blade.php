@extends('dashboard.layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="nk-block nk-block-lg">
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h4 class="nk-block-title mb-2">Kategori</h4>
                </div>
            </div>
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <table class="datatable-init nk-tb-list nk-tb-ulist table table-hover table-responsive-md"
                        data-auto-responsive="false">
                        <thead>
                            <tr class="table-light nk-tb-item nk-tb-head">
                                <th class="text-nowrap">No</th>
                                <th class="text-nowrap">Nama</th>
                                <th class="text-nowrap">Slug</th>
                                <th class="text-nowrap">Jumlah</th>
                                <th class="text-nowrap no-export">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $index => $category)
                                <tr class="align-middle">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->books_count }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-xs rounded-pill edit-button"
                                            data-id="">
                                            <em class="ni ni-edit"></em>
                                        </button>
                                        <button class="btn btn-danger btn-xs rounded-pill delete-button" data-id="">
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
