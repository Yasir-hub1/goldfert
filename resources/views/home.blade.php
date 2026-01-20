<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GOLDFERT - Fertilizantes Agrícolas de Alta Tecnología en Bolivia</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    {{-- SEO Básico --}}
    <meta name="description" content="GOLDFERT ofrece fertilizantes foliares, bioestimulantes y soluciones nutricionales de alta tecnología para maximizar el rendimiento de tus cultivos en Bolivia.">
    <meta name="keywords" content="GOLDFERT, fertilizantes foliares, bioestimulantes agrícolas, nutrición vegetal, agricultura Bolivia, SULFERT, CALBORZINC, VITAL Mix">
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph / Facebook --}}
    <meta property="og:title" content="GOLDFERT - Fertilizantes Agrícolas de Alta Tecnología en Bolivia">
    <meta property="og:description" content="Soluciones nutricionales avanzadas para cultivos más productivos y rentables: fertilizantes foliares, bioestimulantes y formulaciones especializadas.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="GOLDFERT Fertilizantes">
    <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">
    {{-- Ajusta la ruta de la imagen destacada según tu estructura --}}
    <meta property="og:image" content="{{ url('/images/portada1.2.1.png') }}">
    <meta property="og:image:alt" content="Productos GOLDFERT en campo de cultivo">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="GOLDFERT - Fertilizantes Agrícolas de Alta Tecnología en Bolivia">
    <meta name="twitter:description" content="Fertilizantes foliares y bioestimulantes de última generación para impulsar tu cosecha.">
    <meta name="twitter:image" content="{{ url('/images/portada1.2.1.png') }}">

    {{-- Datos estructurados JSON-LD (Organization + WebSite) --}}
    <script type="application/ld+json">
        {
            "@@context": "https://schema.org",
            "@@type": "Organization",
            "name": "GOLDFERT Fertilizantes",
            "url": "{{ url('/') }}",
            "logo": "{{ url('/images/logo.png') }}",
            "description": "Fertilizantes foliares, bioestimulantes y soluciones nutricionales de alta tecnología para la agricultura en Bolivia.",
            "sameAs": [
                "https://www.facebook.com/profile.php?id=100054637500718",
                "https://www.instagram.com/goldfert.rg",
                "https://www.tiktok.com/@goldfert"
            ]
        }
    </script>
    <script type="application/ld+json">
        {
            "@@context": "https://schema.org",
            "@@type": "WebSite",
            "name": "GOLDFERT Fertilizantes",
            "url": "{{ url('/') }}",
            "potentialAction": {
                "@@type": "SearchAction",
                "target": "{{ url('/') }}?s={search_term_string}",
                "query-input": "required name=search_term_string"
            }
        }
    </script>

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
