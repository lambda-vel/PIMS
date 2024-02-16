<!DOCTYPE html>
<?php
session_start();
//include "includes/header.php";
include "../config/connection.php";

$sql = "SELECT * FROM sales, book WHERE sales.book_id = book.book_id";
$result = mysqli_query($conn, $sql);

?>

<html>
<head>
  <!-- Style Sheet -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/style.css">

  <title>Report | PIMS</title>
</head>
<body>
    <div class="container-fluid">
    <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><h2>X Publishers</h2></a>
    </div>
    </nav>
    <br>
    <div class="container-fluid flex-row">

<div class="d-flex justify-content-start"><a style="text-decoration:none; color:black" href="sales.php"><h3>Sales</h3></a></div>

<!-- div class="d-flex justify-content-end">
  <form class="d-flex" action="<?php //echo $_SERVER['PHP_SELF']; ?>" method="post">
    <button class="btn btn-outline-success" type="submit" name="insert_btn">Insert Stock</button>
  </form>
</div -->

<br>
</div>
  <div class="scrollme">
    <table class="table table-striped table-hover table-responsive align-middle width:100% display nowrap">
  <thead>
    <tr>
      <!--<th scope="col">#</th>-->
      <th scope="col">Invoice ID</th>
      <th scope="col">Book ID</th>
      <th scope="col">Book Name</th>
      <th scope="col">Sales Date</th>
      <th scope="col">Quantity</th>
      <th scope="col">Trxn Amount</th>
    </tr>
  </thead>
  <tbody>

      <?php
          if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
              ?>

               <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
               <tr>
                <input type="hidden" name="invoice_id"  value="<?php echo $row['invoice_id'];?>">
                <td><label><?php echo $row['invoice_id'];?></label></td>
                <td><label><?php echo $row['book_id'];?></label></td>
                <td><label><?php echo $row['book_name'];?></label></td>
                <td><label><?php echo $row['sales_date'];?></label></td>
                <td><label><?php echo $row['quantity'];?></label></td>
                <td><label><?php echo $row['transaction_amount'];?></label></td>
                </tr>
              </form>
                <?php }
        } else {
            echo "0 results";
        }
        ?>
      

    
  </tbody>
</table>
</div>
</div>

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
?>