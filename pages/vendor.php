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
    
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery-->
   
    <?php include("../header.php"); ?>
  

  
        <div class="container-fluid">
            <div class="row">
                <div  class="col-sm-12 bg-success">
                    <form  id="frmVendor" >
                        <div>
                            <h3>Vendor</h3>
                            </br>

                            <div class="row">
                                <div class="col-sm-6 col-sm-3">
                                    <div class="form-group" align="left">
                                        <label >Vendor Name </label>
                                        <input type="hidden" id="vendorid" class="form-control" name="vendorid" placeholder="Vendor" required><!--this gives a field to enter vendor_id but hiding it from user it wil be used to retrieve data from database-->
 
                                        <input type="text" id="vendorName" class="form-control" name="vendorName" placeholder="Vendor" required>
 
                                     </div>
                                </div>	

                                <div class="col-sm-6 col-sm-3">
                                    <div class="form-group" align="left">
                                        <label > Contact Number </label>
                                        <input type="text" id="contactNo" class="form-control" name="contactNo" placeholder=" contactNo" required>
 
                                     </div>
                                </div>
                                <div class="col-sm-6 col-sm-3">
                                    <div class="form-group" align="left">
                                        <label >Email</label>
                                        <input type="text" id="email" class="form-control" name="email" placeholder=" Email" required>
                                            
                                    </div>
                                </div>
                                <div class="col-sm-6 col-sm-3">
                                    <div class="form-group" align="left">
                                        <label >Address</label>
                                        <input type="text" id="address" class="form-control" name="address" placeholder=" Address" required>
                                        
                                    </div>
                                </div>

                                <div class="col-sm-6 col-sm-3" align="left">
                                    <label >status</label>
                                        <select class="form-control" name="vendorStatus" id="vendorStatus">
                                            <option value="">Please select</option>
                                            <option value="1">Active</option>
                                            <option value="2">Deactive</option>
                                         </select>
                            
                                </div>
                                <div class="col-sm-10" align="right">
                                        <button  type="button" class="btn-info" id="save" onclick="AddVendor()">Add</button>
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
                        <table id="tbl-vendor" class="table table-responsive table-bordered" cellspacing="0" Width= "100%">
                           
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
            
           
            get_all();
            var Isnew = true;
            var brand_id = null;
            var vendor_id = null;
           


            function AddVendor() {
                if($("#vendorName").val()=='')//checks for non entered value and returns warning requesting u to enter value
                {
                    alert('Vendor Name required');
                    $("#vendorName").focus();
                    return false;

                }

                if($("#vendorStatus").val()=='')//same to this
                {
                    alert('Status required');
                    $("#vendorStatus").focus();
                    return false;

                }
                if($("#frmVendor").valid()){
                    var _url = '';
                    var _data = '';
                    var _method;
                    var vendor_id=$("#vendorid").val();//do research but it works with hidden vendor_id
                    // Valid form
                } else {
                    // Invalid form 
                }

                if (Isnew == true) {
                    _url = '../php/vendor/add_vendor.php';
                    _data = $("#frmVendor").serialize();
                    _method = 'POST';
                } else {
                    _url = '../php/vendor/update_vendor.php';
                    _data =  _data = $("#frmVendor").serialize() + "&vendor_id=" + vendor_id;
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
                            msg = "Vendor created";
                            //location.reload();
                        } else {
                            msg = "Vendor updated";
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
                    url: "../php/vendor/all_vendor.php",
                    type: "GET",
                    dataType: "JSON",

                success:function(data)
                {  //console.log("Data received: ", data);
                   // alert(data);
                    
                    $('#tbl-vendor').DataTable({
                        "aaData": data,
                        "scrollX": true,
                        "aoColumns": [
                            { "sTitle": "Vendor Name", "mData": "vname"},
                            { "sTitle": "Contact No", "mData": "contactno"}, 
                            { "sTitle": "Email", "mData": "email"},
                            { "sTitle": "Address", "mData": "address"},

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
                                "mData": "vendor_id", 
                                "render": function (mData, type, row, meta){
                                    return '<button class="btn btn-xs btn-success" onclick="get_vendor_details(' +mData+ ')">Edit</button>';
                                }
                            },
                            {
                                "sTitle": "Delete",
                                "mData": "vendor_id",
                                "render": function(mData, type, row, meta){
                                    return '<button class="btn btn-xs btn-primary" onclick="RemoveVendor('+ mData +')">Delete</button>';
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
            function get_vendor_details(id)
            {
                $.ajax({
                    type : 'POST',
                    url : '../php/vendor/edit_return.php',
                    dataType : 'JSON',
                    data : {vendor_id:id},

                    success : function(data)
                    {
                        $("html, body").animate({scrollTop: 0}, "slow");
                        Isnew = false;
                        vendor_id = data.id;
                        $('#vendorName').val(data.vname);//we are placing the value from variable to the field of the text box #fieldname 
                        $('#contactNo').val(data.contactno);
                        $('#email').val(data.email);
                        $('#address').val(data.address);
                        $('#vendorStatus').val(data.status);
                        $('#vendorid').val(data.vendor_id);//
                        



                    },
                    error: function (xhr, status, error){
                        alert(xhr.responseText);
                    }


                });
            }
          
            function RemoveVendor(id) {
                $.confirm({
                    theme: 'supervan',
                    buttons: {
                    Yes: function () {
                        $.ajax({
                        type: 'POST',
                        url: '../php/vendor/remove_vendor.php',
                        data: { vendor_id: id },
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
