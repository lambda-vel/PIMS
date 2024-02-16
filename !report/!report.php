<!DOCTYPE html>
<?php
session_start();

include "../config/connection.php";

if(!($_SESSION['user'])){
  header('Location: includes/login.php');
}
if(isset($_SESSION['user'])){
  $user = $_SESSION['username'];
  $role = $_SESSION['role_id'];
  $users_name = $_SESSION['users_name'];
} else {
  header('includes/login.php');
}

//include "includes/header.php";

$sql = "SELECT * FROM book";
$result = mysqli_query($conn, $sql);

ob_start();

?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Report</title>
<style>
:root {
  --bleeding: 0.5cm;
  --margin: 1cm;
}

@page {
  size: A4;
  margin: 0;
}
* {
  box-sizing: border-box;
}

body {
  margin: 0 auto;
  padding: 0;
  background: rgb(204, 204, 204);
  display: flex;
  flex-direction: column;
}

.page {
  display: inline-block;
  position: relative;
  height: 297mm;
  width: 210mm;
  font-size: 12pt;
  margin: 2em auto;
  padding: calc(var(--bleeding) + var(--margin));
  box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
  background: white;
}

@media screen {
  .page::after {
    position: absolute;
    content: '';
    top: 0;
    left: 0;
    width: calc(100% - var(--bleeding) * 2);
    height: calc(100% - var(--bleeding) * 2);
    margin: var(--bleeding);
    /*outline: thin dashed black;*/
    pointer-events: none;
    z-index: 9999;
  }
}

@media print {
  .page {
    margin: 0;
    overflow: hidden;
  }

table, th, td {
  border: 1px solid black;
}
}
</style>
</head>
<body  style="--bleeding: 0.5cm;--margin: 1cm;"> <!-- page size="A4"></page -->

<div class="page">

<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><h2>X Publishers</h2></a>
    </div>
  </nav>
  <br>
    <div class="container-fluid">

      <div class="container-fluid flex-row">

        <div class="d-flex justify-content-start"><h3>Book List</h3></div>

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

</div>

</body>
</html>

<?php
  
  //file_put_contents('report.html', ob_get_clean());
?>