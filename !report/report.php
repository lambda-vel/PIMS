<!DOCTYPE html>
<?php
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
}
</style>
</head>
<body  style="--bleeding: 0.5cm;--margin: 1cm;"> <!-- page size="A4"></page -->

<div class="page">





</div>

</body>
</html>

<?php
  
  file_put_contents('report.html', ob_get_clean());
?>