<script type="text/javascript" src="<?php echo URL ?>/public/client/js/jquery.form.min.js"></script>

<?php $client = new ArrToObj($this->client)  ?>

<?php
$picture = URL . '/public/client/img/default.jpg' ;
if(strlen( $client->picture ) > 5 ){
    $picture = URL . '/data/profiles/' . $client->picture ;
}

?>

   <div class="container"> 
      <div class="row" style="margin-top:30px;">
      <div class="panel panel-info">
        <div class="panel-heading text-center"><strong class="h3" id="text">My Profile</strong></div>
      </div>
      <div class="panel panel-default">
      <div class="panel-body">

 <form class="form-horizontal col-md-4" id="uploadForm" role="form">
          <fieldset class="col-md-offset-3"> 
             <div class="form-group">
     <p><img src="<?php echo $picture ?>" width="100px" alt="" style="background:#eee; margin-left:90px;" class="img-circle img-responsive" /></p>
    <input type="file" id="pictureFile" name="picture" class="btn btn-primary" >
    <input type="hidden" name="client_id" value="<?php echo $client->client_id ?>" />
    <p class="help-block">Change profile picture</p>
  </div>
              </fieldset>
              </form>


        <form class="form-horizontal col-md-8" id="profileForm" role="form">
          <fieldset>
              <div class="form-group"> 
                <label class="col-sm-3 control-label" for="card-holder-name">Name</label> 
                <div class="col-sm-9"> 
                  <input type="text" class="form-control req" name="name" value="<?php echo $client->name ?>" placeholder="name">
                   </div> 
              </div> 
              <div class="form-group"> 
                        <label class="col-sm-3 control-label" for="card-number">Address</label> 
                        <div class="col-sm-9"> 
                          <input type="text" class="form-control req" name="address" value="<?php echo $client->address ?>" placeholder="address">
                        </div> 
                      </div> 
                        <div class="form-group"> 
                            <label class="col-sm-3 control-label" for="cvv">Phone</label>
                              <div class="col-sm-3"> 
                              <input type="text" class="form-control req" name="phone" value="<?php echo $client->phone ?>"placeholder=" ">
                              </div> 
                          </div>
                      <div class="form-group"> 
                        <label class="col-sm-3 control-label" for="card-number">Email</label> 
                        <div class="col-sm-9"> 
                          <input type="text" name="email" class="form-control req" value="<?php echo $client->email ?>" />
                        </div> 
                      </div>
                        
             <input type="hidden" name="client_id" value="<?php echo $client->client_id ?>" />
                            
          </fieldset>
          <div class="form-group">
                              <div class="col-sm-offset-4 col-sm-4">
               <button type="button" id="btnEdit" class="btn btn-primary">
                   <span class="glyphicon glyphicon-pencil"></span> Edit</button>

               <button type="submit" id="btnSave" class="btn btn-success">
                   <span class="glyphicon glyphicon-floppy-disk"></span> Save</button>

                <button type="button" id="btnCancel" class="btn"> cancel</button>

                              </div>
                              </div>
        </form>
    </div>
    </div>

        </div> <!--row-->

      </div><!--container-->
       <style>
            body {
                padding-top: 0px;
                padding-bottom:0px;
            }
            #text{
              color:#000;
            }
           
        </style>

<script type="text/javascript">
    $(document).ready(function(){
        var options = {
            success:       showResponse,  // post-submit callback
            url:       URL + '/service/client/update/image' ,
            type:      'post',
            dataType:  'json',
            clearForm: true
        };

        $('#pictureFile').on('change', function(e){
            e.preventDefault();
            $("#uploadForm").ajaxSubmit(options);
        });

    // post-submit callback
    function showResponse(responseObj, statusText, xhr, $form)  {
        if(responseObj.status == true){
            var image = URL + "/data/profiles/" + responseObj.result ;
            $(".img-circle").attr('src' , image);
        }else{
            alert(responseObj.result);
        }
    }

           $(".navbar").find(".profile").addClass("active") ;
           var profileForm = $("#profileForm");
           var cancelBtn = $("#btnCancel") ;

        function editOn(){
            $("#profileForm").find("fieldset").removeAttr("disabled");
            $("#btnSave").show();
            cancelBtn.show();
            $("#btnEdit").hide();
        }

        function editOff(){
            profileForm.find("fieldset").attr("disabled","disabled");
            $("#btnSave").hide();
            cancelBtn.hide();
            $("#btnEdit").show();
        }


        editOff(); // turn off edit

           /* Bind edit button event */
           $("#btnEdit").on("click", function(e){
               e.preventDefault();
               editOn();
           });

           /* bind cancel button event */
         cancelBtn.on("click", function(e){
             e.preventDefault();
             editOff();
         });

           profileForm.on('submit', function(e){
               e.preventDefault();
               var $this = $(this);
               $this.find(".req").each(function(){
                   if( $(this).val().length < 2 ){
                       alert("please enter " + $(this).attr("name"));
                       exit();
                   }
               }); // end of loop checking

               $.post( URL + "/service/client/update/profile", $this.serialize() , function(data){
                   if(data.status == true){
                       editOff();
                       alert("Your profile has been update successfully");
                   }else{
                       alert(data.result);
                   }
               });

           });

       });
   </script>
