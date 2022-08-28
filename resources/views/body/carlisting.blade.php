<!doctype html>
<html lang="en">
  <head>
    <title>Vehicle Management System</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <div class="row m-5">
            <form action="" class="col-12">
                <div class="form-group" >
                  <input type="search" name="search" id="" class="form-control" 
                  placeholder="Search Car Name, Brand, Transmission type, Fuel type" value="{{$search ?? ''}}">
                </div>
                <button class="btn btn-primary">Search</button>
                <a href="{{url('/dashboard')}}">
                    <button class="btn btn-primary" type="button">Reset</button>
                </a>
            </form>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Brand</th>
                    <th>Model year</th>
                    <th>Fuel type</th>
                    <th>Transmission</th>
                    <th>Mileage</th>
                    <th>Colors available</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cars as $car)
                <tr>
                    <td>{{$car->id}}</td>
                    <td>{{$car->car_name}}</td>
                    <td>{{$car->brand}}</td>
                    <td>{{$car->model_year}}</td>
                    <td>{{$car->fuel_type}}</td>
                    <td>{{$car->transmission}}</td>
                    <td>{{$car->mileage_kmpl}}</td>
                    <td>{{$car->colors_available}}</td>
                    <td>{{$car->price_rs}}</td>
                    <td>
                        <a href="/login">
                            <button class="btn  btn-primary">Add to Cart</button>
                        </a>
                    </td>
                    <td>
                        <a href="/login">
                            <button class="btn  btn-success">Buy Now</button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </body>
</html>