@extends('dashboard.layouts.app')

@section('content')
    <div class="container">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <div class="preview-block">
                    <span class="preview-title-lg overline-title">Edit Data Buku</span>
                    <form method="post" action="{{ route('books.update', $book->slug) }}" enctype="multipart/form-data"
                        class="is-alter form-validate form-control-wrap">
                        @csrf
                        @method('PUT')
                        <div class="row gy-4">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label" for="title">Judul Buku</label>
                                    <div class="form-control-wrap">
                                        <input type="text" id="title"
                                            class="form-control @error('title') is-invalid @enderror" name="title"
                                            placeholder="Masukkan judul buku" value="{{ old('title', $book->title) }}"
                                            required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label" for="description">Deskripsi Buku</label>
                                    <div class="form-control-wrap">
                                        <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description"
                                            placeholder="Masukkan deskripsi buku">{{ old('description', $book->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="category">Kategori Buku</label>
                                    <div class="form-control-wrap">
                                        <select id="category"
                                            class="form-control @error('category_id') is-invalid @enderror"
                                            name="category_id" required>
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="quantity">Jumlah</label>
                                    <div class="form-control-wrap">
                                        <input type="number" id="quantity"
                                            class="form-control @error('quantity') is-invalid @enderror" name="quantity"
                                            placeholder="Masukkan jumlah buku"
                                            value="{{ old('quantity', $book->quantity) }}" required>
                                        @error('quantity')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="file_path">File Buku (PDF)</label>
                                    <div class="form-control-wrap">
                                        <p>Pratinjau PDF tidak bisa ditampilkan, <a
                                                href="{{ route('books.download', $book->slug) }}">silakan download
                                                disini</a> jika ingin melihatnya.</p>
                                        <input type="file" id="file_path"
                                            class="form-control @error('file_path') is-invalid @enderror" name="file_path"
                                            accept=".pdf" onchange="previewPDF(event)">
                                        @error('file_path')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="cover_path">Cover Buku (JPEG/JPG/PNG)</label>
                                    <div class="form-control-wrap">
                                        <img id="cover-preview" class="mb-2" src="{{ $book->cover_path }}"
                                            alt="Cover Preview">
                                        <input type="file" id="cover_path"
                                            class="form-control @error('cover_path') is-invalid @enderror" name="cover_path"
                                            accept="image/jpeg,image/png" onchange="previewCover(event)">
                                        @error('cover_path')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary"><em class="ni ni-save me-1"></em>
                                    Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        #pdf-preview,
        #cover-preview {
            max-height: 150px;
            width: auto;
            object-fit: contain;
        }

        #cover-preview {
            display: block;
        }
    </style>
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script>
        function previewPDF(event) {
            let file = event.target.files[0];
            let canvas = document.getElementById('pdf-preview');
            let context = canvas.getContext('2d');

            if (file && file.type === 'application/pdf') {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let loadingTask = pdfjsLib.getDocument({
                        data: e.target.result
                    });
                    loadingTask.promise.then(function(pdf) {
                        pdf.getPage(1).then(function(page) {
                            let viewport = page.getViewport({
                                scale: 1
                            });
                            canvas.height = viewport.height;
                            canvas.width = viewport.width;

                            let renderContext = {
                                canvasContext: context,
                                viewport: viewport
                            };
                            page.render(renderContext).promise.then(function() {
                                canvas.style.display = 'block';
                            });
                        });
                    });
                };
                reader.readAsArrayBuffer(file);
            } else {
                canvas.style.display = 'none';
            }
        }

        function previewCover(event) {
            let input = event.target;
            let preview = document.getElementById('cover-preview');
            let file = input.files[0];
            let reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        }

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
    </script>
@endpush
