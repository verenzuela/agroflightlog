
<!DOCTYPE html>
<html lang="en">

  <head>

      <meta charset="utf-8">
      <meta name="description" content="Registro de vuelos de agrocultivo">
      <meta name="keywords" content="drone,vuelos,agricultura,cultivos,fumigacion">
      <meta name="author" content="AgroFlightLog">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <link rel="icon" href="/img/home/favicon.ico">

      <title> @yield('title') </title>

      <!-- Favicons-->
      <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
      
      <!-- Bootstrap core CSS -->
      <link href="{{ asset('node_modules/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">


      <!-- YOUR CUSTOM CSS -->
      <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
      
      <!-- FONTAWESONE -->
      

      @yield('styles')

  </head>

  <body class="text-center" style="background-color: white;">
    @yield('content')
  </body>

  <!-- Search Menu -->
  
  <!-- COMMON SCRIPTS -->
  <script src="{{-- asset('node_modules/bootstrap/dist/js/bootstrap.min.js') --}}"></script>
  <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>

  <script type="text/javascript">
    $(document).ready(function(){

    });
  </script>

  @yield('script')

</html>