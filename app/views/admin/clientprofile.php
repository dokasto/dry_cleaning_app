
<style>

            body {
              padding-top:0px;
              }


            .glyphicon {  margin-bottom: 10px;margin-right: 10px;}

            small {
              display: block;
              line-height: 1.428571429;
              color: #999;
                }
              .black{
                color:#000;
              }

        </style>

        <script>
        var bookingsTable = false;
        </script>

    <!--content-->
   <div class="container">
       <div class="row">
           <div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-4">
               <div class="well well-sm">
                   <div class="row">
                       <!-- <div class="col-sm-6 col-md-4">
                           <?php
                           $file = 'data/profiles/' .$this->client->picture ;
                           if( strlen($this->client->picture) > 2 && file_exists($file)){
                               $picture = URL . '/data/profiles/'.$this->client->picture  ;
                           }else{
                               $picture = URL . '/public/client/img/default.jpg' ;
                           }
                           ?>
                           <img src="<?php echo $picture ?>" alt="" class="img-rounded img-responsive" />
                       </div> -->
                       <div class="col-sm-6 col-md-8">
                           <h4><?php echo $this->client->name ?></h4>
                           <small><cite title="San Francisco, USA"><?php echo $this->client->address ?> <i class="glyphicon glyphicon-map-marker">
                                   </i></cite></small>
                           <p>
                               <i class="glyphicon glyphicon-envelope"></i><?php echo $this->client->email ?>
                               <br />
                               <i class="glyphicon glyphicon-phone"></i><?php echo $this->client->phone ?>
                               <br />
                               <i class="glyphicon glyphicon-time"></i><?php echo date("d F, Y",strtotime($this->client->created)) ?></p>
                           <!-- Split button -->
                        <!--   <div class="btn-group">
                               <button type="button" class="btn btn-primary">
                                   Social</button>
                               <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                   <span class="caret"></span><span class="sr-only">Social</span>
                               </button>
                               <ul class="dropdown-menu" role="menu">
                                   <li><a href="#">Twitter</a></li>
                                   <li><a href="https://plus.google.com/+Jquery2dotnet/posts">Google +</a></li>
                                   <li><a href="https://www.facebook.com/jquery2dotnet">Facebook</a></li>
                                   <li class="divider"></li>
                                   <li><a href="#">Github</a></li>
                               </ul>
                           </div>-->
                       </div>
                   </div>
               </div>
           </div>
       </div>

       <?php
       if(isset($this->bookings)){
          echo "<script> bookingsTable = True; </script>";
           $bookings = $this->bookings;
           unset($this->bookings);
       }
       ?>

       <div class="row">
           <div class="col-md-12 col-md-offset-1" >
               <div class="panel panel-primary" style="margin-left:23px;margin-top:-5px;">
                   <div class="panel-heading"><span class="h4 text-center" >Transaction History</span></div>
                   <div class="panel-body">
                       <table id="history" class="table table-striped table-condensed">
                           <thead>
                           <tr class="">
                               <th>Transaction ID</th>
                               <th>Date</th>
                               <th>Client</th>
                               <th>Payment Status</th>
                               <th>Status</th>
                               <th>&nbsp;</th>
                           </tr>
                           </thead>
                           <tbody>
                           <?php if(isset($bookings)){ ?>
                               <?php foreach($bookings as $data){ ?>
                                   <tr>
                                       <td><?php echo $data->code ?></td>
                                       <td><?php echo date("d F, Y",strtotime($data->created)) ?></td>
                                       <td><?php echo $data->client->name ?></td>
                                       <?php
                                       $typeColor = '' ;
                                       switch ($data->status){
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

                                       if( $data->payment_status == 1){
                                           $paycolor = 'success' ;
                                           $paymentStatus = 'Paid';
                                       }else{
                                           $paycolor = 'danger' ;
                                           $paymentStatus = 'Unpaid';
                                       }
                                       ?>
                                       <td><span class="label label-<?php echo $paycolor ?>"><?php echo $paymentStatus ?></span></td>
                                       <td><span class="label label-<?php echo $typeColor ?>"><?php echo $data->status ?></span></td>
                                       <td><a class="btn btn-default btn-sm" href="<?php echo URL . '/admin/bookings/'.$data->code ?>">View</a></td>
                                   </tr>
                               <?php } ?>
                           <?php }else{ ?>
                               <tr><td colspan="6" align="center">No Bookings Yet</td></tr>
                           <?php  }?>

                           </tbody>
                       </table>
                   </div>
               </div>
           </div>
       </div>

       <script>
           $(function(){
             if(bookingsTable) {
               $("#history").DataTable();
             }
           });
       </script>
