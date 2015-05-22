
        <style>
            body {
                padding-top: 0px;
                padding-bottom:0px;
            }
            #text{
              color:#000;
            }
           
        </style>
      

    <div class="container">
      <!-- Example row of columns -->
   <div class="container"> 
   <div class="row">
   </div>
   <div class="row" style="margin-top:40px">
   <div class="col-md-8 col-md-offset-2">
   <div class="panel panel-default">
        <div class="panel-heading text-center"><strong class="h3" id="text">Change Password</strong></div>
      </div>
   <div class="well">
        <form class="form-horizontal col-md-offset-2" method="POST" id="form" role="form">
          <fieldset> 
        
              <div class="form-group"> 
                <label class="col-sm-3 control-label" for="card-holder-name">Old Password</label> 
                <div class="col-sm-5"> 
                  <input type="password" class="form-control req" name="oldPassword" placeholder="Password">
                   </div> 
              </div>

               <div class="form-group"> 
                <label class="col-sm-3 control-label" for="card-holder-name">New Password</label> 
                <div class="col-sm-5"> 
                  <input type="password" class="form-control req" id="pswd1" placeholder="Password">
                   </div> 
              </div>

              <input type="hidden" name="client_id" value="<?php echo $this->client_id ?>" />

               <div class="form-group"> 
                <label class="col-sm-3 control-label" for="card-holder-name">Confirm Password</label> 
                <div class="col-sm-5"> 
                  <input type="password" class="form-control req" id="pswd2" name="newPassword"  placeholder="Password">
                   </div> 
              </div>

              <div class="col-md-3 col-md-offset-4">
                  <p>
                      <button type="submit" class="btn btn-success btn-block btn-sm">Save</button>
                  </p>
              </div>

              
              </fieldset>
              </form>
              </div>

              </div>
              </div>
              </div>
      

       </div><!--container-->

        <script type="text/javascript">
            $(document).ready(function(){
                $(".navbar").find(".settings").addClass("active") ;

                $("#form").on('submit', function(e){
                    e.preventDefault();
                    var $this = $(this);
                    $this.find(".req").each(function(){
                        if( $(this).val().length < 2 ){
                            alert("some fields are empty!");
                            exit();
                        }
                    }); // end of loop checking

                    if( $("#pswd1").val() != $("#pswd2").val() ){
                        alert("passwords do not match");
                        exit();
                    }

                    $.post( URL + "/service/client/update/password", $this.serialize() , function(data){
                        if(data.status == true){
                            $(".req").val("");
                            alert("new password has been saved");
                        }else{
                            alert(data.result);
                        }
                    });

                });

            });
        </script>


