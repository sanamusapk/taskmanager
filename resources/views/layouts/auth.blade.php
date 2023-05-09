<!DOCTYPE html>
<html class="h-full bg-white">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @livewireStyles
</head>

<body class="h-full font-mont bg-white antialiased flex flex-col h-screen">
    
    <main class="relative bg-white">
            {{ $slot }}
    </main>
    @livewireScripts
    @stack('scripts')
</body>

</html>
