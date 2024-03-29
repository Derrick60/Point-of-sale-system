<!DOCTYPE html>
<html>
    
    <head>
        <title></title>
        <link rel="stylesheet" href="../components/jquery-confirm-master/css/jquery-confirm.css">
        <!--<link href="../components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="../components/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
       <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">-->
       
        <link rel="stylesheet" href="../bootstrap.min.css">
        <script rel="stylesheet" src="../jquery.min.js"></script>
        <script rel="stylesheet" src="../bootstrap.min.js"></script>
  <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
        
        <link rel="stylesheet" href= "../components/data tables/DataTables/css/jquery.dataTables.min.css">

        
       
    </head>
    <body>
                <?php
// Set error reporting level to exclude notices
error_reporting(E_ALL & ~E_NOTICE);

// prevent the error messages from being displayed on the screen
ini_set('display_errors', 0);
    session_start();
    if (!isset($_SESSION["username"])) {//checks if not login
        header("Location: login.php"); // redirect if not login
        exit();
    }
       
    ?>

   
    <?php include("header.php"); ?>
  

  
        <div class="container-fluid">
            <div class="row">
                

                <div class="col-sm-12" >
                    <!--i added style margin-->
                    <div class="panel-body";>
                        <table id="tbl-salesReport" class="table table-responsive table-bordered" cellspacing="0" Width= "100%">
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                
                                
                                
                            </tr>
                        </table>



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

        <script src= "../components/data tables/DataTables/js/jquery.dataTables.min.js"></script>
        
        <script>
         
            get_all();

            
            function get_all()
            {   
               // console.log("get_all() function called"); // Add this line to check if the function is being called

                //$('#tbl-brand').DataTable().fnDestroy();             
                $.ajax({
                    url: "../php/sales/all_sales.php",
                    type: "GET",
                    dataType: "JSON",
                    

                success:function(data)
                {  //console.log("Data received: ", data);
                   // alert(data);
                    
                    $('#tbl-salesReport').DataTable({
                        "aaData": data,
                        "scrollX": true,
                        "aoColumns": [
                            { "sTitle": "procode", "mData": "procode"},
                            
                            { "sTitle": "saleId", "mData": "saleId"},
                            { "sTitle": "pname", "mData": "pname"},
                            { "sTitle": "quantity", "mData": "quantity"},
                            { "sTitle": "price", "mData": "price"},
                            { "sTitle": "total", "mData": "total"},
                            { "sTitle": "paid", "mData": "paid"},
                            { "sTitle": "balance", "mData": "balance"},
                            
                            
                            
                          
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
