<?php
       if(isset($this->data)){
           $bookings = $this->data;
           unset($this->data);
       }
?>

<script>
var bookingsTable = false;
</script>

     <div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-1" >
            <div class="panel panel-primary" style="margin-left:23px;margin-top:-5px;">
                <div class="panel-heading"><span class="h4 text-center" >All Transactions</span></div>

                <div class="panel-body">
                  <table id="bookingsTable" class="table table-striped table-condensed">
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
                <?php if(isset($bookings)){ echo "<script> bookingsTable = True; </script>";?>
                    <?php foreach($bookings as $data){ ?>
                  <tr>
                  <td><?php echo $data->code ?></td>
                  <td><?php echo date("d F, Y",strtotime($data->created)) ?></td>
                  <td><a href=<?php echo "'".URL . '/admin/clients/'.$data->client->client_id."'>" . $data->client->name ; ?></a></td>
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
                    <tr><td>No Bookings Yet</td></tr>
                <?php  }?>

                  </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
      if(bookingsTable) {
        $("#bookingsTable").DataTable();
      }
    });
</script>
