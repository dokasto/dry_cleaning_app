
<?php $data = $this->data ?>

<style type="text/css" media="print">
    #print,
    #updateBtn,
    #delDiv,
    #sidebar-wrapper,
    .navbar{
        display: none !important;
    }
</style>

<style>
    #delDiv{
        margin-bottom: 90px;
    }
</style>

<script src="<?php echo URL . '/public/admin/' ?>js/jquery-ui.min.js"></script>

<script>
    $(function() {
        $("#pickupdate").datepicker({dateFormat : 'yy-mm-dd'});
    });
    var client_id = "<?php echo $data->booking->client_id ?>" ;
    var bid = "<?php echo $data->booking->bid ?>" ;
</script>

<style>
    .money{
        font-weight: bold;
        color: #429620;
    }

    .money:before{
        content: "\20A6" ;
    }

    #updateBtn{
        display: none;
    }
</style>


    <div class="container">
<div class="row" style="margin-left:100px; margin-top:-10px;">
    <div class="panel panel-default col-md-9 col-md-offset-2">

    <div class="row"  style="margin-top:-13px;">
      <div style="margin-top:19px;" class="col-md-4 col-md-offset-0">
        <strong><?php echo $data->client->name ?></strong>
        <br>
          <strong>Address:</strong><br>
          <?php echo $data->client->address ?>
        <br>
          Phone: <?php echo $data->client->phone ?>
        <br>
          Email: <?php echo $data->client->email ?>
        <br>
          Transaction ID: <?php echo $data->booking->code ?>
      </div>
      <div style="margin-top:15px;" class="col-md-7 col-md-offset-1">
      <form class="form-horizontal" role="form">
       <div class="form-group">
    <label class="col-sm-7 control-label">Created on</label>
    <div class="col-sm-3">
      <p class="form-control-static" style="width: 150px"><?php echo date("d F, Y",strtotime($data->booking->created)) ?></p>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword" class="col-sm-7  control-label">Pick-up Date</label>
    <div class="col-sm-5">
        <p class="form-control-static" style="width: 150px"><?php echo date("d F, Y",strtotime($data->booking->pickup_date)) ?></p>

       </div>
  </div>
  <div class="form-group ">
      <label for="inputPassword" class="col-sm-7 control-label">Payment Status</label>
      <div class="col-xs-5">
          <?php if ($data->booking->payment_status == 1){ ?>
              <input id="paymentStatus" data-old="<?php echo $data->booking->payment_status ?>" type="hidden" value="1">
              <span style="font-size: 15px; padding:3px 10px;" class="label label-success">Paid</span>
          <?php }else{ ?>
      <select id="paymentStatus" data-old="<?php echo $data->booking->payment_status ?>" class="form-control input-sm ">
        <option value="1">Paid</option>
        <option value="0" selected>Unpaid</option>
      </select>
          <?php } ?>
      </div>
      </div>
