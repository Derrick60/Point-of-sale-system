<?php
if ($_SERVER['REQUEST_METHOD']== "POST")
{
    
    include("../db.php");

    $stmt = $conn->prepare("UPDATE vendor set vname=?,contactno=?,email=?,address=?,status=? where vendor_id=?");
    $stmt->bind_param("sissii",$vname,$contactno,$email, $address,$status,$vendor_id,);

    $vendor_id = $_POST['vendor_id'];

    $vname = $_POST['vendorName'];
    $contactno = $_POST['contactNo'];
    $email= $_POST['email'];
     $address=$_POST ['address'];
     $status = $_POST['vendorStatus'];
    
    //echo  $_POST['vendor_id'] ;
   // return;
   
   

    if($stmt->execute())
    {
     echo 1;
    
    }
    else{
        echo 0;
    }
$stmt->close();


}
?>
