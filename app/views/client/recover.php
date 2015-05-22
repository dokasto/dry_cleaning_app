<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../../../public/client/css/bootstrap.min.css">
        <style>
            body {
                padding-top: 0px;
                padding-bottom: 20px;
                background-color:  #2c3037;
            }
        </style>
        <link rel="stylesheet" href="../../../public/client/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="../../../public/client/css/main.css">

        <!--[if lt IE 9]>
        <script src="../../../public/client/js/vendor/html5-3.6-respond-1.1.0.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
   


    <div class="container">
      <!-- Example row of columns -->
             <div class="container">    
        <div id="loginbox" style="margin-top:100px;" class="mainbox col-md-5 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-danger" >
                    <div class="panel-heading">
                        <div class="panel-title">Reset Password</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="login.php">Sign in</a></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            <p class="text-center">Your password will be sent to the following email</p>
                        <form id="loginform" class="form-horizontal" role="form">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="Enter email">                                        
                                    </div>
                                
                           

                                
                           


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                      <a id="btn-login" href="#" class="btn btn-block btn-danger">Reset</a>

                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                         
                                        <a href="signup.php">
                                            Sign up here
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
        <script>window.jQuery || document.write('<script src="../../../public/client/js/vendor/jquery-1.11.0.min.js"><\/script>')</script>

        <script src="../../../public/client/js/vendor/bootstrap.min.js"></script>

        <script src="../../../public/client/js/main.js"></script>

        
    </body>
</html>
