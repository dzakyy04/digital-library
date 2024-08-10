Perbaiki ini:
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books Export</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/assets/css/dashlite.css') }}">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            margin-top: 30px;
        }

        .book-details {
            padding: 20px;
            border: 1px solid #e3e6f0;
            border-radius: 10px;
            margin-bottom: 30px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .book-cover img {
            max-height: 250px;
            border-radius: 10px;
            object-fit: cover;
        }

        .book-info {
            margin-top: 20px;
        }

        .book-info table {
            width: 100%;
            border-collapse: collapse;
        }

        .book-info th,
        .book-info td {
            padding: 4px;
            vertical-align: top;
        }

        .book-info th {
            text-align: left;
            width: 120px;
            font-weight: bold;
            color: #6c757d;
            padding-right: 10px;
        }

        .book-info td {
            color: #212529;
        }

        .book-description {
            margin-top: 20px;
            font-size: 14px;
            color: #495057;
            line-height: 1.7;
        }

        .book-description strong {
            color: #343a40;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Daftar Buku Saya</h1>
        @foreach ($books as $index => $book)
            <div class="book-details">
                <h2>{{ $index + 1 }}. {{ $book->title }}</h2>
                <div class="book-cover text-center">
                    <img src="{{ $book->cover_path }}" alt="Cover">
                </div>
                <div class="book-info">
                    <table>
                        <tr>
                            <th>Judul</th>
                            <td>:</td>
                            <td>{{ $book->title }}</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>:</td>
                            <td>{{ $book->category ? $book->category->name : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>:</td>
                            <td style="text-align: justify">{{ $book->description }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah</th>
                            <td>:</td>
                            <td>{{ $book->quantity }}</td>
                        </tr>
                        <tr>
                            <th>File</th>
                            <td>:</td>
                            <td>
                                <a href="{{ $book->file_path }}">Download file</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
</body>

</html>
