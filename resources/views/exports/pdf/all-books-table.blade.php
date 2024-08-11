<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books Export</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            margin-top: 30px;
        }

        .table {
            margin-bottom: 30px;
            border-collapse: collapse;
        }

        .table thead th {
            background-color: #e9ecef;
            font-weight: bold;
            color: #495057;
        }

        .table,
        .table th,
        .table td {
            border: 1px solid #dee2e6;
            /* border color */
        }

        .table td,
        .table th {
            padding: 12px;
            text-align: left;
        }

        .table tbody td {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mb-4">Daftar Buku Saya</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Pembuat</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th>Jumlah</th>
                    <th>File</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $index => $book)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->user->name }}</td>
                        <td>{{ $book->category ? $book->category->name : '-' }}</td>
                        <td>{{ $book->description }}</td>
                        <td>{{ $book->quantity }}</td>
                        <td>
                            <a href="{{ $book->file_path }}" target="_blank">Download file</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
