<!DOCTYPE html>
<?php
  include 'includes/header.php';
  include '../config/connection.php';

  $message = '';

  if(isset($_POST['print_btn'])){
    $_SESSION['action'] = "print";
    header('Location: receipt.php');
  }

?>



<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout | X Publications</title>
</head>
<body>
  <div class="container">
    <br>
    <div class="container-fluid">
      <div class="container-fluid flex-row">
        <div class="d-flex justify-content-start"><h3>Order Details</h3></div>

        <div class="d-flex justify-content-end">
          <form class="d-flex" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <!-- button class="btn btn-secondary" type="submit" name="save_btn">Save</button>
                  &nbsp; &nbsp; -->
            <button class="btn btn-secondary" type="submit" name="print_btn">Print Receipt</button>
          </form>
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
				</tr>
        </tfoot>
			<?php
			}
			?>
        </table>
      </div>

      <br>

    </div>
  </div>
</body>
</html>