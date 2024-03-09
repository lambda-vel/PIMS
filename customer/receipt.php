<!DOCTYPE html>
<?php
  session_start();
  // include 'includes/header.php';
  include '../config/connection.php';

  $message = '';


?>



<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/style.css">

  <title>Receipt | X Publications</title>
</head>
<body>
  <!-- <div class="container"> -->
    <br>
    <div class="container-fluid">

    <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><h2>X Publishers</h2></a>
    </div>
    </nav>

      <br>
      <div class="container-fluid flex-row">
        <div class="d-flex justify-content-start"><h3>Order Receipt</h3></div>

        <br>
      </div>

      <br>
      <div class="scrollme">
        <table class="table table-striped table-hover table-responsive align-middle width:100% display nowrap">

        <tr>
					<th width="30%">Book Name</th>
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
  <!-- </div> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</body>
</html>

<?php
  if ($_SESSION['action'] == "print"){
    echo '<script> window.print(); </script>';
  } /* elseif($_SESSION['action'] == "save"){
    date_default_timezone_set('Asia/Dhaka');
    $date = date('m/d/Y_h:i:s a', time());
    //$file_name = "report_book_" . $date . ".html";
    //file_put_contents($file_name, ob_get_clean());
    file_put_contents('report.html', ob_get_clean());
  } */
  setcookie("shopping_cart", "", time() - 3600);
?>