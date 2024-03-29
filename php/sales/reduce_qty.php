<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //this code increment the quantity of the product from database when product is purchased 
    include("../db.php");

    $stmt = $conn->prepare("UPDATE product SET qty = qty - ? WHERE barcode = ?");
    $stmt->bind_param("ii", $qty, $procode);

    $procode = $_POST['procode'];
    $qty = $_POST['qty'];

    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo 1;
    } else {
        echo 0;
    }

    $stmt->close();
}

