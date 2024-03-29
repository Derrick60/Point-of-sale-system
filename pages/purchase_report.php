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

   
    <?php include("../header.php"); ?>
  

  
        <div class="container-fluid">
            <div class="row">
                

                <div class="col-sm-12" >
                    <!--i added style margin-->
                    <div class="panel-body";>
                        <table id="tbl-purchaseReport" class="table table-responsive table-bordered" cellspacing="0" Width= "100%">
                            <tr>
                                <th></th>
                                <th></th>
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
            var Isnew = true;
            get_all();

            var brand_id = null;
        


            function AddBrand() {
                if($("#frmBrand").valid()) {
                    var _url = '';
                    var _data = '';
                    var _method;
                    // Valid form
                } else {
                    // Invalid form 
                }

                if (Isnew == true) {
                    _url = '../php/sales/add_brand.php';
                    _data = $("#frmBrand").serialize();
                    _method = 'POST';
                } else {
                    _url = '../php/brand/update_brand.php';
                    _data =  _data = $("#frmBrand").serialize() + "&brand_id=" + brand_id;
                    _method = 'POST';
                    

                }
                
                $.ajax({
                    type: _method,
                    data: _data,
                    url: _url,
                    async:false,
                    dataType: 'JSON',
                    success: function(data) {
                        //get_all();
                        //$("#tbl-brand").reload('');
                        
                        var msg;
                        if (Isnew) {
                            msg = "brand created";
                            //location.reload();
                        } else {
                            msg = "brand updated";
                            //location.reload();
                        }
/************** start of refresh */


                        /*************end of refresh**** */
                       // $('#tbl-brand').DataTable().ajax.reload();
                       
                       //$('#tbl-brand').DataTable().ajax.reload();
                        /*
                        $.alert({
                            title: 'success!',
                            content: msg,
                            type: 'GREEN',
                            boxwidth: '400px',
                            theme: 'light',
                            useBootstrap: false,
                            autoclose: 'ok|2000'
                    
                        */

                            
                    /*you can use this when $.alert is not working above*/
                        $.confirm({
                            title: 'Success!',
                            content: msg,
                            type: 'green',
                            boxWidth: '400px',
                            theme: 'light',
                            useBootstrap: false,
                            autoClose: 'ok|2000',
                            buttons: {
                                ok: {
                                    text: 'OK',
                                    btnClass: 'btn-green',
                                    keys: ['enter'],
                                    action: function() {
                                        location.reload();//this reloads the table but it doesnt keep the data you were typing in the form
                                        //get_all();
                                    }
                                }
                            }

                        });
                    },
            
                    error: function (xhr, status, error) {
                        alert(xhr);
                        console.log(xhr.responseText);

                        $.confirm({
                            title: 'Fail!',
                            type: 'red',
                            autoClose: 'ok|2000'
                        });

                        $('#save').prop('disabled', false);
                        $('#save').html('');
                        $('#save').append('save');
                    }
                });
            }
            
            function get_all()
            {   
               // console.log("get_all() function called"); // Add this line to check if the function is being called

                //$('#tbl-brand').DataTable().fnDestroy();             
                $.ajax({
                    url: "../php/sales/all_sales.php",
                    type: "GET",
                    dataType: "JSON",
                    

                success:function(data)
                {  console.log("Data received: ", data);
                   // alert(data);
                  
                   
                    $('#tbl-purchaseReport').DataTable({
                        "aaData": data,
                        "scrollX": true,
                        "aoColumns": [
                           
                            
                            { "sTitle": "id", "mData": "id"},
                            { "sTitle": "procode", "mData": "procode"},
                            { "sTitle": "price", "mData": "price"},
                            { "sTitle": "quantity", "mData": "quantity"},
                            { "sTitle": "total", "mData": "total"},
                            { "sTitle": "date", "mData": "date"},
                            { "sTitle": "paid", "mData": "paid"},
                            { "sTitle": "balance", "mData": "balance"},
                            { "sTitle": "pname", "mData": "pname"},
                            
                            
                            
                          
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
            function get_brand_details(id)
            {
                $.ajax({
                    type : 'POST',
                    url : '../php/brand/edit_return.php',
                    dataType : 'JSON',
                    data : {brand_id:id},

                    success : function(data)
                    {
                        $("html, body").animate({scrollTop: 0}, "slow");
                        Isnew = false
                        brand_id = data.id
                        $('#brandname').val(data.brand);

                        $('#status').val(data.status);
                       


                    },
                    error: function (xhr, status, error){
                        alert(xhr.responseText);
                    }


                });
            }
            function RemoveBrand(id) {
                $.confirm({
                    theme: 'supervan',
                    buttons: {
                    Yes: function () {
                        $.ajax({
                        type: 'POST',
                        url: '../php/brand/remove_brand.php',
                        data: { brand_id: id },
                        success: function (data) {

                            window.location.reload()//refresh the table after deleting
                            // Handle success response
                           /* if (data == 'success') {
                            $.alert({
                                theme: 'supervan',
                                title: 'Success',
                                content: 'brand Removed Successfully',
                            });

                            
                            // Refresh the DataTable
                            var table = $('#tbl-brand').DataTable();
                            table.ajax.reload();
                            } else {
                            $.alert({
                                theme: 'supervan',
                            });
                            }*/
                        },
                        error: function (xhr, status, error) {
                            alert(xhr.responseText);
                        }
                        });
                    },
                   // Add more buttons if needed
                   No: function(){
                
                    
                }
                }
                });
            }
                    
                    


            
        </script>
        
    </body>
        
    </html>
6