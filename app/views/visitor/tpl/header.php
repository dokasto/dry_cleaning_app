<!doctype html>
<!--[if IE 7 ]>    <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en-gb" class="no-js"> <!--<![endif]-->

<head>
    <title><?php echo $this->title ?></title>

    <meta charset="utf-8">
    <meta name="keywords" content="<?php echo $this->keywords ?>" />
    <meta name="description" content="<?php echo $this->description ?>" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo URL ?>/public/admin/img/culmenii.png">

    <!-- this styles only adds some repairs on idevices  -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google fonts - witch you want to use - (rest you can just remove) -->
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Open+Sans:400,800,700italic,700,600italic,600,400italic,300italic,300|Roboto:100,300,400,500,700&amp;subset=latin,latin-ext' type='text/css' />

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- ######### CSS STYLES ######### -->

    <link rel="stylesheet" href="<?php echo URL ?>/public/visitor/css/reset.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo URL ?>/public/visitor/css/style.css" type="text/css" />

    <link rel="stylesheet" href="<?php echo URL ?>/public/visitor/css/font-awesome/css/font-awesome.min.css">

    <!-- responsive devices styles -->
    <link rel="stylesheet" media="screen" href="<?php echo URL ?>/public/visitor/css/responsive-leyouts.css" type="text/css" />

    <!-- style switcher -->
    <link rel = "stylesheet" media = "screen" href = "js/style-switcher/color-switcher.css" />

    <!-- sticky menu -->
    <link rel="stylesheet" href="<?php echo URL ?>/public/visitor/js/sticky-menu/core.css">

    <!-- REVOLUTION SLIDER -->
    <link rel="stylesheet" type="text/css" href="<?php echo URL ?>/public/visitor/js/revolutionslider/rs-plugin/css/settings.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL ?>/public/visitor/js/revolutionslider/css/slider_main.css" media="screen" />

    <!-- jquery jcarousel -->
    <link rel="stylesheet" type="text/css" href="<?php echo URL ?>/public/visitor/js/jcarousel/skin2.css" />


    <!-- get jQuery from the google apis -->
    <script type="text/javascript" src="<?php echo URL ?>/public/visitor/js/universal/jquery.js"></script>

    <script type="application/javascript">
        var URL = "<?php echo URL ?>" ;
    </script>
</head>

<body>

<div class="wrapper_boxed">

    <div class="site_wrapper">


        <!-- HEADER -->
        <header id="header">

            <div id="trueHeader">

                <div class="wrapper">

                    <div class="container">

                        <!-- Logo -->
                        <div class="logo_main"><a href="<?php echo URL ?>" id="logo">
                                <img width="100px" src="<?php echo URL ?>/public/admin/img/culmeni.png" />
                        </a></div>

                        <!-- Menu -->
                        <div class="menu_main">

                            <nav id="access" class="access" role="navigation">

        <div id="menu" class="menu">
          <ul id="tiny">
                <li><a href="<?php echo URL ?>" class="home">Home</a></li>
                <li><a href="<?php echo URL ?>/about" class="about ">About Us</a></li>
                <li><a href="<?php echo URL ?>/services" class="services">Services</a></li>
                <li><a href="<?php echo URL ?>/contact" class="contact">Contact Us</a></li>
                <li>
                    <a href="Javascript:void()">Client Area <i class="fa fa-angle-down"></i></a>
                    <ul>
                    <li><a href="<?php echo URL ?>/client/login">Login</a></li>
                    <li><a href="<?php echo URL ?>/client/register">Sign Up</a></li>
                   </ul>
                </li>

            </ul>
        </div>

                            </nav>

                        </div><!-- end nav menu -->

                    </div>

                </div>

            </div>

        </header><!-- end header -->
   