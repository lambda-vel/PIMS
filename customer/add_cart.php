<!DOCTYPE html>
<?php
  include "includes/header.php";
  include '../config/connection.php';

  //session_start();
  $add_book_id = $_SESSION['add_book_id'];

  $add_query = "SELECT * FROM book WHERE book_id = '$add_book_id'";
  $add = mysqli_query($conn, $add_query);

  $add_book_count_query = "SELECT stock FROM outlet WHERE book_id = '$add_book_id'";
  $add_book_count = mysqli_query($conn, $add_book_count_query);


  if (mysqli_num_rows($add_book_count) > 0){
    $data = mysqli_fetch_assoc($add_book_count);
    $book_count = $data['stock'];
  } else {
    $book_count = 0;
  }

  if(isset($_POST['search_book_btn'])){
    $search_book_name = $_POST['search_book_name'];
  
    session_start();
    $_SESSION['search_book_name'] = $search_book_name;
    header('Location: searching_book.php');
  }

  $message = '';

if(isset($_POST["add_cart"])){
  if($book_count < $_POST['book_quantity']){
    $message = "Insufficient Stock!";
    echo "<script type='text/javascript'>alert('$message');</script>";
  }
  else{
    if(isset($_COOKIE["shopping_cart"])){
      $cookie_data = stripslashes($_COOKIE['shopping_cart']);
  
      $cart_data = json_decode($cookie_data, true);
    } else {
      $cart_data = array();
    }
  
    $book_id_list = array_column($cart_data, 'book_id');
  
    if(in_array($_POST["book_id"], $book_id_list)){
      foreach($cart_data as $keys => $values){
        if($cart_data[$keys]["book_id"] == $_POST["book_id"]){
          $cart_data[$keys]["book_quantity"] = $cart_data[$keys]["book_quantity"] + $_POST["book_quantity"];
        }
      }
    } else {
      $book_array = array(
        'book_id' => $_POST["book_id"], 
        'book_name' => $_POST["book_name"], 
        'book_author' => $_POST["book_author"],
        'book_price' => $_POST["book_price"], 
        'book_quantity' => $_POST["book_quantity"]
      );
      $cart_data[] = $book_array;
    }
  
    $cookie_data = json_encode($cart_data);
    setcookie('shopping_cart', $cookie_data, time() + (86400 * 30));
    header("location:index.php?success=1");
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


  if (mysqli_num_rows($add) > 0){
    while($row = mysqli_fetch_assoc($add)){

?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $row['book_name'];?></title>
</head>
<body>
  <div class="container">
    <div class="container-fluid">
      <br>
      <div class="container-fluid flex-row">
        <div class="d-flex justify-content-end">
          <form class="d-flex" role="search" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input class="form-control me-2" type="search" placeholder="Search Books" aria-label="Search" name="search_book_name">
            <button class="btn btn-outline-success" type="submit" name="search_book_btn">Search</button>
          </form>
        </div>
      </div>


      <br><br>

      <div class="row">
        <div class="col-md-auto">
          <br>
          <img src="<?php echo $row['book_cover_link']; ?>" class="img-fluid rounded-start" style= "max-width: 350px;" alt="<?php echo $row['book_name'];?>">
        </div>

        <div class="col">
          <br>
          <h1><?php echo $row['book_name'];?></h1>
          <h3>Author: <?php echo $row['book_author'];?></h3>
          <h6>Price: <?php echo $row['book_price'];?></h6>
          <p>
            Book Pages: <?php echo $row['book_pages'];?>
            <br>
            ISBN: <?php echo $row['book_isbn_13'];?>
            <br>
            <small>Category: <?php echo $row['book_category'];?></small>
          </p>
          <br><br><br>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="hidden" name="book_id"  value="<?php echo $row['book_id'];?>">
            <input type="hidden" name="book_name"  value="<?php echo $row['book_name'];?>">
            <input type="hidden" name="book_author"  value="<?php echo $row['book_author'];?>">
            <input type="hidden" name="book_price"  value="<?php echo $row['book_price'];?>">
            <p>
              Quantity: 
              <input type="number" name="book_quantity"  value="1" placeholder="#">
            </p>
            <button type="submit" class="btn btn-warning" name="add_cart">Add to Cart</button>
          </form>
        </div>

      </div>





    </div>
  </div>
</body>
</html>
<?php
    }
  }
?>