<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Simple Image Gallery</title>

        <link href="css/app.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="app">
            <app></app>
        </div>
        <script src="js/app.js"></script>
    </body>
</html>
