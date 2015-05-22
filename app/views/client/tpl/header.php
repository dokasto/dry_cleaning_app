<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $this->title ?></title>
        <meta name="description" content="<?php echo $this->description ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="<?php echo URL .  '/public/client/' ?>css/bootstrap.min.css">
        
        <link rel="stylesheet" href="<?php echo URL .  '/public/client/' ?>css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="<?php echo URL .  '/public/client/' ?>css/main.css">

        <!--[if lt IE 9]>
            <script src="<?php echo URL .  '/public/client/' ?>js/vendor/html5-3.6-respond-1.1.0.min.js"></script>
        <![endif]-->

        <script>window.jQuery || document.write('<script src="<?php echo URL . '/public/client/' ?>js/vendor/jquery-1.11.0.min.js"><\/script>')</script>

        <script src="<?php echo URL . '/public/client/' ?>js/vendor/bootstrap.min.js"></script>

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

        <link rel="shortcut icon" href="<?php echo URL ?>/public/admin/img/culmeni.png">

        <script src="<?php echo URL . '/public/admin/' ?>js/datatables.min.js"></script>
        <script src="<?php echo URL . '/public/admin/' ?>js/datatables-bootstrap.js"></script>

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
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="<?php echo URL .  '/public/client/' ?>http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <div class="navbar navbar-inverse" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo URL .  '/client' ?>">Culmen Dry Cleaners</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dashboard"><a href="<?php echo URL .  '/client/' ?>">Dashboard</a></li>
        <li class="feedback"><a href="<?php echo URL .  '/client/' ?>feedback">Feedback</a></li>
        <li class="profile"><a href="<?php echo URL .  '/client/' ?>profile">Profile </a></li>
        <li class="settings"><a href="<?php echo URL .  '/client/' ?>settings">Settings  </a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
          <li><a href="<?php echo URL .  '/client/' ?>logout">Sign-out </a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</div>