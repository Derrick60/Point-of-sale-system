<?php

if($_SERVER['REQUEST_METHOD'] =='POST')
{
    include("../db.php");

    $stmt = $conn->prepare("select vendor_id,vname,contactno,email,address,status from vendor where vendor_id=?");

    $vendor_id = $_POST['vendor_id'];
    $stmt->bind_param("s",$vendor_id );

    $stmt->bind_result($vendor_id, $vname,$contactno,$email,$address, $status);

    if($stmt->execute())
    {
      while($stmt->fetch())
      {
        $output = array("vendor_id" => $vendor_id,
        "vname" => $vname,
        "contactno" => $contactno,
        "email" => $email,
        "address" => $address,
        "status" => $status );

      }  
      echo json_encode($output);
    }
$stmt->close();




}
?>