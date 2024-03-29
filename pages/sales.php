<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="../components/jquery-confirm-master/css/jquery-confirm.css">
    <link rel="stylesheet" href="../bootstrap.min.css">
    <link rel="stylesheet" href="../components/data tables/DataTables/css/jquery.dataTables.min.css">
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
            <div class="col-sm-8">
                <form class="form-horizontal" id="frmProduct">
                    <table class="table table-bordered">
                        <caption>Add Product</caption>
                        <tr>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Amount</th>
                            <th>Option</th>
                        </tr>
                        <tr>
                            <td><input type="text" id="procode" class="form-control" name="procode" placeholder="procode" required></td>
                            <td><input type="text" id="pname" class="form-control" name="pname" placeholder="pname" disabled></td>
                            <td><input type="text" id="price" class="form-control" name="price" placeholder="price" disabled></td>
                            <td><input type="number" id="qty" class="form-control" name="qty" placeholder="qty" min="1" value="1" required></td>
                            <td><input type="text" id="tot_cost" class="form-control" name="tot_cost" placeholder="tot_cost" disabled></td>
                            <td><button class="btn btn-success" type="button" onclick="addProduct()">Add</button></td>
                        </tr>
                    </table>
                </form>

                <table class="table table-bordered" id="productList">
                    <caption>Products</caption>
                    <thead>
                        <tr>
                            <th>Remove</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <div class="col-sm-4">
                <form class="form-horizontal" id="frmSale">
                    <div class="form-group" align="left">
                        <label>Total</label>
                        <input type="text" id="total" class="form-control" name="total" placeholder="total" disabled>
                    </div>
                    <div class="form-group" align="left">
                        <label>Paid</label>
                        <input type="text" id="paid" class="form-control" name="paid" placeholder="paid" required>
                    </div>
                    <div class="form-group" align="left">
                        <label>Balance</label>
                        <input type="text" id="balance" class="form-control" name="balance" placeholder="balance" disabled>
                    </div>
                    <div>
                        <label>Mode of Payment</label>
                        <select class="form-control" name="pstatus" id="pstatus">
                            <option value="">Please select</option>
                            <option value="1">Cash</option>
                           
                        </select>
                    </div>
                    <div class="form-group">
                        <br>
                        <button class="btn btn-primary btn-block" type="button" onclick="addInvoice()">Sale</button>
                    </div>
                </form>
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
         var isNew=true;
            getProductCode();
             var available_qty;
        
            function getProductCode()
            {//gets the poduct details of the  entered procode
                //alert($('#procode').val());
               $('#procode').keyup(function(e){ 
                $.ajax({
                    type : 'POST',
                    url : '../php/product/getproduct.php',
                    dataType : 'JSON',
                    data : {procode:$('#procode').val()},

                    success : function(data)
                    {
                       // console.log(data);
                        $('#pname').val(data[0].product_name);
                        $('#price').val(data[0].price_retail);
                        $('#qty').focus();
                        available_qty = data[0].qty;

                      
                    },
                    error: function (){
                       
                    }


                   });
                });
               
            }
            
            $(function(){//this function calculates total amount to pay
                $("#price,#qty").on("keydown keyup click",qty);

                function qty()
                {
                    var sum= ( Number($("#price").val()) * Number($("#qty").val()) );

                    $('#tot_cost').val(sum);
                }
            });

            var total = 0;
            function addProduct(){//retrieves user input wen user clicks add  and the input is used in the rest of the code
                var product={
                    procode:$("#procode").val(),
                    pname:$("#pname").val(),
                    price:$("#price").val(),
                    qty:$("#qty").val(),
                    tot_cost:$("#tot_cost").val(),
                
                    };
                    addRov(product);
                    $("#frmProduct")[0].reset();//resets the add field to empty after u have added the product to frmProduct
                }
                
                function addRov(product) {//validation of input wen add button is clicked

                    if($('#procode').val().length==0){
                            $.confirm({
                            title:  'ERROR!',
                            content:'Please enter procode',
                            type: 'red',
                            autoClose: 'ok|2000'
                        });
                        
                        }
                    if(($('#qty').val() >= available_qty)){
                        $.confirm({
                        title:  'ERROR!',
                        content: 'Enter Lower Amount you have'+"  "+ available_qty,
                        type: 'red',
                        autoClose: 'ok|2000'
                    });
                    
                    }
                       
                         
                        
                            
                           
                    else{
                        $.ajax({
                            type : 'POST',
                            url : '../php/sales/reduce_qty.php',
                            dataType : 'JSON',
                            data:{ qty:$("#qty").val(),procode:$("#procode").val()},//pass qty and code to /php/product/qty_increment.php
                                

                    success : function(data)
                    {
                       console.log(data);
                    
                       

                    },
                    error: function (){
                        
                       
                    }

 
                   });
                    
                    var $tableB = $("#productList tbody"); // selector for table body

                    var $row = $("<tr>" +//creates a row dynamicaly with below attributes
                   " <td><button class='btn btn-warning btn-xsm' type='button' onclick='deleterow(this)'>Delete</td>"+
                        "<td>" + product.procode + "</td>" +
                        "<td>" + product.pname + "</td>" +
                        "<td>" + product.price + "</td>" +
                        "<td>" + product.qty + "</td>" +
                        "<td>" + product.tot_cost+ "</td>" +
                        "</tr>"
                    );

                    $row.data("procode", product.procode);//now data is being inserted in the table
                    $row.data("pname", product.pname);
                    $row.data("price", product.price);
                    $row.data("qty", product.qty);
                    $row.data("tot_cost", product.tot_cost);

                    $tableB.append($row);//adds the row to the rest of the existing rows in the table
                    total +=Number(product.tot_cost);//this adds the total amount in the amount column i.e summing 
                    $('#total').val(total);//sets the total amount to total field
                    }
                }
                
            var product_total_cost;        
            function deleterow(e)
            {
                $.ajax({
                    type : 'POST',
                    url : '../php/sales/increase_qty.php',
                    dataType : 'JSON',
                    data:{
                            qty : parseInt($(e).parent().parent().remove().find('td:nth-child(5)').text(),10),//the amount removed and the 5 is the column no of qty 
                            procode : parseInt($(e).parent().parent().remove().find('td:nth-child(2)').text(),10),//the procode removed and the 2 is the column no of qty 
                    },

                    success : function(data)
                    {
                       console.log(data);
                    
                       

                    },
                    error: function (){
                        
                       
                    }

 
                   });
                product_total_cost=parseInt($(e).parent().parent().remove().find('td:last').text(),10);//checks the amount removed 
                total -= product_total_cost;//deducts the amount removed from the total cost
                $('#total').val(total);//sets the total amount to total field

                $(e).parent().parent().remove();//removes the product after deleting

               

            }
            $(function(){   //this function works on the payment side i.e total,paid & balance                                
                $("#total,#paid").on("keydown keyup ",total);

                function total()
                {
                    var sum= (Number($("#paid").val()) -  Number($("#total").val()) );

                    $('#balance').val(sum);
                }
            });
            
            function addInvoice()
            {
                var table_data=[];

                $("#productList tbody tr").each(function(row,tr)
                {

                    var sub;
                    sub ={

                    'procode':$(tr).find('td:eq(1)').text(), //gets the data from add product from index
                    'pname':$(tr).find('td:eq(2)').text(),
                    'price':$(tr).find('td:eq(3)').text(),
                    'qty':$(tr).find('td:eq(4)').text(),
                    'total_cost':$(tr).find('td:eq(5)').text(),
                    
                    };
                    table_data.push(sub);
                });

                
                var isNew=true;
                $.ajax({
                    type : "POST",
                    url : "../php/sales/add_sales.php",
                    dataType : 'JSON',
                    data : {procode:$('#procode').val(),qty:$('#qty').val(), pname:$('#pname').val(),tot_cost:$('#tot_cost').val(),total:$('#total').val(),paid:$('#paid').val(),balance:$('#balance').val(),pstatus:$('#pstatus').val(),data:table_data},

                    success : function(data)
                    {
                        
                        var msg;

                        if(isNew){
                            msg= "Sale completed successful";
                        
                        }
                       
                            
                        $.confirm({
                            title: 'SUCCESS!',
                            content:msg,
                            type: 'green',
                            autoClose: 'ok|2000'
                        });
                    
                        last_id= data.last_id

                        window.location="print_sale.php?last_id=" + last_id; //receives the last_id and pass to print.php
                        


                    },
                    error: function (xhr, status, error){
                        //alert(xhr.responseText);
                       console.log(xhr.responseText);

                    }


                });
                
                }

           
        
    </script>
</body>

</html>
