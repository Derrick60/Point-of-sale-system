<!DOCTYPE html>
<html>
    
    <head>
        <title></title>
        <link rel="stylesheet" href="../components/jquery-confirm-master/css/jquery-confirm.css">
        <!--<link href="../components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="../components/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
       <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">-->
       
       
        <link rel="stylesheet" href="../bootstrap.min.css">

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
     include("header.php"); 
       
    ?>
        

   
   
  

  
        <div class="container-fluid">
            <div class="row">
                <div  class="col-sm-12 bg-success">
                    <form  id="frmProduct" >
                        <div>
                            <h3>Product</h3>
                            </br>

                            <div class="row">
                                <div class="col-sm-6 col-sm-3">
                                    <div class="form-group" align="left">
                                        <label >ProductName </label>
                                        <input type="text" id="productName" class="form-control" name="productName" placeholder="Product" required>
 
                                     </div>
                                </div>
                                <div class="col-sm-6 col-sm-3">
                                    <div class="form-group" align="left">
                                        <label >Product Description </label>
                                        <input type="text" id="productDescription" class="form-control" name="productDescription" placeholder="product Description" required>
 
                                     </div>
                                </div>
                                <div class="col-sm-6 col-sm-3">
                                    <div class="form-group" align="left">
                                        <label >Barcode </label>
                                        <input type="text" id="barcode" class="form-control" name="barcode" placeholder="barcode" required>
 
                                     </div>
                                </div>
                                <div class="col-sm-6 col-sm-3">
                                    <div class="form-group" align="left">
                                        <label >Category</label>
                                            <select class="form-control" name="category" id="category">
                                                <option value="">Please select</option>
                                                
                                            </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-sm-3">
                                    <div class="form-group" align="left">
                                        <label >Brand</label>
                                            <select class="form-control" name="brand" id="brand">
                                                <option value="">Please select</option>
                                                
                                            </select>
                                    </div>
                                </div>

                                <div class="col-sm-3 ">
                                    <div class="form-group" align="left">
                                        <label>Warranty</label>
                                        <input type="text" id="warranty" class="form-control" name="warranty" placeholder="warranty" required>
                                    </div>
                               </div>

                                <div class="col-sm-6 col-sm-3">
                                    <div class="form-group" align="left">
                                        <label >Retail Price </label>
                                        <input type="text" id="retailPrice" class="form-control" name="retailPrice" placeholder="Retail Price" required>
 
                                     </div>
                                </div>
                                <div class="col-sm-6 col-sm-3">
                                    <div class="form-group" align="left">
                                        <label >Cost Price </label>
                                        <input type="text" id="costPrice" class="form-control" name="costPrice" placeholder="price Cost" required>
 
                                     </div>
                                </div>
                                <div class="col-sm-6 col-sm-3">
                                    <div class="form-group" align="left">
                                        <label >Reorder Level </label>
                                        <input type="text" id="reorderLevel" class="form-control" name="reorderLevel" placeholder="Reorder Level" required>
 
                                     </div>
                                </div>
                                <div class="col-sm-6 col-sm-3">
                                    <div class="form-group" align="left">
                                        <label >quantity </label>
                                        <input type="text" id="qty" class="form-control" name="qty" placeholder="qty" required>
 
                                     </div>
                                </div>
                                <div class="col-sm-6 col-sm-3">
                                    <div class="form-group" align="left">
                                        <label >Date </label>
                                        <input type="date" id="date" class="form-control" name="date" placeholder="" required>
 
                                     </div>
                                </div>

                                <div class="col-sm-6 col-sm-3" align="left">
                                    <label >status</label>
                                        <select class="form-control" name="productStatus" id="productStatus">
                                            <option value="">Please select</option>
                                            <option value="1">Active</option>
                                            <option value="2">Deactive</option>
                                         </select>
                            
                                </div>
                                <div class="col-sm-10" align="right">
                                        <button  type="button" class="btn-info" id="save" onclick="AddProduct()">Add</button>
                                        <button type="button" class="btn btn-warning" id="reset" onclick="">Reset</button>
                                </div>
        
                            </div>
                        </div>
  
       
                    </form>

                </div>
            </div>

         
        </div>`
        <div class="col-sm-12" >
                    <div class="panel-body";>
                        <table id="tbl-product" class="table table-responsive table-bordered" cellspacing="0" Width= "100%">
                           
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
                                <th></th>
                                <th></th>
                                <th></th>
                                
                                
                            </tr>
                            
                        </table>



                    </div>
        </div>

        <script src="../components/jquery/dist/jquery.js"></script>
       <script src="../components/jquery/dist/jquery-min.js"></script>
        <script src="../components/jquery.validate.min.js"></script>
        <script src="../components/bootstrap/dist/js/bootstrap.js"></script>
        <script src="../components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../components/jquery-confirm-master/js/jquery-confirm.js"></script>
        <script src="../components/jquery/dist/jquery-min.map"></script>
        
        

       <!-- <script src="../jquery.min.js"></script>
        <script src="../bootstrap.min.js"></script>-->

        <script src= "../components/data tables/DataTables/js/jquery.dataTables.min.js"></script>
        
        <script>
            
            getCategory();
            getBrand();
            
            function getCategory() {
                $.ajax({
                    type: "GET",
                    url: "../php/category/getcategory.php",              
                    dataType: "JSON",
                    success: function (data) {
                        for (var i = 0; i < data.length; i++) {
                            $('#category').append($("<option/>", {
                                value: data[i].id,
                                text: data[i].catname,
                            }));
                        }
                    },
                    error: function (xhr, status, error) {
                        alert(xhr);
                        console.log(xhr.responseText);
                    }


                });
            }
            function getBrand() {
                $.ajax({
                    type: "GET",
                    url: "../php/brand/getbrand.php",              
                    dataType: "JSON",
                    success: function (data) {
                        for (var i = 0; i < data.length; i++) {
                            $('#brand').append($("<option/>", {
                                value: data[i].id,
                                text: data[i].brand,
                            }));
                        }
                    },
                    error: function (xhr, status, error) {
                        alert(xhr);
                        console.log(xhr.responseText);
                    }


                });
            }

            get_all();
            var Isnew = true;
            var brand_id = null;
            var product_id = null;
           


            function AddProduct() {
                if($("#productName").val()=='')//checks for non entered value and returns warning requesting u to enter value
                {
                    alert('Product Name required');
                    $("#productName").focus();
                    return false;

                }

                if($("#productStatus").val()=='')//same to this
                {
                    alert('Status required');
                    $("#productStatus").focus();
                    return false;

                }
                if($("#frmProduct").valid()){
                    var _url = '';
                    var _data = '';
                    var _method;
                    // Valid form
                } else {
                    // Invalid form 
                }

                if (Isnew == true) {
                    _url = '../php/product/add_product.php';
                    _data = $("#frmProduct").serialize();
                    _method = 'POST';
                } else {
                    _url = '../php/product/update_product.php';
                    _data =  _data = $("#frmProduct").serialize() + "&product_id=" + product_id;
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
                            msg = "Product created";
                            //location.reload();
                        } else {
                            msg = "Product updated";
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

                            
                    //*you can use this when $.alert is not working above
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
                    url: "../php/product/all_product.php",
                    type: "GET",
                    dataType: "JSON",

                success:function(data)
                {  //console.log("Data received: ", data);
                   // alert(data);
                    
                    $('#tbl-product').DataTable({
                        "aaData": data,
                        "scrollX": true,
                        "aoColumns": [
                            { "sTitle": "Product Name", "mData": "product_name"},
                            { "sTitle": "Description", "mData": "description"}, 
                            { "sTitle": "Barcode", "mData": "barcode"},
                            { "sTitle": "Category", "mData": "category_id"},
                            { "sTitle": "Brand", "mData": "brand_id"},
                            { "sTitle": "Warranty", "mData": "warranty"},
                            { "sTitle": "Retail_price", "mData": "price_retail"},
                            { "sTitle": "Cost_price", "mData": "price_cost"},
                            { "sTitle": "reorderLevel", "mData": "reorderlevel"},
                            { "sTitle": "qty", "mData": "qty"},
                            { "sTitle": "Date", "mData": "date"},
                            
                            

                            {  
                                "sTitle": "Status", "mData": "status", "render": function (mData, type, row, meta){
                                if(mData == 1)
                                {
                                   return '<span class="label label-info">Active</span>';
                                }
                                else if (mData == 2)
                                {
                                   return '<span class= "label label-warning">Deactive</span>';
                                }
                            }
                            },
                            {
                                "sTitle": "Edit",
                                "mData": "product_id", 
                                "render": function (mData, type, row, meta){
                                    return '<button class="btn btn-xs btn-success" onclick="get_product_details(' +mData+ ')">Edit</button>';
                                }
                            },
                            {
                                "sTitle": "Delete",
                                "mData": "product_id",
                                "render": function(mData, type, row, meta){
                                    return '<button class="btn btn-xs btn-primary" onclick="RemoveProduct'+ mData +')">Delete</button>';
                            }
                            }
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
            function get_product_details(id)
            {
                $.ajax({
                    type : 'POST',
                    url : '../php/product/edit_return.php',
                    dataType : 'JSON',
                    data : {product_id:id},

                    success : function(data)
                    {
                        $("html, body").animate({scrollTop: 0}, "slow");
                        Isnew = false;
                        product_id = data.id;
                        $('#productName').val(data.product_name);
                        $('#productDescription').val(data.description);
                        $('#barcode').val(data.barcode);
                        $('#category').val(data.category_id);
                        $('#brand').val(data.brand);
                        $('#warranty').val(data.warranty);
                        $('#retailPrice').val(data.price_retail);
                        $('#costPrice').val(data.price_cost);
                        $('#reorderLevel').val(data.reorderlevel);
                        $('#qty').val(data.qty);
                        $('#date').val(data.date);
                        $('#productStatus').val(data.status);
                           
                       


                    },
                    error: function (xhr, status, error){
                        alert(xhr.responseText);
                    }


                });
            }
            function RemoveProduct(id) {
                $.confirm({
                    theme: 'supervan',
                    buttons: {
                    Yes: function () {
                        $.ajax({
                        type: 'POST',
                        url: '../php/product/remove_product.php',
                        data: { product_id: id },
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
