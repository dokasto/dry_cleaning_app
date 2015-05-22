<!-- Inject external css links here -->
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/smoothness/jquery-ui.css">


<?php $picture=''; $client = $this->client ; ?>
<?php
$file = 'data/profiles/' .$client->picture ;
if( strlen($client->picture) > 2 && file_exists($file)){
    $picture = URL . '/data/profiles/'.$client->picture  ;
}else{
    $picture = URL . '/public/client/img/default.jpg' ;
}

?>
<script src="<?php echo URL . '/public/admin/' ?>js/jquery-ui.min.js"></script>

<script type="text/javascript" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">

    $(function() {
        $("#pickupdate").datepicker({dateFormat : 'yy-mm-dd'});
    });

    var item = function(id,name,price){
        this.id = parseInt(id) ;
        this.name = name ;
        this.price = parseInt(price) ;
    };

    var pricelist = [];

    <?php
    echo "\n";
    $pricelist = $this->priceList ;
    foreach($pricelist as $item){
    @extract($item);
    $item_id = trim($item_id);
    $name = trim($name);
    $price = trim($price);
    echo " pricelist[$item_id] =  new item(\"$item_id\",\"$name\",\"$price\"); \n" ;
    }
    ?>

    var client_id = parseInt("<?php echo $client->client_id ?>") ;

</script>

<style>
    .money{
        font-weight: bold;
        color: #429620;
    }

    .money:before{
        content: "\20A6" ;
    }

    #addbtn{
        display: none;
    }

    table td{
        font-weight: bold;
        font-size: 16px;
    }

    #totalclothes{
        color: #d9534f;
        font-size: 20px;
    }

    #checkoutbtn{
        display: none;
    }
</style>

    <div class="container">

        <div class="row">
            <div class="col-md-12 col-md-offset-1" >
                <div class="row">
                    <div class="col-lg-5 col-md-offset-3">
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object dp img-circle" src="<?php echo $picture ?>" style="width: 100px;height:100px;">
                            </a>
                            <div class="media-body">
                                <span class="label label-info">Booking for</span> <br><br>
                                <h4 class="media-heading"><?php echo $client->name ?></h4>
                                <h5></h5>
                                <hr style="margin:8px auto">

                                <span class="label label-default">email: <?php echo $client->email ?></span>
                                <span class="label label-default">phone: <?php echo $client->phone ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- /container -->
<br><br>



            <!-- Bookings Table -->
