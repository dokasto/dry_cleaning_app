
<!-- Footer
======================================= -->

<div class="carve_graph_03"></div>

<div class="footer">

    <div class="container">

        <div class="one_fourth">

            <div class="footer_logo"><img width="150px" src="<?php echo URL ?>/public/admin/img/culmenii.png" alt="" /></div><!-- end footer logo -->

            <ul class="contact_address">
                <li><i class="fa fa-map-marker fa-lg"></i>
                    &nbsp; <strong>Office Address</strong><br>
                    &nbsp;&nbsp; Shop 1, Block 3, <br>
                    &nbsp;&nbsp; Bishop Oluwole Steet, <br>
                    &nbsp;&nbsp; Victoria Island, Lagos</li>

                <li><i class="fa fa-map-marker fa-lg"></i>
                    &nbsp; <strong>Factory Address</strong><br>
                    &nbsp;&nbsp; No 41, Abel Abayomi Steet, <br>
                    &nbsp;&nbsp; Harmony Estate, <br>
                    &nbsp;&nbsp; Ajah, Lagos</li>

            </ul>

        </div><!-- end address section -->

        <div class="one_fourth">

            <h2><i>HOT</i> lines</h2>

            <ul class="list">
                <li><i class="fa fa-phone"></i>&nbsp; 08181953938</li>
                <li><i class="fa fa-phone"></i>&nbsp; 08088400566</li>
                <li><i class="fa fa-phone"></i>&nbsp; 01-2904111</li>
            </ul>

        </div><!-- end useful links -->

        <div class="one_fourth">

            <h2><i>Quick</i> Links</h2>

            <ul class="list">
                <li><a href="<?php echo URL ?>">Home</a></li>
                <li><a href="<?php echo URL ?>/about">About Us</a></li>
                <li><a href="<?php echo URL ?>/services">Services</a></li>
                <li><a href="<?php echo URL ?>/contact">Contact us</a></li>
                <li><a href="<?php echo URL ?>/client/login">Login</a></li>
                <li><a href="<?php echo URL ?>/client/register">Register</a></li>
            </ul>


        </div><!-- end tweets -->


        <div class="one_fourth last">

            <h2>Legal</h2>

            <p>Culmen is a member of the Drycleaning & Laundry
               Institute (DLI), a premier international trade
               association for garment care professionals since 1883</p>


        </div><!-- end flickr -->

    </div>

</div>

<div class="clearfix"></div>

<div class="copyright_info">

    <div class="container">

        <div class="one_half">

            <b>Copyright &copy; <?php echo date("Y") ?> <?php echo SITENAME ?>. All rights reserved.</b>

        </div>

        <div class="one_half last">

            <ul class="footer_social_links">
                <li><a href="<?php echo SOCIAL_FACEBOOK ?>"><i class="fa fa-facebook"></i></a></li>
                <li><a href="<?php echo SOCIAL_TWITTER ?>"><i class="fa fa-twitter"></i></a></li>
                <li><a href="<?php echo SOCIAL_GOOGLE ?>"><i class="fa fa-google-plus"></i></a></li>
            </ul>

        </div>

    </div>

</div><!-- end copyright info -->

<a href="#" class="scrollup">Scroll</a><!-- end scroll to top of the page-->



</div>
</div>


<!-- ######### JS FILES ######### -->


<!-- style switcher -->
<script src="<?php echo URL ?>/public/visitor/js/style-switcher/jquery-1.js"></script>
<script src="<?php echo URL ?>/public/visitor/js/style-switcher/styleselector.js"></script>

<!-- main menu -->
<script type="text/javascript" src="<?php echo URL ?>/public/visitor/js/mainmenu/ddsmoothmenu.js"></script>
<script type="text/javascript" src="<?php echo URL ?>/public/visitor/js/mainmenu/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo URL ?>/public/visitor/js/mainmenu/selectnav.js"></script>

<!-- jquery jcarousel -->
<script type="text/javascript" src="<?php echo URL ?>/public/visitor/js/jcarousel/jquery.jcarousel.min.js"></script>

<!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
<script type="text/javascript" src="<?php echo URL ?>/public/visitor/js/revolutionslider/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
<script type="text/javascript" src="<?php echo URL ?>/public/visitor/js/revolutionslider/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

<script type="text/javascript" src="<?php echo URL ?>/public/visitor/js/mainmenu/scripts.js"></script>

<!-- scroll up -->
<script type="text/javascript">
    $(document).ready(function(){

        $(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
                $('.scrollup').fadeIn();
            } else {
                $('.scrollup').fadeOut();
            }
        });

        $('.scrollup').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 500);
            return false;
        });

    });
</script>


<!-- accordion -->
<script type="text/javascript" src="<?php echo URL ?>/public/visitor/js/accordion/custom.js"></script>

<!-- REVOLUTION SLIDER -->
<script type="text/javascript">

    var revapi;

    jQuery(document).ready(function() {

        revapi = jQuery('.tp-banner').revolution(
            {
                delay:9000,
                startwidth:1170,
                startheight:620,
                hideThumbs:10,
            });

    });	//ready

</script>

<script type="text/javascript" src="<?php echo URL ?>/public/visitor/js/sticky-menu/core.js"></script>
<script type="text/javascript" src="<?php echo URL ?>/public/visitor/js/sticky-menu/modernizr.custom.75180.js"></script>



</body>
</html>
