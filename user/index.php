<!DOCTYPE html>
<?php
  include "includes/header.php";
  include "../config/connection.php";

  $total_books_query = "SELECT COUNT(book_id) as total_books FROM book";
  $total_books = mysqli_query($conn, $total_books_query);
  $row = mysqli_fetch_assoc($total_books);
  $books_var = $row['total_books'];

  $total_stocks_query = "SELECT SUM(stock) as total_stocks FROM ( SELECT stock FROM centralstore UNION ALL SELECT stock FROM headoffice UNION ALL SELECT stock FROM outlet ) as combined_tables;";
  $total_stocks = mysqli_query($conn, $total_stocks_query);
  $row = mysqli_fetch_assoc($total_stocks);
  $stocks_var = $row['total_stocks'];

  $total_sales_query = "SELECT COUNT(invoice_id) as total_sales FROM sales";
  $total_sales = mysqli_query($conn, $total_sales_query);
  $row = mysqli_fetch_assoc($total_sales);
  $sales_var = $row['total_sales'];

  $total_customers_query = "SELECT COUNT(username) as total_customers FROM login WHERE role_id = 300";
  $total_customers = mysqli_query($conn, $total_customers_query);
  $row = mysqli_fetch_assoc($total_customers);
  $customers_var = $row['total_customers'];

?>

<html>
  <head>
    <title>User Dashboard | PIMS</title>
  </head>
  <body>
    <div class="container">
      <br>
      <h3>Dashboard</h3>
      <br><br><br>
      
        <div class="container-fluid">
        <div class="row row-cols-1 row-cols-md-2 g-4">
      <div class="col">
      <div class="card text-bg-info mb-3" style="max-width: 18rem;">
        <a href="book.php" class="btn stretched-link">
        <!-- div class="card-header">Header</div -->
        <div class="card-body text-end">
          <h3 class="card-title">Books</h5>
          <p class="card-text"><h1><?php echo $books_var; ?></h1></p>
        </div>
        </a>
      </div>
      </div>
<br>
      <div class="col">
      <div class="card text-bg-primary mb-3" style="max-width: 18rem;">
        <a href="stock.php" class="btn stretched-link">
        <!-- div class="card-header">Header</div -->
        <div class="card-body text-end">
          <h3 class="card-title">Stocks</h5>
          <p class="card-text"><h1><?php echo $stocks_var; ?></h1></p>
        </div>
        </a>
      </div>
      </div>
<br>
      <div class="col">
      <div class="card text-bg-warning mb-3" style="max-width: 18rem;">
        <a href="sales.php" class="btn stretched-link">
        <!-- div class="card-header">Header</div -->
        <div class="card-body text-end">
          <h3 class="card-title">Sales</h5>
          <p class="card-text"><h1><?php echo $sales_var; ?></h1></p>
        </div>
        </a>
      </div>
      </div>
<br>
      <div class="col">
      <div class="card text-bg-danger mb-3" style="max-width: 18rem;">
        <a href="#" class="btn stretched-link">
        <!--div class="card-header">Header</div -->
        <div class="card-body text-end">
          <h3 class="card-title">Customers</h5>
          <p class="card-text"><h1><?php echo $customers_var; ?></h1></p>
        </div>
        </a>
      </div>
      </div>
<br>

        </div>
      </div>

      </div>
    </div>
  </body>
</html>