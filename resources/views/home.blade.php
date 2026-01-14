<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GOLFERT - Fertilizantes Agrícolas</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- TikTok Embed Script -->
    <script async src="https://www.tiktok.com/embed.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 font-body antialiased transition-colors duration-300">
    <!-- Prevenir scroll automático al hash antes de que Vue cargue -->
    <script>
        // Prevenir scroll automático si hay hash en la URL
        if (window.location.hash && window.location.hash !== '#inicio') {
            // Guardar el hash
            const hash = window.location.hash;
            // Limpiar el hash temporalmente para prevenir scroll automático
            history.replaceState(null, null, ' ');
            // Restaurar el hash después de que la página cargue
            setTimeout(() => {
                history.replaceState(null, null, hash);
            }, 100);
        }
        // Asegurar que la página empiece en el top
        window.scrollTo(0, 0);
    </script>
    <!-- Vue App Mount Point -->
    <div id="app"></div>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
</body>
</html>
