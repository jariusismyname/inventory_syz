<?php
    require 'config.php';
    $grand_total=0;
    $allItems ='';
    $items =  array();

    $sql="SELECT CONCAT(product_name, '(',quantity,')') AS ItemQty, total_amount FROM cart ";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $result=$stmt->get_result();
    while ($row =$result->fetch_assoc()){
        $grand_total+=$row['total_amount'];
        $items[]=$row['ItemQty'];

    }
    $allItems =implode(",",$items);
    


?>



<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://kit.fontawesome.com/d432e81264.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    <!-- A grey horizontal navbar that becomes vertical on small screens -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><i class="fas fa-store"></i>&nbsp;&nbsp;ShopCon Store</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ml-auto">
        
          
      </ul>
      <form class="navbar-nav ml-auto">
          <li class="nav-item">
          <a class="nav-link active" href="index.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="checkout.php">Checkout</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart"></i> <span id="cart-item" class="badge bg-danger"></span></a>
        </li>
      </form>
    </div>
  </div>
</nav>


    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 px-4 pb-4 " id="order">
            <h4 class="text-center text-info p-2">Complete your order!</h4>
            <div class="p-3 mb-2 bg-secondary text-white rounded text-center">
            <h6 class="lead"><b>Product(s): </b><?=$allItems;?></h6>
            <h6 class="lead"><b>Delivery Charge : </b> Free</h6>
            <h5><b>Total Amount Payable :</b><?=number_format($grand_total,2)?>/-</h5>
        </div>
        <form  method="post" id="placeOrder">
                      <div class="form-group">

<input type="hidden" name="product_id" value="<?= $product['id'] ?>">
            </div>

            <input type="hidden" name="products" value="<?= $allItems;?>">
            <input type="hidden" name="grand_total" value="<?= $grand_total;?>">
            <div class="form-group">
                <input type="text" name="name"  class="form-control" placeholder="Enter Name" required autocomplete="name">
            </div>
            <div class="form-group">
                <input type="email" name="email"  class="form-control" placeholder="Enter Email" required autocomplete="email">
            </div>
            <div class="form-group">
                <input type="tel" name="phone"  class="form-control" placeholder="Enter Phone" required autocomplete="tel">
            </div>
            <div class="form-group">
                <textarea name="address" class='form-control' id="" cols="10" rows='3' placeholder='Enter delivery address here...' required autocomplete="address"></textarea>
</div>
        <h6 required class='text-center lead'>Select Payment Method</h6>
        <div class="form-group">
            <select name="pmode" class="form-control">
                <option value="" selected disabled>Select Payment Mode</option>
                 <option value="cod">Cash On Delivery</option>
                 <option value="netbanking">Net Banking</option>
                 <option value="cards">Debit/Credit Card</option>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Place Order" class="btn btn-danger btn-block">
        </div>
        </form>
      </div>
    </div>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script type="text/javascript">
  $(document).ready(function (){
   
    $("#placeOrder").submit(function(e){
        e.preventDefault();
        $.ajax({
            url:'action.php',
            method:'post',
            data:$('#placeOrder').serialize()+"&action=order",
            success: function(response){
                $("#order").html(response) 
            }
        });
    });

    load_cart_item_number();

    function load_cart_item_number(){
      $.ajax({
        url: 'action.php',
        method:'get',
        data:{cartItem:"cart_item"},
        success:function(response){
          $("#cart-item").html(response);
        }
      });
    }
  });
</script>
</body>
</html>