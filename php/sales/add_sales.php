<?php
include("../db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   

    // Retrieve the form data
    

    // Prepare the SQL INSERT statement
    $stmt = $conn->prepare("INSERT INTO sales (paid, balance,pstatus,total,date) VALUES(?,?,?,?,?)");
    $stmt->bind_param("iiiis",$paid,$balance,$Pstatus,$total,$date);
    
    $paid = $_POST['paid'];
    $balance = $_POST['balance'];
    $Pstatus = $_POST['pstatus'];
    $total = $_POST['total'];
    $date = date('y-m-d');


   
             $stmt11 = $conn->prepare("SELECT  ifnull(max(saleId),0)+1 as lastid from sales;");
             $stmt11->bind_result($lastid);
         if ($stmt11->execute()) {
             
             while ($stmt11->fetch()) {
                 $last_id=$lastid;
             
              
             }
         }
     
         if ($stmt->execute()) {
             //$last_Id = $conn->lastinsertId(); // Fetch the last inserted ID $stmt was $conn
            
     
             $relation_list = $_POST['data'];
             for ($x = 0; $x < count($relation_list); $x++) {
                 $stmt1 = $conn->prepare("INSERT INTO sale_products (saleId,procode,pname,price,quantity,amount) VALUES (?, ?, ?, ?, ?, ?)");
                 $stmt1->bind_param("iisiii", $last_id, $procode, $pname, $price, $quantity,$amount);
     
                 $procode = $relation_list[$x]['procode'];
                 $pname = $relation_list[$x]['pname'];
                 $price = $relation_list[$x]['price'];
                 $quantity = $relation_list[$x]['qty'];
                 $amount = $relation_list[$x]['total_cost'];
     
                 if ($stmt1->execute()) {
                     // Query executed successfully
                 } else {
                     // Handle the error when the second query fails
                     echo "Error: " . $stmt1->error;
                 }
     
                 $stmt1->close();
             }
     
             echo json_encode(array("last_id" => $last_id));
         } else {
             // Handle the error when the first query fails
             echo "Error: " . $stmt->error;
         }
     
         $stmt->close();
     }

  


