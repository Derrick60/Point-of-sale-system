<?php
include("../php/db.php");
//$sql = " ";

//if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  /*  $stmt11 = $conn->prepare("SELECT ifnull(max(id),0)-1 AS lastid FROM purchase LIMIT 1;");
    $stmt11->bind_result($lastid);
    if ($stmt11->execute()) {
        while ($stmt11->fetch()) {
            $last_id = $lastid;
        }
    }*///it  fetches the lastId from database
        $sql = "SELECT i.purchase_id, i.product_id, i.buy_price, i.qty, i.total, p.date,
        p.total, p.paid, p.balance, pr.product_name
        FROM purchase p, purchase_item i, product pr
        WHERE p.id = i.purchase_id AND pr.barcode = i.product_id AND purchase_id =".$_GET["last_id"].";"; 
        //or die("could not select :" . $conn->connect_error);
        
    $orderResult = $conn->query($sql);
    $orderdata = $orderResult->fetch_array();

    $purchase_id = $orderdata[0];
    $product_id = $orderdata[1];
    $buy_price = $orderdata[2];
    $qty = $orderdata[3];
    $total = $orderdata[4];
    $date = $orderdata[5];
    $subtotal = $orderdata[6];
    $paid = $orderdata[7];
    $balance = $orderdata[8];
    $productName = $orderdata[9];


    ?>

    <html>

    <head>
        <title>Purchase Invoice</title>
        <link rel="stylesheet" href="../bootstrap.min.css">
        <link rel="stylesheet" href="../components/data tables/DataTables/css/jquery.dataTables.min.css">
        <style>
            @media print {
                .button {
                    display: none;
                }
            }

            @media print {
                @page {
                    margin-top: 0;
                    margin-bottom: 0;
                }

                body {
                    padding-top: 72px;
                    padding-bottom: 72px;
                }
            }
        </style>
    </head>

    <body style="background:#f9f9f9">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="print"
                        style="border:1px solid #a1a1a1; width:88mm; background:white; padding: 10px; margin:0 auto; text-align: center;">
                        <div align="center">
                            <h3>Purchase Invoice</h3>
                        </div>
                        <div align="left">
                            Date: <b>
                                <?php echo $date; ?>
                            </b>
                        </div>
                        <div align="right">
                            Invoice No: <b>3333</b>
                        </div>
                        </br>

                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <td class="text-center">No</td>
                                    <td class="text-center">Item</td>
                                    <td class="text-center">Qty</td>
                                    <td class="text-center">Price</td>
                                    <td class="text-center">Total</td>
                                </tr>
                            </thead>
                            <?php
                            $x = 1;
                            $orderResult = $conn->query($sql);
                            while ($row = $orderResult->fetch_array()) {
                                ?>
                                <tr>
                                    <td class="text-center">
                                        <?php echo $x; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $row[9]; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $row[3]; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $row[2]; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $row[4]; ?>
                                    </td>
                                </tr>
                                <?php
                                $x++;
                            }
                            ?>
                        </table>

                        <div align="right">
                            Sub Total: <b>
                                <?php echo $subtotal; ?>
                            </b>
                        </div>
                        <div align="right">
                            Paid: <b>
                                <?php echo $paid; ?>
                            </b>
                        </div>
                        <div align="right">
                            Balance: <b>
                                <?php echo $balance; ?>
                            </b>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="../components/jquery/dist/jquery.js"></script>
        <script src="../components/jquery/dist/jquery-min.js"></script>
        <script src="../components/jquery.validate.min.js"></script>
        <script src="../components/bootstrap/dist/js/bootstrap.js"></script>
        <script src="../components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../components/jquery-confirm-master/js/jquery-confirm.js"></script>
        <script src="../components/data tables/DataTables/js/jquery.dataTables.min.js"></script>
        <script>
            myFunction();

            function myFunction() {
                window.print();
            }

            window.onafterprint = function (e) {
                closePrintView();
            };

            function closePrintView() {
                window.location.href = 'purchase.php';
            }
        </script>
    </body>

    </html>
<?php // } ?>