<style>
    .custab{
        border: 1px solid #ccc;
        padding: 5px;
        margin: 5% 0;
        box-shadow: 3px 3px 2px #ccc;
        transition: 0.5s;
    }
    .custab:hover{
        box-shadow: 3px 3px 0px transparent;
        transition: 0.5s;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-9 col-md-offset-2" >
        <table id="clientsTable" class="table table-striped custab">
            <legend>Registered Clients</legend>
            <thead>

            <tr>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Action</th>
            </tr>

            </thead>
            <?php if(isset($this->clients )) { ?>
            <?php foreach($this->clients as $client){ ?>
            <tr>
                <td><strong><a href=<?php echo "'".URL . '/admin/clients/'.$client->client_id."'><i class='glyphicon glyphicon-user'></i> " . $client->name ; ?></a></strong></td>
                <td><?php echo $client->phone ?></td>
                <td><?php echo $client->email ?></td>
                <td><a class="btn btn-warning btn-xs" href="./bookings/<?php echo $client->client_id ?>/new"><i class="glyphicon glyphicon-folder-open"></i> &nbsp;Book new</a></td>
            </tr>
            <?php } ?>
            <?php } ?>

        </table>
    </div>
    </div>
</div>

   <script type="text/javascript">
       $(document).ready(function(){
           $("#clientsTable").DataTable();
       });
   </script>



   
      
  

