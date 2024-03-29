<?php

$servername = "localhost";
$username ="root";
$password = "";
$dbname = "osman_pos";

$conn = new mysqli($servername,$username,$password,$dbname );
if($conn -> connect_error)
{
    die("connection Failed :" . $conn ->connect_error);
}
$stmt = $conn->prepare("SELECT i.purchase_id, i.product_id, i.buy_price, i.qty, i.total, p.date,
p.total, p.paid, p.balance, pr.product_name
FROM purchase p
JOIN  purchase_item i ON p.id = i.purchase_id
JOIN  product pr  ON pr.barcode = i.product_id"); 

$stmt->bind_result($purchase_id, $product_id, $price, $qty, $total, $date,$paid, $balance, $product_name);
echo $stmt->error;
if ($stmt->execute()) {
    $output = array(); // Initialize the output array

    while ($stmt->fetch()) {
        $output[] = array(
            "purchase_id" => $purchase_id,
            "product_id" => $product_id,
            "price" => $price,
            "qty" => $qty,
            "total" => $total,
            "date" => $date,
            "paid" => $paid,
            "balance" => $balance,
            "pname" => $product_name
        );
       
    }
   
    echo json_encode($output);
    
}

$stmt->close();
?>
