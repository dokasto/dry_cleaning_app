<?php $data = $this->data ?>

<style>
            body {
                padding-top: 0px;
                padding-bottom:0px;
                background-color: #eee
            }

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

<style type="text/css" media="print">
    #print,
    #updateBtn,
    #delDiv,
    #sidebar-wrapper,
    .navbar{
        display: none !important;
    }
</style>

    <div class="container">
      <!-- Example row of columns -->

   <div class="row">
    <div class="panel panel-default col-md-8 col-md-offset-2">
        <div class="row"  style="margin-top:-13px;">
            <div style="margin-top:19px;" class="col-md-4 col-md-offset-0">
                <strong>Name:</strong> <?php echo $data->client->name ?><br>
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
                                <span style="font-size: 15px; padding:3px 10px;" class="label label-danger">Unpaid</span>
                                <!-- <a href="paynow.html">Pay now</a> -->
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
                        <td class="text-right" colspan="3" ><strong>Booking Status</strong></td>
                        <td align="center">
                            <?php $status = array("pending","processing","ready","picked up") // Booking Status ?>
                            <?php if($data->booking->status == 'picked up'){ ?>
                                <input type="hidden" id="status" value="<?php echo $data->booking->status ?>" data-old="<?php echo $data->booking->status ?>" />
                                <span style="font-size: 13px; padding:3px 10px;" class="label label-info">Picked up on <?php echo date("d F, Y",strtotime($data->booking->collection_date)) ?></span>
                            <?php }else{ ?>
                                <?php
                                $typeColor = '' ;
                                switch ($data->booking->status){
                                    case 'picked up':
                                        $typeColor = 'primary';
                                        break;
                                    case 'pending':
                                        $typeColor = 'warning';
                                        break;
                                    case 'processing':
                                        $typeColor = 'info';
                                        break;
                                    case 'ready':
                                        $typeColor = 'success';
                                        break;
                                }
                                ?>
                                <span class="label label-<?php echo $typeColor ?>"><?php echo $data->booking->status ?></span>
                            <?php } ?>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="margin: 15px 0">
                <a class="btn btn-info" style="float: right" id="print" href=""><i class="glyphicon glyphicon-print"></i> print </a>
            </div>
        </div>

    </div>
 </div>

    </div> <!-- /container -->

<script type="text/javascript">
    $(document).ready(function(){
        $("#print").on('click', function(e){
            e.preventDefault();
            window.print();
        });
    });
</script>
