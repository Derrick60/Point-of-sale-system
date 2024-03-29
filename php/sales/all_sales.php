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




$stmt = $conn->prepare("SELECT p.saleId, p.procode, p.price, p.quantity, p.amount, p.id, s.date, s.total, s.paid, s.balance, pr.product_name
        FROM sales s
        JOIN sale_products p ON s.saleId = p.saleId
        JOIN product pr ON pr.barcode = p.procode");
$stmt->bind_result($saleId, $procode, $price, $quantity, $amount, $id, $date, $total, $paid, $balance, $product_name);
if ($stmt->execute()) {
    $output = array(); // Initialize the output array

    while ($stmt->fetch()) {
        $output[] = array(
            "saleId" => $saleId,
            "procode" => $procode,
            "price" => $price,
            "quantity" => $quantity,
            "amount" => $amount,
            "id" => $id,
            "date" => $date,
            "total" => $total,
            "paid" => $paid,
            "balance" => $balance,
            "pname" => $product_name
        );
    }

    echo json_encode($output);
}

$stmt->close();
?>
