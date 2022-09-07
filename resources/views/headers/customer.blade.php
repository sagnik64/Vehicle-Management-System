<!doctype html>
<html lang="en">
  <head>
    <title>Customer Profile Page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

    <div class="container fluid bg-dark">
            <div class="container">
            <nav class="navbar navbar-expand-sm">
                <a class="navbar-brand" href="" style="color: white">Vehicle Management System</a>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle Navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/api/users/{{session('uid')}}" style="color: white">{{ session('name') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/api/cart/{{session('uid')}}" style="color: white">My Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="" style="color: white">My Inventory</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/api/order/{{session('uid')}}" style="color: white">My Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/logout')}}" style="color: white">Logout</a>
                    </li>
                </ul>

            </div>
        </div>
    </div>
  </body>
</html>