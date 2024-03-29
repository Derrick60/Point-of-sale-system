<?php
if ($_SERVER['REQUEST_METHOD']== "POST")
{
    
    include("../db.php");

    $stmt = $conn->prepare("update brand set brand=?,status=? where id=?");
    $stmt->bind_param("sss",$brandname,$status,$brand_id );

    $brand_id = $_POST['brand_id'];

    $brandname = $_POST['brandname'];
    $status = $_POST['status'];
    

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
