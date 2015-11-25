<?php
if(isset($this->data)){
    $bookings = $this->data;
    unset($this->data);
}
?>

 <style type="text/css">
            body {
                padding-top: 0px;
                padding-bottom:0px;
            }
  </style>
    <div class="container">
      <!-- Example row of columns -->

      <div class="container">
	<div class="row">
		<div class="col-md-12" style="padding-bottom:80px;">
    <legend>Dashboard</legend>
    <div class="panel panel-info">
    <div class="panel-heading">
       <h4 class="panel-title "><span class="text-muted">Booking History</span></h4>
       </div>
            <table id="bookingsTable" class="table table-striped table-condensed">
                  <thead>
                  <tr>
                      <th>Transaction ID</th>
                      <th>Date</th>
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
                            <td><a class="btn btn-default btn-sm" href="<?php echo URL . '/client/booking/'.$data->code ?>">View</a></td>
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

</div> <!-- /container -->

 <script type="text/javascript">
     $(document).ready(function(){
       try {
         $("#bookingsTable").DataTable();
       } catch (e) {
         console.log(e);
       }
      $(".navbar").find(".dashboard").addClass("active") ;
     });
 </script>
