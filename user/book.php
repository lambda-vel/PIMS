<!DOCTYPE html>
<?php
    include "includes/header.php";
    include "../config/connection.php";

$sql = "SELECT * FROM book";
$result = mysqli_query($conn, $sql);


if(isset($_POST['insert_btn'])){
  header('Location: insert_book.php');
  /*
  $insert_book_id = $_POST['insert_book_id'];
  $insert_book_name = $_POST['insert_book_name'];
  $insert_book_author = $_POST['insert_book_author'];
  $insert_book_price = $_POST['insert_book_price'];
  $insert_book_category = $_POST['insert_book_category'];

  $inserting_query = "INSERT INTO book (book_name, book_author, book_price, book_category) VALUES ('$insert_book_name', '$insert_book_author', '$insert_book_price', '$insert_book_category')";
  $insert_query = mysqli_query($conn, $inserting_query);
  if($insert_query){
     header('Location: book.php');
  }
  */
}

if(isset($_POST['update_btn'])){
  $update_book_id = $_POST['book_id'];

  $_SESSION['update_book_id'] = $update_book_id;
  header('Location: update_book.php');

  /*
  $book_name = $_POST['book_name'];
  $book_author = $_POST['book_author'];
  $book_price = $_POST['book_price'];
  $book_category = $_POST['book_category'];

  $query = "UPDATE book SET book_name = '$book_name', book_author='$book_author', book_price='$book_price', book_category='$book_category' WHERE book_id = '$update_book_id'";
  $update_query = mysqli_query($conn, $query);
  if($update_query){
     header('Location: book.php');
  }
  */
};

if(isset($_GET['remove'])){
  $remove_id = $_GET['remove'];
  mysqli_query($conn, "DELETE FROM book WHERE book_id = '$remove_id'");
  header('Location: book.php');
};

/*
if(isset($_POST['save_btn'])){
  $_SESSION['action'] = "save";
  header('Location: report_book.php');
}
*/

if(isset($_POST['print_btn'])){
  $_SESSION['action'] = "print";
  header('Location: report_book.php');
}

?>

<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book | PIMS</title>
    
    <!-- Style Sheet -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
  <br>
    <div class="container-fluid">

      <div class="container-fluid flex-row">

        <div class="d-flex justify-content-end">
          <form class="d-flex" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <!-- button class="btn btn-secondary" type="submit" name="save_btn">Save</button>
            &nbsp; &nbsp; -->
            <button class="btn btn-secondary" type="submit" name="print_btn">Print Report</button>
          </form>
        </div>

        <div class="d-flex justify-content-start"><h3>Book List</h3></div>

        <div class="d-flex justify-content-end">
          <form class="d-flex" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <button class="btn btn-outline-success" type="submit" name="insert_btn">Add Book</button>
          </form>
        </div>

        <br>
      </div>

    <br>
    <div class="scrollme">
    <table class="table table-striped table-hover table-responsive align-middle width:100% display nowrap">
  <thead>
    <tr>
      <!--<th scope="col">#</th>-->
      <th scope="col">Book ID</th>
      <th scope="col">Name</th>
      <th scope="col">Author</th>
      <th scope="col">Price</th>
      <th scope="col">Category</th>
      <th scope="col" colspan="2">Actions</th>
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
                <input type="hidden" name="book_id"  value="<?php echo $row['book_id'];?>">
                <td><?php echo $row['book_id'];?></td>
                <td><?php echo $row['book_name'];?></td>
                <td><?php echo $row['book_author'];?></td>
                <td><?php echo $row['book_price'];?></td>
                <td><?php echo $row['book_category'];?></td>
                <td><button type="submit" class="btn btn-warning" name="update_btn">Update</button></td>
                <!-- td><a class="btn btn-danger" href="book.php?remove=<?php echo $row['book_id']; ?>">Delete</a></td -->
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