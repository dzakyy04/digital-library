@extends('dashboard.layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="nk-block nk-block-lg">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Semua Buku</h3>
                </div>
                <div class="nk-block-head-content d-flex flex-wrap justify-content-end align-items-center">
                    <div class="dropdown">
                        <button class="btn btn-info dropdown-toggle me-1 me-sm-0" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <em class="icon ni ni-download me-1"></em>Export
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('books.export.all.pdf') }}"><em
                                        class="icon ni ni-file-pdf me-1"></em>Export PDF</a></li>
                            <li><a class="dropdown-item" href="{{ route('books.export.all.pdf.table') }}"><em
                                        class="icon ni ni-file-pdf me-1"></em>Export PDF (Table)</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('books.export.all.excel') }}"><em
                                        class="icon ni ni-file-xls me-1"></em>Export Excel</a></li>
                        </ul>
                    </div>
                    <button type="button" class="btn btn-secondary mx-md-1" data-bs-toggle="modal"
                        data-bs-target="#filterModal">
                        <em class="icon ni ni-filter me-1"></em>Filter
                    </button>
                    <a href="{{ route('books.create') }}" class="btn btn-primary mt-1 mt-sm-0">
                        <em class="icon ni ni-plus me-1"></em>Tambah Buku
                    </a>
                </div>
            </div>

            <div class="card card-bordered card-preview mt-3">
                <div class="card-inner">
                    <table
                        class="datatable-init nk-tb-list nk-tb-ulist table table-hover table-bordered table-responsive-md"
                        data-auto-responsive="false">
                        <thead>
                            <tr class="table-light nk-tb-item nk-tb-head">
                                <th class="text-nowrap text-center">No</th>
                                <th class="text-nowrap text-center">Cover</th>
                                <th class="text-nowrap text-center">Judul</th>
                                <th class="text-nowrap text-center">Kategori</th>
                                <th class="text-nowrap text-center">Deskripsi</th>
                                <th class="text-nowrap text-center">Jumlah</th>
                                <th class="text-nowrap text-center">Pembuat</th>
                                <th class="text-nowrap text-center no-export">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $index => $book)
                                <tr class="align-middle">
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">
                                        <img src="{{ $book->cover_path }}" alt="{{ $book->title }}" class="img-thumbnail"
                                            style="max-height: 150px; max-width: 100px;">
                                    </td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->category ? $book->category->name : '-' }}</td>
                                    <td>{{ Str::words($book->description, 20, '...') }}</td>
                                    <td class="text-center">{{ $book->quantity }}</td>
                                    <td>{{ $book->user->name }}</td>
                                    <td class="text-center">
                                        <div>
                                            <a href="{{ route('books.download', $book->slug) }}"
                                                class="btn btn-success btn-xs rounded-pill download-button"
                                                title="Download Buku">
                                                <em class="ni ni-download"></em>
                                            </a>
                                            <button type="button" class="btn btn-primary btn-xs rounded-pill show-button"
                                                data-slug="{{ $book->slug }}" title="Lihat Detail Buku">
                                                <em class="ni ni-eye"></em>
                                            </button>
                                            <a href="{{ route('books.edit', $book->slug) }}" type="button"
                                                class="btn btn-warning btn-xs rounded-pill" title="Edit Buku">
                                                <em class="ni ni-edit"></em>
                                            </a>
                                            <button class="btn btn-danger btn-xs rounded-pill delete-button"
                                                data-slug="{{ $book->slug }}" title="Hapus Buku">
                                                <em class="ni ni-trash"></em>
                                            </button>
                                        </div>
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

    {{-- Detail Modal --}}
    <div class="modal fade" id="showModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Buku</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <div id="bookDetails"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Buku</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form id="deleteForm" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <p id="deleteText"></p>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-danger"><em
                                    class="ni ni-trash me-1"></em>Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/js/example-toastr.js?ver=3.0.3') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle show
            $('.show-button').click(function() {
                let slug = $(this).data('slug');

                $.ajax({
                    url: '{{ route('books.find', ':slug') }}'.replace(':slug', slug),
                    type: 'GET',
                    success: function(response) {
                        let book = response.book;
                        let downloadLink = book.file_path ?
                            `<a href="{{ route('books.download', ':slug') }}" class="btn btn-primary btn-sm"><em class="icon ni ni-download me-1"></em>Download File</a>`
                            .replace(':slug', book.slug) :
                            '<span class="text-muted">Tidak ada file yang diunggah.</span>';
                        $('#bookDetails').html(`
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Cover</th>
                                        <td><img src="${book.cover_path}" alt="${book.title}" class="img-fluid"></td>
                                    </tr>
                                    <tr>
                                        <th>Judul</th>
                                        <td>${book.title}</td>
                                    </tr>
                                    <tr>
                                        <th>Kategori</th>
                                        <td>${book.category ? book.category.name : '-'}</td>
                                    </tr>
                                    <tr>
                                        <th>Deskripsi</th>
                                        <td>${book.description}</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah</th>
                                        <td>${book.quantity}</td>
                                    </tr>
                                    <tr>
                                        <th>Pembuat</th>
                                        <td>${book.user.name}</td>
                                    </tr>
                                    <tr>
                                        <th>Download</th>
                                        <td>${downloadLink}</td>
                                    </tr>
                                </tbody>
                            </table>
                        `);

                        $('#showModal').modal('show');
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

            // Handle delete
            $('.delete-button').click(function() {
                let slug = $(this).data('slug');

                $('#deleteForm').attr('action', '{{ route('books.destroy', ':slug') }}'.replace(':slug',
                    slug));
                $('#deleteText').text('Apakah Anda yakin ingin menghapus buku ini?');
                $('#deleteModal').modal('show');
            });

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
        });
    </script>
@endpush
