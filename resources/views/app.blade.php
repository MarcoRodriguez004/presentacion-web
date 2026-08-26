<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="theme-color" content="#10251f">
        <meta name="description" content="Presentación profesional de Marco Antonio Rodríguez Hernández, desarrollador fullstack especializado en Laravel y Vue.js.">
        <meta name="robots" content="index, follow">
        <meta property="og:type" content="website">
        <meta property="og:locale" content="es_MX">
        <meta property="og:title" content="Marco Rodríguez — Desarrollador Fullstack">
        <meta property="og:description" content="Desarrollador fullstack especializado en Laravel y Vue.js, con foco en lógica de negocio, APIs, datos y seguridad.">
        <meta property="og:url" content="{{ url('/') }}">
        <meta property="og:site_name" content="Marco Rodríguez">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="Marco Rodríguez — Desarrollador Fullstack">
        <meta name="twitter:description" content="Presentación técnica de Marco Rodríguez.">
        <link rel="canonical" href="{{ url('/') }}">

        @php
            $structuredData = [
                '@context' => 'https://schema.org',
                '@type' => 'Person',
                'name' => 'Marco Antonio Rodríguez Hernández',
                'jobTitle' => 'Desarrollador Fullstack',
                'url' => url('/'),
                'email' => 'marco.rh004@gmail.com',
                'address' => [
                    '@type' => 'PostalAddress',
                    'addressLocality' => 'Estado de México',
                    'addressCountry' => 'MX',
                ],
                'knowsAbout' => [
                    'Laravel',
                    'Vue.js',
                    'PHP',
                    'Java',
                    'Spring Boot',
                    'REST API',
                    'MySQL',
                    'PostgreSQL',
                    'Docker',
                    'mTLS',
                ],
            ];
        @endphp
        <script type="application/ld+json">{!! json_encode($structuredData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>

        @if (config('services.plausible.domain'))
            <script defer data-domain="{{ config('services.plausible.domain') }}" src="https://plausible.io/js/script.js"></script>
        @endif

        <title inertia>Marco Rodríguez — Desarrollador Fullstack</title>
        @vite(['resources/css/app.css', 'resources/js/app.ts'])
        @inertiaHead
    </head>
    <body>
        @inertia
    </body>
</html>
