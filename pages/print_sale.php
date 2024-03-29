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
        $sql = "SELECT p.saleId, p.procode, p.price, p.quantity, p.amount,p.id, s.date,
        s.total, s.paid, s.balance, pr.product_name
        FROM sales s, sale_products p, product pr
        WHERE s.saleId = p.saleId AND pr.barcode = p.procode AND s.saleId =".$_GET["last_id"].";"; 
        //or die("could not select :" . $conn->connect_error);
        
    $orderResult = $conn->query($sql);
    $orderdata = $orderResult->fetch_array();

    $saleId = $orderdata[0];
    $procode = $orderdata[1];
    $price = $orderdata[2];
    $quantity = $orderdata[3];
    $total = $orderdata[4];
    $id = $orderdata[5];
    $date = $orderdata[6];
    $amount = $orderdata[7];
    $paid = $orderdata[8];
    $balance = $orderdata[9];
    $productName = $orderdata[10];
    


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
                            <h3>Sale RECEIPT</h3>
                        </div>
                        <div align="left">
                            Date: <b>
                                <?php echo $date; ?>
                            </b>
                        </div>
                        <div align="right">
                            Invoice No: <b><?php echo $id; ?></b>
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
                                        <?php echo $row[10]; ?>
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
                                <?php echo $amount; ?>
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
                window.location.href = 'sales.php';
            }
        </script>
    </body>

    </html>
<?php // } ?>