<!doctype html>
<html lang="en">
  <head>
    <title>User Registration Form</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        .required label::after{
            content:" *";
            color: red;
        }
    </style>
  </head>

  <body>
    <form action="{{url('/')}}/register" method="POST">
    @csrf
    <div class="container">
        <h2 class="text-center text-primary">User Registration</h2>
        <div class="row">
            <div class="form-group col-md-6 required">
                <label for="">First Name</label>
                <input type="text" name="first_name" id="" class="form-control" value="{{old('first_name')}}"/>
                <span class="text-danger">
                    @error('first_name')
                        {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group col-md-6">
                <label for="">Last Name</label>
                <input type="text" name="last_name" id="" class="form-control" value="{{old('last_name')}}"/>
                <span class="text-danger">
                    @error('last_name')
                        {{$message}}
                    @enderror
                </span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6 required">
                <label for="">Phone Number</label>
                <input type="text" name="phone" id="" class="form-control" value="{{old('phone')}}"/>
                <span class="text-danger">
                    @error('phone')
                        {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group col-md-6 required">
                <label for="">Email Address</label>
                <input type="email" name="email" id="" class="form-control" value="{{old('email')}}"/>
                <span class="text-danger">
                    @error('email')
                        {{$message}}
                    @enderror
                </span>
            </div>
        </div>
    
        <div class="row">
            <div class="form-group col-md-12 required">
                <label for="">Address</label>
                <input type="text" name="address" id="" class="form-control" value="{{old('address')}}"/>
                <span class="text-danger">
                    @error('address')
                        {{$message}}
                    @enderror
                </span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6 required">
                <label for="">Password</label>
                <input type="password" name="password" id="" class="form-control" value="{{old('password')}}"/>
                <span class="text-danger">
                    @error('password')
                        {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group col-md-6 required">
                <label for="">Confirm Password</label>
                <input type="password" name="confirm_password" id="" class="form-control" value="{{old('confirm_password')}}"/>
                <span class="text-danger">
                    @error('confirm_password')
                        {{$message}}
                    @enderror
                </span>
            </div>
        </div>

        <button class="btn btn-primary col-md-12" >
            Register
        </button>
    </div>
</form>
  </body>
</html>