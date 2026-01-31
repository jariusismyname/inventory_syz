<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://kit.fontawesome.com/d432e81264.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

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
          <a class="nav-link active" href="cart.php"><i class="fa fa-shopping-cart"></i> <span id="cart-item" class="badge bg-danger"></span></a>
        </li>
      </form>
    </div>
  </div>
</nav>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
              <div style="display:<?php if(isset($_SESSION['showAlert'])){echo $_SESSION['showAlert'];}else{echo'none';}unset($_SESSION['showAlert']) ?>;" class="alert alert-warning alert-dismissible mt-3 fade show" role="alert">
                      <strong><?php if(isset($_SESSION['message'])){echo $_SESSION['message'];}unset($_SESSION['showAlert']) ?></strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                <div class="table-responsive mt-2">
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                              <tr>
                            <td colspan="7">
                                <h4 class="text-center text-info m-0">Products in your cart!</h4>
                            </td>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                        <th>Product</th>

                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>
                                <a href="action.php?clear=all" class="badge-danger badge p-2" onclick="return confirm('Are you sure you want to clear your cart?');"><i class="fas fa-trash"></i>&nbsp;&nbsp; Clear Cart</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                     <?php
                                        require 'config.php';

                                        // We join the cart and products tables. 
                                        // This allows us to get the cart data AND the current stock (quantity) from the products table at once.
                                        $sql = "SELECT cart.*, products.product_quantity AS stock_available 
                                                FROM cart 
                                                JOIN products ON cart.product_code = products.product_code";
                                                
                                        $stmt = $conn->prepare($sql);

                                        // Check if prepare() failed
                                        if (!$stmt) {
                                            die("Query failed: " . $conn->error);
                                        }

                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $grand_total = 0; 

                                        while($row = $result->fetch_assoc()):
                                            $imagePath = "../../../public/db_img/" . $row['product_image'];
                                            // Use the stock from the products table as the max limit
                                            $max_allowed = $row['stock_available'];
                                    ?>
                                                          <tr>
                                        <td><?=$row['id']?></td>
                                        <input type="hidden" class="pid" value="<?=$row['id']?>">
                                        <td><img src="<?= htmlspecialchars($imagePath) ?>" width="50" alt=""></td>
                                        <td><?=$row['product_name']?></td>
                                        <td><i class="fas fa-peso-sign"></i>&nbsp;&nbsp;<?=number_format($row['price'],2);?></td>
                                        <input type="hidden" class="pprice" value="<?= $row['price'] ?>" >
                                        <td>
                                            <input 
                                            type="number" 
                                                  max="<?= $max_allowed ?>" 
                                                  min="1" 
                                                  class="form-control itemQty" 
                                                  value="<?=$row['quantity']?>" 
                                                  style="width:75px;">
                                            <small class="text-muted">Available: <?= $max_allowed ?></small>
                                        </td>
                                        <td><i class="fas fa-peso-sign"></i>&nbsp;&nbsp;<?=number_format($row['total_amount'],2);?></td>
                                        <td>
                                            <a href="action.php?remove=<?=$row['id']?>" class="text-danger lead" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                          <?php $grand_total+=$row['total_amount'];?>
                        <?php endwhile;?>
                        <tr>
                          <td colspan="3">
                              <a href="index.php" class="btn btn-success"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp; Continue Shopping</a>
                          </td>
                          <td colspan="2"><b>Grand Total</b></td>
                          <td><b><i class="fas fa-peso-sign"></i>&nbsp;&nbsp;<?=number_format($grand_total,2);?></td>
                          <td>
                            <a href="checkout.php" class="btn btn-info  <?= ($grand_total>1 )?"":"disabled"; ?>"><i class="far fa-credit-card"></i>&nbsp;&nbsp;Checkout</a>
                          </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script type="text/javascript">
  $(document).ready(function (){

    $(".itemQty").on('change',function(){
      var $el = $(this).closest('tr');
      var pid = $el.find(".pid").val();
      var pprice = $el.find(".pprice").val();
      var qty = $el.find(".itemQty").val();
      location.reload(true);
      location.reload(true);
      
      console.log(qty)

      $.ajax({
        url:'action.php',
        method:'post',
        cache:false,
        data:{qty:qty,pid:pid,pprice:pprice},
        success:function(response){ 
          console.log(response);
        }
      });

    });

   load_cart_item_number()

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