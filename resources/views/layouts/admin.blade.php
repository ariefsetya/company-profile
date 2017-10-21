<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

      <link type="text/css" rel="stylesheet" href="{{asset('css/materialize.css')}}"  media="screen,projection"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
      <script type="text/javascript" src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('js/materialize.js')}}"></script>
</head>
<body>
    <div id="app" class="container">

        @yield('content')

    </div>
        
</body>
</html>