</form>

      
      </div>
      </div>

      <div class="row">
         <div style="margin-top:20px;" class="col-md-12 col-md-offset-0">
            <table class="table table-bordered table-condensed">
            <caption><h4>Culmen Dry Cleaners</h4></caption>
                  <thead>
                  <tr class="active">
                      <th>Cloth  Type</th>
                      <th>Price</th>
                      <th align="center">Quantity</th>
                      <th>Amount</th>
                  </tr>
              </thead>   
              <tbody>
              <?php $totalClothes = $totalPrice = 0 ?>
              <?php foreach($data->items as $item){ ?>
              <?php $fmt = '%!i' ?>
                <tr>
                    <td><?php echo $item->name ?></td>
                    <td class="money"><?php echo money_format($fmt,$item->price) ?></td>
                    <td align="center"><?php echo $item->quantity ?></td>
                    <td class="money"><?php echo money_format($fmt,$item->cost) ?></td>
                </tr>
              <?php $totalClothes += $item->quantity ?>
              <?php $totalPrice += $item->cost ?>
              <?php } ?>
                   <td class="active text-right" colspan="3"><strong>Total Clothes :</strong></td>
                    <td class="active text-center"><strong><?php echo $totalClothes ?></strong></td>
                </tr>
                 <tr>
                   <td class="active text-right" colspan="3"><strong>Total Amount :</strong></td>
                    <td class="active text-center"><strong class="money"><?php echo money_format($fmt,$totalPrice) ?></strong></td>
                </tr>

              <tr>
                  <td class="text-right" ><strong>Booking Status</strong></td>
                  <td align="center" colspan="3">
                      <?php $status = array("pending","processing","ready","picked up") // Booking Status ?>
                      <?php if($data->booking->status == 'picked up'){ ?>
                          <input type="hidden" id="status" value="<?php echo $data->booking->status ?>" data-old="<?php echo $data->booking->status ?>" />
                          <span style="font-size: 13px; padding:3px 10px;" class="label label-info">Picked up on <?php echo date("d F, Y",strtotime($data->booking->collection_date)) ?></span>
                      <?php }else{ ?>
                      <select id="status" data-old="<?php echo $data->booking->status ?>" class="form-control input-sm ">
                          <?php foreach($status as $select){ ?>
                          <?php     if($select == $data->booking->status){ ?>
                                  <?php echo "<option selected value='$select'>$select</option>" ?>
                          <?php       }else{   ?>
                                  <?php echo "<option value='$select'>$select</option>" ?>
                              <?php } ?>
                          <?php } ?>
                      </select>
                      <?php } ?>
                  </td>
              </tr>
                                              
              </tbody>
            </table>
            </div>
            </div>

            <div class="row">
              <div class="col-md-12" style="margin: 15px 0">
                  <a class="btn btn-success" id="updateBtn" href=""><i class="glyphicon glyphicon-upload"></i> Update </a>
                  <a class="btn btn-info" style="float: right" id="print" href=""><i class="glyphicon glyphicon-print"></i> print </a>

                  </div>
            </div>

</div>

    <div id="delDiv" class="row">
        <div class="col-md-5 col-md-offset-4">
            <small>This action cannot be undone</small>
            <button class="btn btn-large btn-block btn-danger" id="deleteBtn" type="button"><i class="glyphicon glyphicon-trash"></i> Delete this booking</button>
        </div>
    </div>

</div>


    </div> <!-- /container -->

<script type="application/javascript">
    $(document).ready(function(){
        var updateBtn = $("#updateBtn") ;
        var paymentStatus = $("#paymentStatus") ;
        var status = $("#status") ;
        var print = $("#print") ;
        var deleteBtn = $("#deleteBtn");
        var transactionCode = "<?php echo $data->booking->code ?>";

        deleteBtn.on('click', function(e){
            e.preventDefault();
            var $this = $(this);
            var verify = confirm("Are you sure you want to delete this booking ?");
            if(verify === true){
                var postData = { "bid":bid };
                $this.hide();
                $.post( URL + '/service/admin/booking/delete', postData , function(data){
                    if(data.status == true){
                        //window.location = URL + '/admin/bookings' ;
                        history.go(-1);
                    }else{
                        $this.show();
                        alert(data.result);
                    }
                });
            }
        });

        paymentStatus.on('change', function(){
            updateBtn.show();
        });

        status.on('change', function(){
            updateBtn.show();
        });

        print.on('click', function(e){
            e.preventDefault();
            window.print();
        });

        /* Update button is clicked */
        updateBtn.on('click', function(e){
            e.preventDefault();
            var new_status = status.val();
            var old_status = status.attr("data-old");
            var new_payment_status = paymentStatus.val();
            var old_payment_status = paymentStatus.attr("data-old");
            if(new_status == old_status && new_payment_status == old_payment_status){
                alert("No changes were made");
                updateBtn.hide();
            }else{
                var postData = { 'new_status': new_status,
                                 'old_status': old_status,
                                 'new_payment_status': new_payment_status,
                                 'old_payment_status': old_payment_status,
                                 'client_id': client_id,
                                 'transactionCode': transactionCode ,
                                 'bid': bid };

                $.post( URL + '/service/admin/booking/update', postData, function(data){
                    if(data.status == true){
                        location.reload(true);
                    }else{
                        alert(data.result);
                    }
                });
            }
        });

    });
</script>


    <style type="text/css">
    body{
    background-color:#eee;
  }
    </style>

   

