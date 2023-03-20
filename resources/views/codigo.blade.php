<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Codigo</title>

                <!-- Fonts -->
                <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" style="  position: absolute; top: 30%; left: 50%; transform: translate(-50%, -50%); font-size:3em;">
            {{ __('Codigo de Verificación Movil') }}
        </h2>
        <p class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" style="  position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size:3em;"> 
        {{ $code_verification }} 
        </p>
        </div>

        
    </body>
</html>