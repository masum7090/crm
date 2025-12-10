<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>{{ $title ?? 'Marketplace' }}</title>
</head>
<body class="bg-white text-gray-800">

@include('market_place.partials.navbar')

<main>
    @yield('content')
</main>

@include('market_place.partials.footer')

</body>
</html>