<div class="container">
    <div class="row">

        <div class="col-sm-12 col-md-10 col-md-offset-2">
            <table class="table table-hover bookingTable">
                <thead>
                <tr>
                    <th>Cloth Type</th>
                    <th>Price</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Total</th>
                    <th> </th>
                </tr>
                </thead>

                <thead>
                <tr>
                    <td class="col-sm-8 col-md-6">
                        <div class="media">
                            <div class="media-body">
                                <select id="chooseType" class="form-control input-group-lg">
                                    <option selected value="0">Select cloth type</option>
                                    <?php
                                    foreach($pricelist as $each){
                                        extract($each);
                                        echo "<option value=\"$item_id\">$name</option>" ;
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </td>

                    <td class="col-sm-1 col-md-1 text-center money" id="choosePrice">0.00</td>

                    <td class="col-sm-1 col-md-1 text-center">
                        <input type="number" value="1" id="chooseQuantity" placeholder="quantity" class="form-control " />
                    </td>

                    <td class="col-sm-1 col-md-1 text-center money" id="chooseTotal">0.00</td>
                    <td class="col-sm-1 col-md-1">
                        <button type="button" id="addbtn" class="btn btn-success">
                            <span class="glyphicon glyphicon-plus"></span>
                        </button></td>
                </tr>

                </thead>


                <tbody id="tableBody"></tbody>

                <tfoot>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td><h5>Pick-up date</h5></td>
                    <td class="text-right"> <input type="text" id="pickupdate" placeholder="Pickup date" class="form-control " /></td>
                </tr>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td><h5>Total clothes</h5></td>
                    <td class="text-right" id="totalclothes"> 0</td>
                </tr>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td><h3>Total</h3></td>
                    <td class="text-right"><h3><strong class="money" id="totalprice">00.00</strong></h3></td>
                </tr>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td>
                        <button type="button" id="checkoutbtn" class="btn btn-success">
                            Checkout <span class="glyphicon glyphicon-play"></span>
                        </button></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

    <br><br><br><br>

<script type="text/javascript">

    /* Update cart before it is added*/
    function updateCart(){
        var item_id = parseInt($("#chooseType") .val());
        var quantity = parseInt($("#chooseQuantity").val()) ;
        if(item_id == 0){
            alert("Please choose a cloth type");
            $("#chooseQuantity").val("1");
        }else{

            var item = pricelist[item_id] ;
            var price = item.price ;
            var total = quantity * price ;
            $("#choosePrice").text(price) ;
            $("#chooseTotal").text(total);
        }
    }

    /* Update total Price */
    function updateCartTotal(){
        var clothcount = $("#totalclothes");
        var totalprice = $("#totalprice");
        var rows = $(".item-row");
        var qty = 0;
        var price = 0 ;

        rows.each(function(){
            qty += parseInt( $(this).find('.item-quantity').text());
            price += parseInt( $(this).find('.item-total').text());
        });
        clothcount.text(qty);
        totalprice.text(price) ;

        if( qty < 1){
            $("#checkoutbtn").hide();
        }
    }

    var productObj = function(item_id,quantity){
        var i = parseInt(item_id) ;
        var item = pricelist[i] ;
        var total = item.price * parseInt(quantity) ;
        var HTML ;
            HTML+= '<tr class="item-row" data-id="' + item_id +'">' ;
            HTML+= '<td class="col-sm-8 col-md-6 item-type" data-id="1">' + item.name + "</td>" ;
            HTML+= '<td class="col-sm-1 col-md-1 text-center money item-price">' + item.price + '</td>';
            HTML+= '<td class="col-sm-1 col-md-1 text-center item-quantity">' + quantity + '</td>';
            HTML+= '<td class="col-sm-1 col-md-1 text-center item-total money">' + total + '</td>';
            HTML+= '<td class="col-sm-1 col-md-1"><button type="button" class="removebtn btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button></td>';
            HTML+= '</tr>';
        this.html = HTML ;
    };

</script>

<script type="text/javascript">
    $(document).ready(function(){

        var clothType = $("#chooseType") ;
        var quantity = $("#chooseQuantity") ;
        var addBtn = $("#addbtn");
        var productsTable = $("#tableBody");
        var checkout = $("#checkoutbtn") ;

        /* Checkout is clicked */
        checkout.on('click', function(e){
            e.preventDefault();
            var itemArray = [] ;
            var i = 0 ;
            var itemsJson ;

            productsTable.find('.item-row').each(function(){
                var id = parseInt($(this).attr('data-id'));
                var qty = parseInt($(this).find('.item-quantity').text());
                itemArray[i] = { 'item_id' :  id , 'quantity' : qty } ;
                i++;
            });

            itemsJson = JSON.stringify(itemArray);
            var pickupdate = $("#pickupdate").val();
            if(pickupdate.length < 5){
                alert("Set the expected pickup date");
                exit();
            }
            var postData = { "client_id":client_id , "items": itemsJson , "pickup_date": pickupdate };
            $.post( URL + "/service/admin/booking/new", postData , function(data){
                if(data.status == true){
                   window.location = URL + '/admin/bookings/' + data.result ;
                }else{
                    alert(data.result);
                }
            });

        });

        addBtn.on('click', function(e){
            e.preventDefault();
            var id = clothType.val();
            var qty = quantity.val();
            var newline = new productObj(id,qty);
            //alert(newline.html);
            productsTable.append(newline.html) ;
            clothType.prop('selectedIndex',0);
            quantity.val('1');
            $("#choosePrice").text("0.00") ;
            $("#chooseTotal").text("0.00") ;
            $(this).hide();
            checkout.show();
            updateCartTotal();
        });


        $('body').on('click', '.removebtn' , function(e){
            e.preventDefault();
                $(this).parent('td').parent('tr').fadeOut('fast', function(){
                $(this).remove();
                updateCartTotal();
            });

        });

        clothType.on('change', function(){
            if ( $(this).val()  == '0' ){
                alert('Please select a cloth type') ;
                addBtn.hide();
            }else{
                addBtn.show();
                updateCart() ;
            }
        });

        quantity.on('change', function(){
            if ( parseInt( $(this).val() ) < 1 ){
                alert('quantity cannot be less than 1') ;
                $(this).val('1');
            }else{
                updateCart() ;
            }
        });

    });
</script>