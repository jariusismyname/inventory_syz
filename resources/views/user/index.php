<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://kit.fontawesome.com/d432e81264.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart System</title>
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
      <div id="message"></div>
      <div class="row mt-2">
        <?php
          include 'config.php';
          $stmt=$conn->prepare("SELECT * FROM products");
          $stmt->execute();
          $result=$stmt->get_result();
          while($row=$result->fetch_assoc()):
$imagePath = "../../../public/db_img/" . $row['product_image'];

        ?>
        <div class="col-sm-6 col-md-4 col-lg-3 mb-2">
          <div class="card-deck">
            <div class="card p-2 border-secondary mb-2">
              <img src="<?= htmlspecialchars($imagePath) ?>" class="card-img-top"  height="250"  >
              <div class="card-body p-1">
                <h4 class="card-title text-center text-info"><?=$row['product_name']?></h4>
                <h5 class="card-text text-center text-danger"><i class="fas fa-peso-sign"></i>&nbsp;&nbsp;<?= number_format($row['product_price'],2)?>/-</h5>
                
              </div>
              <div class="card-footer p-1">
                <form action="" class="form-submit">
                  <input type="hidden" class="pid" value="<?= $row['id'] ?>" name="">
                  <input type="hidden" class="pname" value="<?= $row['product_name'] ?>" name="">
                  <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>" name="">
                  <input type="hidden" class="pimage" value="<?= $row['product_image'] ?>" name="">
                   <input type="hidden" class="pcode" value="<?= $row['product_code'] ?>" name="">
                      <div class="d-grid">
                        <button class="btn btn-primary btn-lg addItemBtn" type="button">
                          <i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Add To Cart
                        </button>
                      </div>
                </form>
                 </div>
            </div>
          </div>
        </div>
        <?php endwhile;?>
      </div>
    </div>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script type="text/javascript">
  $(document).ready(function (){
    $(".addItemBtn").click(function(e){
      e.preventDefault();
      var $form = $(this).closest(".form-submit");

      // Added the "." selector so jQuery actually finds the values
      var pid = $form.find(".pid").val();
      var pname= $form.find(".pname").val();
      var pprice = $form.find(".pprice").val();
      var pimage = $form.find(".pimage").val();
      var pcode = $form.find(".pcode").val();
      // Note: You don't have a ".pname" input in your HTML, you might need to add one!

      $.ajax({
        url: "action.php",
        method: 'POST', // Use uppercase for clarity
        data: {
          pid: pid,
          pname: pname,
          pprice: pprice,
          pimage: pimage,
          pcode: pcode
        },
        success: function(response){
          $("#message").html(response); 
          window.scrollTo(0,0);
          load_cart_item_number();
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