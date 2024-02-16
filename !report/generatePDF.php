<?php
  session_start();
  require_once('../dompdf/vendor/autoload.php');
  define('DOMPDF_ENABLE_REMOTE', true);
  

  $self = $_SERVER['PHP_SELF'];

  use Dompdf\Dompdf;
  use Dompdf\Options;

  //$dompdf = new Dompdf();
  $dompdf = new Dompdf($options);
  $options = new Options();

  //$report_file_url = $_SESSION['report_file_url'];
  $report_file_url = "http://localhost/PIMS/report/report.html";
  //$report_file_url = "http://localhost/PIMS/public/generatePDF.php";

  
  $options->set('isRemoteEnabled', true);
  //$options->set('dpi', 150);

  //$html = 'Hello World!';
  $html = file_get_contents($report_file_url);
  //$html .= '<style type="text/css">.hideforpdf { display: none; }</style>';

  //$dompdf->loadHtml($html);

  $dompdf->loadHtml($html);

  $dompdf->setPaper('A4', 'portrait');

  $dompdf->render();

  //$dompdf->stream();
  $dompdf->stream("Document.pdf", array('Attachment'=>0));

  //$pdf = $dompdf->output();
  //file_put_contents("Report.pdf", $pdf);
?>