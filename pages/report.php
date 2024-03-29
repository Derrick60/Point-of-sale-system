<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
     <link rel="stylesheet" href="../bootstrap.min.css">
    <link rel="stylesheet" href="../components/data tables/DataTables/css/jquery.dataTables.min.css">
</head>
<body>
    <?php
// Set error reporting level to exclude notices
error_reporting(E_ALL & ~E_NOTICE);

// control error messages from being displayed on the screen
ini_set('display_errors', 0);
    session_start();
    if (!isset($_SESSION["username"])) {//checks if not login
        header("Location: login.php"); // redirect
        exit();
    }
       
include("header.php"); 
    ?>

    <div class="col-sm-12">
        <div class="panel-body">
            <table id="tbl-report" class="table table-responsive table-bordered" cellspacing="0" Width="100%">
              <caption>Payment Report</caption>  
            <!-- Table header rows and columns -->
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
            </table>
        </div>
        <script src="../bootstrap.min.js"></script>
        <script rel="stylesheet" src="../jquery.min.js"></script>
        <script src= "../components/data tables/DataTables/js/jquery.dataTables.min.js"></script>
        <script>
            get_all();
        function get_all()
            {            
                $.ajax({
                    url: "../php/pay/report.php",
                    type: "GET",
                    dataType: "JSON",
                    

                success:function(data)
                {  //console.log("Data received: ", data);
                    $('#tbl-report').DataTable({
                        "aaData": data,
                        "scrollX": true,
                        "aoColumns": [
                            { "sTitle": "Id", "mData": "debtor_id"},
                            { "sTitle": "Name", "mData": "debtorName"},
                            { "sTitle": "Paid", "mData": "paid"},
                            { "sTitle": "Balance", "mData": "balance"},
                             { "sTitle": "Date", "mData": "date"},
                            
                            
                            
                          
                        ]
                        
                    });
                

                },
                    error: function (xhr) {
                        console.log('Request Status: '+ xhr.status);
                        console.log('Status Text: '+ xhr.statusText);
                        console.log(xhr.responseText);
                        var text = $($.parseHTML(xhr.responseText)).filter('.trace-message').text();
                        // console.log(text)
                        

                    }
                        
                });
            }
    </script>
</body>
</html>