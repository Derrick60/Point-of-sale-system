<?php

if($_SERVER['REQUEST_METHOD']=='POST');
{
    include("../db.php");
    $stmt = $conn->prepare("delete from vendor where vendor_id=?");
    $stmt->bind_param("s",$vendor_id );

    $vendor_id = $_POST['vendor_id'];

    
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