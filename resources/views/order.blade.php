<!doctype html>
<html lang="en">
  <head>
    <title>Order</title>
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
    <form action="" method="POST">
    @csrf
    <div class="container">
        <h2 class="text-center text-primary">Order Details</h2>
        <div class="row">
            <div class="form-group col-md-6 required">
                <label for="">Vehicle Type ID</label>
                <input type="text" name="vehicle_type_id" id="" class="form-control" value="vehicle_type_id" readonly/>
            </div>
            <div class="form-group col-md-6">
                <label for="">Vehicle Type</label>
                <input type="text" name="vehicle_type" class="form-control" value="{{ $request->vehicle_type ?? '' }}" readonly/>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6 required">
                <label for="">Customer User ID'</label>
                <input type="text" name='customer_user_id'id="" class="form-control" value=""/>
    
            </div>
            <div class="form-group col-md-6 required">
                <label for="">Dealer User ID</label>
                <input type="text" name="dealer_user_id" id="" class="form-control" value=""/>
            </div>
        </div>
    
        <div class="row">
            <div class="form-group col-md-6 required">
                <label for="">Payment Mode</label>
                <input type="text" name="payment_mode" id="" class="form-control" value=""/>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6 required">
                <label for="">Payment_Received</label>
                <input type="text" name="payment_received" id="" class="form-control" value=""/>
            </div>
            <div class="form-group col-md-6 required">
                <label for="">Added On</label>
                <input type="text" name="added_on" id="" class="form-control" value="{{ $ldate = date('Y-m-d') }}" readonly/>
            </div>
        </div>
        <br><br>
        <button class="btn btn-primary col-md-4 btn-lg" style="margin-left: 33%">
            Place Order
        </button>
    </div>
</form>
  </body>
</html>