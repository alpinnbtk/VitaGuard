<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>VitaGuard</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container mt-5">
            <h1 class="text-center">VitaGuard Health Platform</h1>
        </div>
        <div class="text-center mt-4">
            <a href="{{ url('/admin') }}" class="btn btn-primary">Halaman Dashboard</a>
        </div>
    </body>
</html>
