<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Verificación</title>

    </head>
    <body>

    <h1> {{ $mailData['title'] }} </h1>

    <p> {{ $mailData['body'] }} </p>

    <a href="{{ url($url) }}">Codigo de Verificación</a>

    <p> Gracias por Registrarte con PedroDSM.online. </p>

    </body>
</html>
