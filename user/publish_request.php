<!DOCTYPE html>
<?php
  include 'includes/header.php';
  include '../config/connection.php';

  $books_query = "SELECT * FROM publish";
  $books = mysqli_query($conn, $books_query);

  if(isset($_POST['approve_btn'])){
    $id = $_POST['id'];

    $approve_query = "UPDATE publish SET status = 1 WHERE id = '$id'";
    $approve = mysqli_query($conn, $approve_query);

    if($approve){
      header('Location: publish_request.php');
    }
  }

  if(isset($_POST['review_btn'])){
    $review_id = $_POST['id'];

    $_SESSION['review_id'] = $review_id;

    header('Location: review_request.php');
  }

?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Publish Requests | PIMS</title>
</head>
<body>
  <div class="container">
    <div class="container-fluid">
      <br>
      <div class="container-fluid flex-row">

        <div class="d-flex justify-content-start"><h3>Publish Requests</h3></div>

        <br>
      </div>

      <br>
    
      <div class="scrollme">
        <table class="table table-striped table-hover table-responsive align-middle width:100% display nowrap">
          <thead>
            <tr>
              <!--<th scope="col">#</th>-->
              <th scope="col">Book Name</th>
              <th scope="col">Category</th>
              <th scope="col">Book Intro</th>
              <th scope="col">Book Status</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
       
          <?php
            if (mysqli_num_rows($books) > 0) {
              // output data of each row
              while($row = mysqli_fetch_assoc($books)) {
          ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
              <tr>
                <input type="hidden" name="id"  value="<?php echo $row['id'];?>">
                <td><?php echo $row['book_name'];?></td>
                <td><?php echo $row['book_category'];?></td>
                <td><?php echo $row['book_intro'];?></td>
                <td>
                  <?php 
                    if($row['status'] == "0"){
                      echo "Pending";
                    } elseif ($row['status'] == "-1"){
                      echo "Denied";
                    } elseif ($row['status'] == "1"){
                      echo "Approved";
                    } elseif ($row['status'] == "2"){
                      echo "Published";
                    } else {
                      echo "Unknown";
                    }
                  ?>
                </td>
                <!-- td><button type="submit" class="btn btn-success" name="approve_btn">Approve</button></td -->
                <td><button type="submit" class="btn btn-warning" name="review_btn">Review</button></td>
                <!-- td><a class="btn btn-danger" href="book.php?remove=<?php // echo $row['book_id']; ?>">Delete</a></td -->
              </tr>
            </form>
          <?php }
            } else {
              echo "0 Books";
            }
          ?>


          </tbody>
        </table>
    </div>
  </div>
</body>
</html>