<!DOCTYPE html>
<?php
    include "includes/header.php";
    include "../config/connection.php";

//On page 1
//$_SESSION['varname'] = $var_value;

//On page 2
//$var_value = $_SESSION['varname'];

  $update_book_id = $_SESSION['update_book_id'];

  $sql = "SELECT * FROM book WHERE book_id = '$update_book_id'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $book_id = $row['book_id'];
    $book_name = $row['book_name'];
    $book_author = $row['book_author'];
    $book_price = $row['book_price'];
    $book_category = $row['book_category'];

  }


if(isset($_POST['update_btn'])){
  $update_book_id = $_POST['book_id'];
  $book_name = $_POST['book_name'];
  $book_author = $_POST['book_author'];
  $book_price = $_POST['book_price'];
  $book_category = $_POST['book_category'];

  $query = "UPDATE book SET book_name = '$book_name', book_author='$book_author', book_price='$book_price', book_category='$book_category' WHERE book_id = '$update_book_id'";
  $update_query = mysqli_query($conn, $query);
  if($update_query){
     header('Location: book.php');
  }
};

if(isset($_POST['cancel_btn'])){
  header('Location: book.php');
}

if(isset($_GET['remove'])){
  $remove_id = $_GET['remove'];
  mysqli_query($conn, "DELETE FROM book WHERE book_id = '$remove_id'");
  header('Location: book.php');
};
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
    <h3>Book Details : <?php echo $row['book_name'];?></h3>
    <br>
    <div class="scrollme">
    <table class="table table-striped table-hover table-responsive align-middle width:70% display nowrap">
  <tbody>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <tr>   <!--<th scope="col">#</th>-->
      <th scope="col">Book ID</th>
      <td><label for="book id"><?php echo $book_id;?></label></td>
    </tr>
    <tr>
      <th scope="col">Name</th>
      <td><input type="text" name="book_name"  value="<?php echo $book_name;?>"></td>
    </tr>
    <tr>
      <th scope="col">Author</th>
      <td><input type="text" name="book_author"  value="<?php echo $book_author;?>"></td>
    </tr>
    <tr>
      <th scope="col">Price</th>
      <td><input type="number" name="book_price"  value="<?php echo $book_price;?>"></td>
    </tr>
    <tr>
      <th scope="col">Category</th>
      <td><input type="text" name="book_category"  value="<?php echo $book_category;?>"></td>
    </tr>
    <tr>
      <td colspan="2"><button type="submit" class="btn btn-primary" name="cancel_btn">Cancel</button>
          <button type="submit" class="btn btn-warning" name="update_btn">Update</button>
          <a class="btn btn-danger" href="update_book_info.php?remove=<?php echo $row['book_id']; ?>">Delete</a></td>
    </tr>
  </form>
  </tbody>
</table>
</body>
</html>