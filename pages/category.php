<!DOCTYPE html>
<html>
    
    <head>
        <title></title>
        <link rel="stylesheet" href="../components/jquery-confirm-master/css/jquery-confirm.css">
        <!--<link href="../components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">->
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
     include("header.php"); 
       
    ?>
   
  
  

  
        <div  class="container-fluid">
            <div class="row">
                <div class="col-sm-4">

                    <form class="form-horizontal" id="frmCategory">
                        <div class="form-group" align="left">
                            <label >category</label>
                            <input type="text" id="catname" class="form-control" name="catname" placeholder="category" required>

                        </div>
                        <div class="form-group" align="left">
                            <label >status</label>
                           <select class="form-control" name="status" id="status">
                               <option value="">Please select</option>
                               <option value="1">Active</option>
                               <option value="2">Deactive</option>
                           </select>
                            
                        </div>
                        <div  align="right">
                            <button  type="button" class="btn-info" id="save" onclick="Addcategory()">Add</button>
                            <button type="button" class="btn btn-warning" id="reset" onclick="">Reset</button>
                        </div>

                    </form>
                </div>

                <div class="col-sm-8" >
                    <!--i added style margin-->
                    <div class="panel-body";>
                        <table id="tbl-category" class="table table-responsive table-bordered" cellspacing="0" Width= "100%">
                            <tr>
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

            var category_id = null;
        


            function Addcategory() {
                if ($("#frmCategory").valid()) {
                    var _url = '';
                    var _data = '';
                    var _method;
                    // Valid form
                } else {
                    // Invalid form 
                }

                if (Isnew == true) {
                    _url = '../php/category/add_category.php';
                    _data = $("#frmCategory").serialize();
                    _method = 'POST';
                } else {
                    _url = '../php/category/update.php';
                    _data = $("#frmCategory").serialize() + "&category_id=" + category_id;
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
                        //$("#tbl-category").reload('');
                        
                        var msg;
                        if (Isnew) {
                            msg = "Category created";
                            //location.reload();
                        } else {
                            msg = "Category updated";
                            //location.reload();
                        }
/************** start of refresh */


                        /*************end of refresh**** */
                       // $('#tbl-category').DataTable().ajax.reload();
                       
                       //$('#tbl-category').DataTable().ajax.reload();
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

                //$('#tbl-category').DataTable().fnDestroy();             
                $.ajax({
                    url: "../php/category/all_category.php",
                    type: "GET",
                    dataType: "JSON",

                success:function(data)
                {  //console.log("Data received: ", data);
                   // alert(data);
                    
                    $('#tbl-category').DataTable({
                        "aaData": data,
                        "scrollX": true,
                        "aoColumns": [
                            { "sTitle": "Category", "mData": "catname"},
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
                                "mData": "id", 
                                "render": function (mData, type, row, meta){
                                    return '<button class="btn btn-xs btn-success" onclick="get_category_details(' +mData+ ')">Edit</button>';
                                }
                            },
                            {
                                "sTitle": "Delete",
                                "mData": "id",
                                "render": function(mData, type, row, meta){
                                    return '<button class="btn btn-xs btn-primary" onclick="RemoveCategory('+ mData +')">Delete</button>';
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
            function get_category_details(id)
            {
                $.ajax({
                    type : 'POST',
                    url : '../php/category/edit_return.php',
                    dataType : 'JSON',
                    data : {category_id:id},

                    success : function(data)
                    {
                        $("html, body").animate({scrollTop: 0}, "slow");
                        Isnew = false
                        category_id = data.id
                        $('#catname').val(data.catname);

                        $('#status').val(data.status);
                       


                    },
                    error: function (xhr, status, error){
                        alert(xhr.responseText);
                    }


                });
            }
            function RemoveCategory(id) {
                $.confirm({
                    theme: 'supervan',
                    buttons: {
                    Yes: function () {
                        $.ajax({
                        type: 'POST',
                        url: '../php/category/remove_category.php',
                        data: { category_id: id },
                        success: function (data) {

                            window.location.reload()//refresh the table after deleting
                            // Handle success response
                           /* if (data == 'success') {
                            $.alert({
                                theme: 'supervan',
                                title: 'Success',
                                content: 'Category Removed Successfully',
                            });

                            
                            // Refresh the DataTable
                            var table = $('#tbl-category').DataTable();
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
