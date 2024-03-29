<?php

include("../db.php");
if($_SERVER['REQUEST_METHOD'] =='POST')
{
    $stmt = $conn-> prepare("insert into brand (brand,status)values(?,?)");
    $stmt -> bind_param("si", $brand, $status);

    $brand = ($_POST['brandname']);
    $status = ($_POST['status']);
    

   
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
