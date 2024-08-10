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
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/js/example-toastr.js?ver=3.0.3') }}"></script>
    <script>
        $(document).ready(function() {
            // Handle slug
            $('#name').on('input', function() {
                var name = $(this).val();
                var slug = name.toLowerCase().replace(/\s+/g, '-');

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
                        $('#slug').val(slug);
                    }
                });
            });

            // Handle edit
            $('.edit-button').on('click', function() {
                var slug = $(this).data('slug');

                $.ajax({
                    url: '{{ route('categories.find', ':slug') }}'.replace(':slug', slug),
                    type: 'GET',
                    success: function(response) {
                        var category = response.category;

                        $('#edit_name').val(category.name);
                        $('#edit_slug').val(category.slug);

                        $('#editForm').attr('action',
                            '{{ route('categories.update', ':slug') }}'.replace(
                                ':slug', slug));

                        $('#editModal').modal('show');
                    }
                });
            });

            $('.delete-button').click(function() {
                var slug = $(this).data('slug');

                $.ajax({
                    url: '{{ route('categories.find', ':slug') }}'.replace(':slug', slug),
                    type: 'GET',
                    success: function(response) {
                        var category = response.category;

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
