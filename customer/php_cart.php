<!DOCTYPE html>
<?php 
  include '../config/connection.php';
  $connect = new PDO("mysql:host=localhost;dbname=db_pims", "root", "");
  include 'includes/header.php';

$message = '';

  if(isset($_POST["add_to_cart"])){
    if(isset($_COOKIE["shopping_cart"])){
      $cookie_data = stripslashes($_COOKIE['shopping_cart']);

      $cart_data = json_decode($cookie_data, true);
    } else {
      $cart_data = array();
    }

    $item_id_list = array_column($cart_data, 'item_id');

    if(in_array($_POST["hidden_id"], $item_id_list)){
      foreach($cart_data as $keys => $values){
        if($cart_data[$keys]["item_id"] == $_POST["hidden_id"]){
          $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $_POST["quantity"];
        }
      }
    } else {
      $item_array = array(
        'item_id' => $_POST["hidden_id"], 
        'item_name' => $_POST["hidden_name"], 
        'item_price' => $_POST["hidden_price"], 
        'item_quantity' => $_POST["quantity"]
      );
      $cart_data[] = $item_array;
    }

    $item_data = json_encode($cart_data);
    setcookie('shopping_cart', $item_data, time() + (86400 * 30));
    header("location:index.php?success=1");
  }

  if(isset($_GET["action"])){
    if($_GET["action"] == "delete"){
	    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
		  $cart_data = json_decode($cookie_data, true);
		  foreach($cart_data as $keys => $values){
        if($cart_data[$keys]['item_id'] == $_GET["id"]){
				  unset($cart_data[$keys]);
				  $item_data = json_encode($cart_data);
				  setcookie("shopping_cart", $item_data, time() + (86400 * 30));
				  header("location:index.php?remove=1");
			  }
		  }
	  }
	
    if($_GET["action"] == "clear"){
		  setcookie("shopping_cart", "", time() - 3600);
		  header("location:index.php?clearall=1");
	  }
  }

  if(isset($_GET["success"])){
    $message = '
	  <div class="alert alert-success alert-dismissible">
	  	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  	Item Added into Cart
	  </div>
	  ';
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

?>

<html lang="en">
<head>
  <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Style Sheet -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/style.css">

  <title>Cart | X Publishers</title>
</head>

<body>
		<br />
		<div class="container">
			<br />
			<h3 align="center">Simple PHP Mysql Shopping Cart using Cookies</h3><br />
			<br><br>
	
			
			<div style="clear:both"></div>
			<br>
			<h3>Order Details</h3>
			<div class="table-responsive">
			<?php echo $message; ?>
			<div align="right">
				<a href="index.php?action=clear"><b>Clear Cart</b></a>
			</div>
			<table class="table table-bordered">
				<tr>
					<th width="40%">Item Name</th>
					<th width="10%">Quantity</th>
					<th width="20%">Price</th>
					<th width="15%">Total</th>
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
					<td><?php echo $values["item_name"]; ?></td>
					<td><?php echo $values["item_quantity"]; ?></td>
					<td>$ <?php echo $values["item_price"]; ?></td>
					<td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
					<td><a href="index.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
				</tr>
			<?php	
					$total = $total + ($values["item_quantity"] * $values["item_price"]);
				}
			?>
				<tr>
					<td colspan="3" align="right">Total</td>
					<td align="right">$ <?php echo number_format($total, 2); ?></td>
					<td></td>
				</tr>
			<?php
			}
			else
			{
				echo '
				<tr>
					<td colspan="5" align="center">No Item in Cart</td>
				</tr>
				';
			}
			?>
			</table>
			</div>
		</div>
		<br>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</html>