<!DOCTYPE html>
<?php
  include 'includes/header.php';
  include '../config/connection.php';

  $message = '';


  if(isset($_GET["action"])){
    if($_GET["action"] == "delete"){
	    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
		  $cart_data = json_decode($cookie_data, true);
		  foreach($cart_data as $keys => $values){
        if($cart_data[$keys]['book_id'] == $_GET["id"]){
				  unset($cart_data[$keys]);
				  $item_data = json_encode($cart_data);
				  setcookie("shopping_cart", $item_data, time() + (86400 * 30));
				  header("location:cart.php?remove=1");
			  }
		  }
	  }
	
    if($_GET["action"] == "clear"){
		  setcookie("shopping_cart", "", time() - 3600);
		  header("location:cart.php?clearall=1");
	  }
  }

  if(isset($_GET["remove"])){
	  $message = '
	    <div class="alert alert-success alert-dismissible">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		    Item removed from Cart
	    </div>
	  ';
  }

  if(isset($_GET["clearall"])){
	  $message = '
	    <div class="alert alert-success alert-dismissible">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		    Your Shopping Cart has been clear...
	    </div>
	  ';
  }

  if(isset($_POST['checkout_btn'])){
    header('location: checkout.php');
  }

?>



<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart | X Publications</title>
</head>
<body>
  <div class="container">
    <br>
    <div class="container-fluid">
      <div class="container-fluid flex-row">
        <div class="d-flex justify-content-start"><h3>Order Details</h3></div>

        <?php echo $message; ?>
			  <div align="right">
				    <a href="cart.php?action=clear"><b>Clear Cart</b></a>
			  </div>
        <br>
      </div>

      <br>
      <div class="scrollme">
        <table class="table table-striped table-hover table-responsive align-middle width:100% display nowrap">

        <tr>
					<th width="40%">Book Name</th>
          <th width="20%">Author</th>
					<th width="10%">Quantity</th>
					<th width="10%">Price</th>
					<th width="10%">Total</th>
					<th width="5%">Action</th>
				</tr>
			<?php
			if(isset($_COOKIE["shopping_cart"])){
				$total = 0;
				$cookie_data = stripslashes($_COOKIE['shopping_cart']);
				$cart_data = json_decode($cookie_data, true);
				foreach($cart_data as $keys => $values){
			?>
				<tr>
					<td><?php echo $values["book_name"]; ?></td>
          <td><?php echo $values["book_author"]; ?></td>
					<td><?php echo $values["book_quantity"]; ?></td>
					<td align="right">৳ <?php echo $values["book_price"]; ?></td>
					<td align="right">৳ <?php echo number_format($values["book_quantity"] * $values["book_price"], 2);?></td>
					<td align="right"><a href="cart.php?action=delete&id=<?php echo $values["book_id"]; ?>"><span class="btn btn-outline-danger">Remove</span></a></td>
				</tr>
			<?php	
					$total = $total + ($values["book_quantity"] * $values["book_price"]);
				}
			?>
        <tfoot>
				<tr>
          <td colspan="3" align="right"></td>
					<td colspan="1" align="left"><h7><b>Total</b></h7></td>
					<td colspan="1" align="right">৳ <?php echo number_format($total, 2); ?></td>
					<td></td>
				</tr>
        </tfoot>
			<?php
			}
			else
			{
				echo '
        <tfoot>
				<tr>
					<td colspan="5" align="center">Cart is empty!</td>
				</tr>
        </tfoot>
				';
			}
			?>
        </table>
      </div>

      <br>
      <form class="d-flex justify-content-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="d-flex justify-content-center">
        <button class="btn btn-success" type="submit" name="checkout_btn">Checkout</button>
      </div>
      </form>
    </div>
  </div>
</body>
</html>