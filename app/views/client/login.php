<style type="text/css">
    .navbar{
        display: none;
    }
</style>

    <div class="container">
      <!-- Example row of columns -->
         <div class="container">    
        <div id="loginbox" style="margin-top:120px;" class="mainbox col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2 ">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Sign In</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><!--<a href="<?php /*echo URL */?>/client/recovery">Forgot password?</a>--></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" class="form-control req" name="email" value="" placeholder="Enter Email">
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input type="password" class="form-control req" name="password" placeholder="Password">
                                    </div>
                                    

                                
                            <div class="input-group">
                                      <div class="checkbox">
                                        <label>
                                          <input type="checkbox" name="remember" value="1"> Remember me
                                        </label>
                                      </div>
                                    </div>


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                        <button type="submit" class="btn btn-info btn-block">Sign in</button>
                                     
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                            Don't have an account! 
                                        <a href="<?php echo URL ?>/client/register">
                                            Sign Up Here
                                        </a>
                                        </div>
                                    </div>
                                </div>    
                            </form>     



                        </div>                     
                    </div>  
        </div>
       

               
               
                
         </div> 
    </div>
     <!-- /container -->

<script type="text/javascript">
    $(document).ready(function(){

        $("#loginform").on('submit', function(e){
            e.preventDefault();
            var $this = $(this);
            $this.find(".req").each(function(){
                if( $(this).val().length < 2 ){
                    alert("please enter " + $(this).attr("name"));
                    exit();
                }
            }); // end of loop checking

            $.post( URL + "/service/client/login", $this.serialize() , function(data){
                if(data.status == true){
                    //alert("signup successful");
                    window.location = URL + '/client' ;
                }else{
                    alert(data.result);
                }
            });

        });

    });
</script>

