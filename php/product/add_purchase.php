<?php
include("../db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("INSERT INTO purchase (vendor_id, date, paid, total, balance, payment_mode) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiiii", $vendor_id, $date, $paid, $total, $balance, $payment_mode);

    $vendor_id = $_POST['vendor'];
    $date = date('y-m-d');
    $paid = $_POST['paid'];
    $total = $_POST['total'];
    $balance = $_POST['balance'];
    $payment_mode = $_POST['pstatus'];
    $stmt11 = $conn->prepare("SELECT  ifnull(max(purchase_id),0)+1 as lastid from purchase_item;");
        $stmt11->bind_result($lastid);
    if ($stmt11->execute()) {
        
        while ($stmt11->fetch()) {
            $last_id=$lastid;
        
         
        }
    }

    if ($stmt->execute()) {
        //$last_id = $conn->lastinsertid(); // Fetch the last inserted ID $stmt was $conn
       

        $relation_list = $_POST['data'];
        for ($x = 0; $x < count($relation_list); $x++) {
            $stmt1 = $conn->prepare("INSERT INTO purchase_item (purchase_id, product_id, buy_price, qty, total) VALUES (?, ?, ?, ?, ?)");
            $stmt1->bind_param("iiiii", $last_id, $product_id, $buy_price, $qty, $total);

            $product_id = $relation_list[$x]['procode'];
            $buy_price = $relation_list[$x]['price'];
            $qty = $relation_list[$x]['qty'];
            $total = $relation_list[$x]['total_cost'];

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
?>
