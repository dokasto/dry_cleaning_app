<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $this->title ?></title>


        <link rel="stylesheet" media="all" href="<?php echo URL .  '/public/admin/' ?>css/bootstrap.min.css">
        <style>
            
            body { 
              padding-top:0px; 
              } 
              .black{
                color:#000;
              }
              #txtarea{
              resize:none;
            }
        </style>
        <link rel="stylesheet" media="all" href="<?php echo URL .  '/public/admin/' ?>css/bootstrap-theme.min.css">
        <link rel="stylesheet" media="all" href="<?php echo URL .  '/public/admin/' ?>css/main.css">
         <link rel="stylesheet" media="all" href="<?php echo URL .  '/public/admin/' ?>css/sidenav.css">

        <script>window.jQuery || document.write('<script src="<?php echo URL . '/public/client/' ?>js/vendor/jquery-1.11.0.min.js"><\/script>')</script>


        <!--[if lt IE 9]>
        <script src="<?php echo URL .  '/public/admin/' ?>js/vendor/html5-3.6-respond-1.1.0.min.js"></script>
        <![endif]-->

        <script src="<?php echo URL . '/public/client/' ?>js/main.js"></script>


        <script type="text/javascript">
            var URL = "<?php echo URL ?>";
        </script>

        <style type="text/css">
            .bodyOverlay {
                background-color: rgba(0, 0, 0, 0.5);
                color: #333;
                position: fixed;
                width: 100%;
                z-index: 900;
                height: 100%;
                top: 0px;
                display:none;
            }

            .alertDialog{
                display: none;
                z-index: 1000;
                position: fixed;
                background-color: #ffffff;
                width:97%;
                margin: 15% auto;
                left: 0;
                right: 0;
                max-width: 400px;
                border:1px solid #d9534f;
            }

            .alertDialog span{
                padding:10px;
                font-size: 18px;
                line-height: 30px;
                font-family: 'PT Sans Narrow', Calibri, 'Myriad Pro', Tahoma, Arial;
                display: block;
                text-align: center;

            }

            .alertDialog a{
                display: block !important;
                text-align: center;
                border-radius: 0 0 0 0 !important;
            }

            .loading{
                display: none;
                position: fixed;
                width: 200px;
                text-align: center;
                margin: 15% auto;
                left: 0;
                right: 0;
                z-index: 1200;
            }

            .but_phone{
                background-color: #843534;
                padding:5px;
                color: #fff;
            }
        </style>

        <script src="<?php echo URL . '/public/admin/' ?>js/datatables.min.js"></script>
        <script src="<?php echo URL . '/public/admin/' ?>js/datatables-bootstrap.js"></script>

        <link rel="shortcut icon" href="<?php echo URL ?>/public/admin/img/culmeni.png">

    </head>
    <body>
    <div id="bodyOverlay" name="bodyOverlay" class="bodyOverlay">
    </div>

    <div class="loading">
        <img src="<?php echo URL ?>/public/client/img/loading.gif" alt="Loading" />
    </div>

    <div class="alertDialog">
<span>
    this is an alert dialog
</span>
        <a href="#" class="but_phone"><i class="fa fa-times fa-lg"></i> close</a>

    </div>
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <div class="navbar navbar-inverse" style="" role="navigation">
   
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
       <a class="navbar-brand" style="margin-left:100px;" href=""></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="first navbar-collapse" id="bs-example-navbar-collapse-1">
    <!--<ul class="nav heading navbar-nav ">
      <li id="book"><a style="font-size:25px;margin-left:400px;font-family:cursive; display:none" href="">BOOKINGS</a></li>
        <li><a id="customer" style="font-size:25px;margin-left:400px;font-family:cursive;display:none" href="">CUSTOMERS</a></li>
          <li><a id="sms" style="font-size:25px;margin-left:400px;font-family:cursive;display:none" href="">BULK SMS</a></li>
            <li><a id="offers" style="font-size:25px;margin-left:400px;font-family:cursive;display:none" href="">SPECIAL OFFERS</a></li>
    </ul>-->
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" style="padding:20px;" data-toggle="dropdown">Settings<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo URL.'/admin' ?>/settings">Settings</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo URL.'/admin' ?>/logout"> Sign-out</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</div>

    <!-- Side Bar -->

        <div id="wrapper" class="active">
            <!-- Sidebar -->

            <div id="sidebar-wrapper">
                <a href="<?php echo URL.'/admin' ?>"><img width="220" height="62px" style="background:#fff;" src="<?php echo URL.'/public/admin/' ?>img/culmenii.png" alt="culmen"></a>
                <ul id="sidebar_menu" class="sidebar-nav">
                    <li class="sidebar-brand"><a id="menu-toggle" href="#">Menu<span id="main_icon" class="glyphicon glyphicon-align-justify"></span></a></li>
                </ul>
                <ul class="sidebar-nav" id="sidebar">
                    <li><a href="<?php echo URL.'/admin' ?>/bookings">Bookings<span class="sub_icon glyphicon glyphicon-book"></span></a></li>
                    <li><a href="<?php echo URL.'/admin' ?>/clients">Clients<span class="sub_icon glyphicon glyphicon-user"></span></a></li>
                    <li><a href="<?php echo URL.'/admin' ?>/special">Special Offers<span class="sub_icon glyphicon glyphicon-gift"></span></a></li>
                    <li><a href="<?php echo URL.'/admin' ?>/sms">Bulk SMS<span class="sub_icon glyphicon glyphicon-envelope"></span></a></li>

                </ul>
            </div>

        </div>