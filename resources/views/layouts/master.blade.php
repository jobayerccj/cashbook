
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
   
    <title>Blog Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="/cashbook/public/css/app.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">
     
      @include('layouts/nav')

      <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
        <div class="col-md-12 px-0">
          <h1 class="font-italic">Title of a longer featured blog post</h1>
          
        </div>
      </div>

      
    </div>

    <main role="main" class="container">
      <div class="row">

        @yield('content')

      </div><!-- /.row -->

      <br/>

      @include('layouts/footer')

    </main><!-- /.container -->

  </body>
</html>
