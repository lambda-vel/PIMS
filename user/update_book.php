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
    $book_cover_link = $row['book_cover_link'];
    $book_pages = $row['book_pages'];
    $book_isbn_10 = $row['book_isbn_10'];
    $book_isbn_13 = $row['book_isbn_13'];
    $book_publication_date = $row['book_publication_date'];
  }


if(isset($_POST['update_btn'])){
  $update_book_id = $_POST['update_book_id'];
  $update_book_name = $_POST['update_book_name'];
  $update_book_author = $_POST['update_book_author'];
  $update_book_price = $_POST['update_book_price'];
  $update_book_category = $_POST['update_book_category'];
  $update_book_cover_link = $_POST['update_book_cover_link'];
  $update_book_pages = $_POST['update_book_pages'];
  $update_book_isbn_10 = $_POST['update_book_isbn_10'];
  $update_book_isbn_13 = $_POST['update_book_isbn_13'];
  $update_book_publication_date = $_POST['update_book_publication_date'];

  $query = "UPDATE book SET book_name = '$update_book_name', book_author='$update_book_author', book_price='$update_book_price', book_category='$update_book_category', book_cover_link='$update_book_cover_link', book_pages='$update_book_pages', book_isbn_10='$update_book_isbn_10', book_isbn_13='$update_book_isbn_13', book_publication_date='$update_book_publication_date' WHERE book_id = '$update_book_id'";
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
    <title>Update Book Info | PIMS</title>
    
    <!-- Style Sheet -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
  <br>
  <div class="container">

    <div class="container-fluid">
    <h3>Book Details : <?php echo $row['book_name'];?></h3>
    <br>
    <div class="align-items-center justify-content-center">
    <div class="scrollme">
    <table class="table table-striped table-bordered table-hover table-responsive align-middle width:70% display nowrap">

  <tbody>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <tr>   <!--<th scope="col">#</th>-->
      <th scope="col">Book ID</th>
      <td><?php echo $book_id;?></td>
      <input type="hidden" name="update_book_id" value="<?php echo $book_id;?>">
    </tr>
    <tr>
      <th scope="col">Book Name</th>
      <td><input type="text" name="update_book_name" class="form-control" value="<?php echo $book_name;?>"></td>
    </tr>
    <tr>
      <th scope="col">Author</th>
      <td><input type="text" name="update_book_author" class="form-control" value="<?php echo $book_author;?>"></td>
    </tr>
    <tr>
      <th scope="col">Price</th>
      <td><input type="number" name="update_book_price" class="form-control" value="<?php echo $book_price;?>"></td>
    </tr>
    <tr>
      <th scope="col">Category</th>
      <td><input type="text" name="update_book_category" class="form-control" value="<?php echo $book_category;?>"></td>
    </tr>
    <tr>
      <th scope="col">Cover Link</th>
      <td><input type="url" name="update_book_cover_link" class="form-control" pattern="https://.*" value="<?php echo $book_cover_link;?>"></td>
    </tr>
    <tr>
      <th scope="col">Pages</th>
      <td><input type="text" name="update_book_pages" class="form-control" value="<?php echo $book_pages;?>"></td>
    </tr>
    <tr>
      <th scope="col">ISBN-10</th>
      <td><input type="text" name="update_book_isbn_10" class="form-control" value="<?php echo $book_isbn_10;?>"></td>
    </tr>
    <tr>
      <th scope="col">ISBN-13</th>
      <td><input type="text" name="update_book_isbn_13" class="form-control" value="<?php echo $book_isbn_13;?>"></td>
    </tr>
    <tr>
      <th scope="col">Publication Date</th>
      <td>
        <input type="date" name="update_book_publication_date" class="form-control" value="<?php echo $book_publication_date;?>">
      </td>
    </tr>
    <tr>
      <td colspan="2" class="">
        <button type="submit" class="btn btn-primary" name="cancel_btn">Cancel</button>
        <button type="submit" class="btn btn-warning" name="update_btn">Update</button>
        <a class="btn btn-danger" href="update_book.php?remove=<?php echo $row['book_id']; ?>">Delete</a>
      </td>
    </tr>
  </form>
  </tbody>

    </table>
    </div>

    </div>
  </div>
  </div>
</body>
</html>