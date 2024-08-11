@extends('dashboard.layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="nk-block nk-block-lg">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Kategori</h3>
                </div>
                <div class="nk-block-head-content">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                        <em class="icon ni ni-plus me-1"></em>Tambah Kategori
                    </button>
                </div>
            </div>
            <div class="card card-bordered card-preview mt-3">
                <div class="card-inner">
                    <table class="datatable-init nk-tb-list nk-tb-ulist table table-hover table-bordered table-responsive-md"
                        data-auto-responsive="false">
                        <thead>
                            <tr class="table-light nk-tb-item nk-tb-head">
                                <th class="text-nowrap text-center">No</th>
                                <th class="text-nowrap text-center">Nama</th>
                                <th class="text-nowrap text-center">Slug</th>
                                <th class="text-nowrap text-center">Jumlah</th>
                                <th class="text-nowrap text-center no-export">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $index => $category)
                                <tr class="align-middle">
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td class="text-center">{{ $category->books_count }}</td>
                                    <td class="text-center">
                                        <div>
                                            <button type="button" class="btn btn-warning btn-xs rounded-pill edit-button"
                                                data-slug="{{ $category->slug }}" title="Edit Kategori">
                                                <em class="ni ni-edit"></em>
                                            </button>
                                            <button class="btn btn-danger btn-xs rounded-pill delete-button"
                                                data-slug="{{ $category->slug }}" title="Hapus Kategori">
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

    {{-- Add Modal --}}
    <div class="modal fade" id="addModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kategori</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="name">Nama</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" id="name" value="{{ old('name') }}"
                                    placeholder="Masukkan nama kategori" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="slug">Slug</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                    name="slug" id="slug" value="{{ old('slug') }}"
                                    placeholder="Otomatis terisi berdasarkan nama" required>
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary"><em class="ni ni-save me-1"></em>Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kategori</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="form-label" for="edit_name">Nama</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" id="edit_name" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="edit_slug">Slug</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                    name="slug" id="edit_slug" required>
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary"><em
                                    class="ni ni-save me-1"></em>Perbarui</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Kategori</h5>
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
    <script>
        $(document).ready(function() {
            // Handle slug
            function handleSlugGeneration(nameInput, slugInput) {
                $(nameInput).on('input', function() {
                    let name = $(this).val();
                    let slug = name.toLowerCase().replace(/\s+/g, '-');

                    $.ajax({
                        url: '{{ route('categories.checkSlug') }}',
                        type: 'GET',
                        data: {
                            slug: slug
                        },
                        success: function(response) {
                            if (response.exists) {
                                slug = slug + '-' + (response.count + 1);
                            }
                            $(slugInput).val(slug);
                        }
                    });
                });
            }

            // Handle slug for add modal
            handleSlugGeneration('#name', '#slug');

            // Handle slug for edit modal
            handleSlugGeneration('#edit_name', '#edit_slug');

            // Handle edit
            $('.edit-button').on('click', function() {
                let slug = $(this).data('slug');

                $.ajax({
                    url: '{{ route('categories.find', ':slug') }}'.replace(':slug', slug),
                    type: 'GET',
                    success: function(response) {
                        let category = response.category;

                        $('#edit_name').val(category.name);
                        $('#edit_slug').val(category.slug);

                        $('#editForm').attr('action',
                            '{{ route('categories.update', ':slug') }}'.replace(
                                ':slug', slug));

                        $('#editModal').modal('show');
                    }
                });
            });

            // Handle delete
            $('.delete-button').click(function() {
                let slug = $(this).data('slug');

                $.ajax({
                    url: '{{ route('categories.find', ':slug') }}'.replace(':slug', slug),
                    type: 'GET',
                    success: function(response) {
                        let category = response.category;

                        $('#deleteModal').modal('show');
                        $('#deleteForm').attr('action',
                            "{{ route('categories.destroy', ':slug') }}"
                            .replace(':slug', slug));
                        $("#deleteText").text(
                            "Apakah anda yakin ingin menghapus kategori " +
                            category.name + "?");
                    }
                });
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
