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
                <div class="form-group">
                  <input type="search" name="name" class="form-control" 
                  placeholder="Search Name" value="{{$name ?? ''}}">

                  <input type="search" name="brand" class="form-control" 
                  placeholder="Search Brand" value="{{$brand ?? ''}}">

                  <input type="search" name="model" class="form-control" 
                  placeholder="Search Model" value="{{$model ?? ''}}">

                  <input type="search" name="year" class="form-control" 
                  placeholder="Search Model Year" value="{{$year ?? ''}}">

                  <input type="search" name="fuel_type" class="form-control" 
                  placeholder="Search Fuel Type" value="{{$fuel ?? ''}}">
                  
                  <input type="search" name="transmission" class="form-control" 
                  placeholder="Search Transmission Type" value="{{$transmission ?? ''}}">

                </div>
                <button class="btn btn-primary">Search</button>
                <a href="{{url('/profile/customer')}}">
                    <button class="btn btn-primary" type="button">Reset</button>
                </a>
            </form>
        </div>
        <table class="table" style="text-align: center">
            <thead>
                <tr>
                    <th style="vertical-align: middle">Name</th>
                    <th style="vertical-align: middle">Brand</th>
                    <th style="vertical-align: middle">Model</th>
                    <th style="vertical-align: middle">Model Year</th>
                    <th style="vertical-align: middle">Fuel Type</th>
                    <th style="vertical-align: middle">Transmission</th>
                    <th style="vertical-align: middle">Mileage</th>
                    <th style="vertical-align: middle">Colors</th>
                    <th style="vertical-align: middle">Price</th>
                    <th style="vertical-align: middle">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cars as $car)
                <tr>
                    <td style="vertical-align: middle">{{$car->car_name}}</td>
                    <td style="vertical-align: middle">{{$car->brand}}</td>
                    <td style="vertical-align: middle">{{$car->model}}</td>
                    <td style="vertical-align: middle">{{$car->model_year}}</td>
                    <td style="vertical-align: middle">{{$car->fuel_type}}</td>
                    <td style="vertical-align: middle">{{$car->transmission}}</td>
                    <td style="vertical-align: middle">{{$car->mileage_kmpl}}</td>
                    <td style="vertical-align: middle">{{$car->colors_available}}</td>
                    <td style="vertical-align: middle">{{$car->price_rs}}</td>
                    <td style="vertical-align: middle">
                        <a href="/login">
                            <button class="btn  btn-primary">Add to Cart</button>
                        </a>
                    </td>
                    <td style="vertical-align: middle">
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