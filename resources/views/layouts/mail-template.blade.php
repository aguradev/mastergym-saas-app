<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Default')</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        h4 {
            font-size: 1.4rem;
        }

        p {
            font-size: 1.125rem;
        }

        hr {
            border-top: 1px;
            width: 100%;
        }

        .logo {
            font-size: 1.4rem;
            text-align: center;
            font-weight: 600;
        }

        h1 {
            font-size: 3.4rem;
        }

        h2 {
            font-size: 2rem;
        }

        .text-center {
            text-align: center;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            background: #FAFAFA;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 1rem 3rem;
            background: #FFF;
        }

        .bg-secondary {
            color: #FFF;
            background: #222;
        }
    </style>
</head>

<body>
    <div class="container" style="border-radius: 4px;">
        <p class="logo">Master Gym</p>
        <hr style="margin-bottom: 2.2rem" />

        @yield('main')
    </div>
    <footer class="container bg-secondary">
        <h3 style="text-align: center;">Master Gym</h3>
        <p style="text-align: center;">&copy; {{ now()->format('Y') }} | Mastergym.com</p>
    </footer>
</body>

</html>
