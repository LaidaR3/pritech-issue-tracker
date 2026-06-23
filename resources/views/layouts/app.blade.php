<!DOCTYPE html>
<html>
<head>
    <title>Issue Tracker</title>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1000px;
            margin: 40px auto;
        }

        .btn {
            padding: 8px 12px;
            text-decoration: none;
            border: 1px solid #ccc;
            margin-right: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
        }

        .success {
            background: #d4edda;
            padding: 10px;
            margin-bottom: 15px;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>

<h1>Mini Issue Tracker</h1>

@if(session('success'))
    <div class="success">
        {{ session('success') }}
    </div>
@endif

@yield('content')

</body>
</html>