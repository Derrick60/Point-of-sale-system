<?php

include("../db.php");
if($_SERVER['REQUEST_METHOD'] =='POST')
{
    $stmt = $conn-> prepare("insert into vendor (vname,contactno,email,address,status)values(?,?,?,?,?)");
    $stmt -> bind_param("sissi", $vname,$contactno,$email,$address,$status);


    $vname=($_POST['vendorName']);
    $contactno=($_POST['contactNo']);
    $email=($_POST['email']);
    $address=($_POST['address']);
    $status=($_POST['vendorStatus']);
    
    if($stmt->execute())
    {
        echo 1;
    }else

    {
        echo "Error: " . $stmt->error;

    }
$stmt->close();


}


?>
