<?php
include("../db.php");

if($_SERVER['REQUEST_METHOD'] =='POST')
{   
    $stmt = $conn-> prepare("insert into product (product_name,
    description,barcode,category_id,
    brand_id,warranty,price_retail,
     price_cost,reorderlevel,qty,date,status)values(?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt -> bind_param("ssiiisiiiisi",$product_name,
    $description,$barcode,$category_id,
    $brand_id,$warranty,$price_retail,
    $price_cost,$reorderlevel,$qty,$date,$status);
 
     $product_name = ($_POST['productName']);
     $description= ($_POST['productDescription']);
     $barcode= ($_POST['barcode']);
     $category_id= ($_POST['category']);
     $brand_id= ($_POST['brand']);
     $warranty= ($_POST['warranty']);
     $price_retail= ($_POST['retailPrice']);
     $price_cost= ($_POST['costPrice']);
     $reorderlevel= ($_POST['reorderLevel']);
     $qty= ($_POST['qty']);
     $date = ($_POST['date']);
     $status = ($_POST['productStatus']);
    
   
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
