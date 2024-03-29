<!DOCTYPE html>
<?php
include "includes/header.php";
include "../config/connection.php";

$sql = "SELECT * FROM outlet";
$result = mysqli_query($conn, $sql);
$data_sql = "SELECT * FROM book RIGHT JOIN outlet ON book.book_id=outlet.book_id";
$data = mysqli_query($conn, $data_sql);

if (isset($_POST['insert_btn'])) {
  $insert_book_id = $_POST['insert_book_id'];
  $insert_stock = $_POST['insert_stock'];

  $check_query = "SELECT book_id FROM outlet WHERE book_id = '$insert_book_id'";
  $check = mysqli_query($conn, $check_query);


  if (mysqli_num_rows($check) > 0) {
    $update_book_id = $insert_book_id;
    $update_stock = $insert_stock;

    $updating_query = "UPDATE outlet SET stock = (SELECT stock FROM outlet WHERE book_id = '$update_book_id') + '$update_stock' WHERE book_id = '$update_book_id'";
    $update = mysqli_query($conn, $updating_query);
    if ($update) {
      header('Location: redirects/redirecting_outlet.php');
    }
  } else {
    $inserting_query = "INSERT INTO outlet (book_id, stock) VALUES ('$insert_book_id', '$insert_stock')";
    $insert = mysqli_query($conn, $inserting_query);
    if ($insert) {
      header('Location: redirects/redirecting_outlet.php');
    }
  }
}

if (isset($_POST['update_btn'])) {
  $update_book_id = $_POST['book_id'];
  $stock = $_POST['stock'];

  $query = "UPDATE outlet SET stock='$stock' WHERE book_id = '$update_book_id'";
  $update_query = mysqli_query($conn, $query);
  if ($update_query) {
    header('Location: redirects/redirecting_outlet.php');
  }
};

if (isset($_GET['remove'])) {
  $remove_id = $_GET['remove'];
  mysqli_query($conn, "DELETE FROM outlet WHERE book_id = '$remove_id'");
  header('Location: redirects/redirecting_outlet.php');
};

if (isset($_POST['print_btn'])) {
  $_SESSION['action'] = "print";
  header('Location: report_outlet.php');
}

?>

<html>

<head>
  <!-- Style Sheet -->
  <link rel="stylesheet" href="../assets/css/style.css">

  <title>Outlet | PIMS</title>
</head>

<body>
  <div class="container-fluid">
    <br>
    <div class="container-fluid flex-row">

      <div class="d-flex justify-content-end">
        <form class="d-flex" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <!-- button class="btn btn-secondary" type="submit" name="save_btn">Save</button>
    &nbsp; &nbsp; -->
          <button class="btn btn-secondary" type="submit" name="print_btn">Print Report</button>
        </form>
      </div>

      <div class="d-flex justify-content-start">
        <h3>Stock Status @ Outlet</h3>
      </div>

      <!-- div class="d-flex justify-content-end">
  <form class="d-flex" action="<?php //echo $_SERVER['PHP_SELF']; 
                                ?>" method="post">
    <button class="btn btn-outline-success" type="submit" name="insert_btn">Insert Stock</button>
  </form>
</div -->

      <br>
    </div>
    <div class="scrollme">
      <table class="table table-striped table-hover table-responsive align-middle width:100% display nowrap">
        <thead>
          <tr>
            <th scope="col">Book ID</th>
            <th scope="col">Stock</th>
          </tr>
        </thead>
        <tbody>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <tr>
              <td><input type="text" name="insert_book_id" value=""></td>

              <td><input type="text" name="insert_stock" value=""></td>
              <td><button type="submit" class="btn btn-success" name="insert_btn">Insert</button></td>
            </tr>
          </form>
        </tbody>
      </table>

      <table class="table table-striped table-hover table-responsive align-middle width:100% display nowrap">
        <thead>
          <tr>
            <!--<th scope="col">#</th>-->
            <th scope="col">Book ID</th>
            <th scope="col">Name</th>
            <th scope="col">Author</th>
            <th scope="col">Price</th>
            <th scope="col">Category</th>
            <th scope="col">Stock</th>
            <th scope="col" colspan="2">Actions</th>
          </tr>
        </thead>
        <tbody>

          <?php
          if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($data)) {
          ?>
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="hidden" name="book_id" value="<?php echo $row['book_id']; ?>">
                <td><label><?php echo $row['book_id']; ?></label></td>
                <td><?php echo $row['book_name']; ?></td>
                <td><?php echo $row['book_author']; ?></td>
                <td><?php echo $row['book_price']; ?></td>
                <td><?php echo $row['book_category']; ?></td>
                <td><input type="text" name="stock" value="<?php echo $row['stock']; ?>"></td>

                <td><button type="submit" class="btn btn-warning" name="update_btn">Update</button></td>
                <td><a class="btn btn-danger" href="outlet.php?remove=<?php echo $row['book_id']; ?>">Delete</a></td>
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
</body>

</html>