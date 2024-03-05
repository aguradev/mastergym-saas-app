<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue", 'resources/css/app.css', 'resources/css/base.css'])
    @inertiaHead
</head>

<body>
    @inertia
</body>

</html>
