<?php

if($_SERVER['REQUEST_METHOD']=='POST');
{
    include("../db.php");
    $stmt = $conn->prepare("delete from product where product_id=?");
    $stmt->bind_param("s",$product_id );

    $product_id = $_POST['productName'];

    
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