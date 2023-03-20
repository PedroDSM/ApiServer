<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

                <!-- Fonts -->
                <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" style="  position: absolute; top: 30%; left: 50%; transform: translate(-50%, -50%); font-size:4em;">
                {{ __('Codigo de Verificación') }}
            </h2>

        <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100" style="  position: absolute; top: 40%; left: 50%; transform: translate(-50%, -50%);">
                <form method="POST" action="{{ route('verification_code_web') }}">
                    <div>
                        <x-text-input id="code_values" class="textview" type="text" name="code_values" :value="old('code_values')" required autofocus/>
                        <x-input-error :messages="$errors->get('code_values')" class="mt-2" />
                    </div>
                    <button class="button">Aceptar</button>
                </form>
                </div>
            </div>
        </div>
        </div>
        </div>
        
    </body>
</html>

<style>
.button {
  transition-duration: 0.4s;
  border-radius: 12px;
  font-size: 20px;
  margin-top:8.5px;
  position: absolute; top: 110%; left: 50%; transform: translate(-50%, -50%);
  background-color: white;
  color: black;
  border: 4px solid black; 
  padding: 14px 40px;
}

.textview{
    width: 10em !important;
    height: 3em !important;
    background-color: transparent;
    text-align: center;
    font-size: 30px;
    font-family:Arial, Helvetica, sans-serif;
    margin-top: 4em;
    color: white;
}

.button:hover {
  background-color: transparent;
  border: 2px solid white; 
  color: white;
}
</style>