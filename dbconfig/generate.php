<?php
include('config.php');
global $con;
session_start();

require("pdf/fpdf.php");



 if(isset($_POST['downloadcontent']))
{
    $pdf=new FPDF();  
    $pdf->AddPage();
    $pdf->SetTitle("newsinfo.pdf");
    $pdf->SetFont('Arial','B',12);
  $email=$_SESSION['email'];
  $datefield= date("d-m-Y");
  $query = $con->prepare("SELECT * FROM newssaved WHERE email=:email");
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

 if(empty($result['saved'])){
    echo '<p class="error">No data saved..... enter and save your text.... to download</p>';
 }else{
    $pdf->Write(5,$datefield."\n".$result['saved']);
    $pdf->Output();
 }
  
  
      
}

?>