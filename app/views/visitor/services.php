
<style type="text/css">
    .get_features_list p{
        visibility: hidden;
    }
</style>

<div class="clearfix"></div>

<!-- Contant
======================================= -->

<div class="container">

<div class="content_fullwidth">

    <div class="one_full">
    <div class="big_text1">
        We strive to leave our customers satisfied at all times by treating your clothes to an impeccable finish. Why not put us to test today by trying one or more of our range of services:
    </div>
    </div>

    <div class="clearfix divider_line2"></div>

<div class="get_features">

    <div class="one_third">

        <ul class="get_features_list">
            <li class="left"><i class="fa fa-check fa-2x"></i></li>
            <li class="right">
                <h5>PROFESSIONAL DRY CLEANING</h5>
                <p>Lorem lpsum simply dummy typesetting industry ever.</p></li>
        </ul>

        <ul class="get_features_list">
            <li class="left"><i class="fa fa-check fa-2x"></i></li>
            <li class="right">
                <h5>PRESSING ONLY</h5>
                <p>Lorem lpsum simply dummy typesetting industry ever.</p></li>
        </ul>


    </div>

    <div class="one_third">

        <ul class="get_features_list">
            <li class="left"><i class="fa fa-check fa-2x"></i></li>
            <li class="right">
                <h5>HOUSE-HOLD DRY CLEANING</h5>
                <p>Lorem lpsum simply dummy typesetting industry ever.</p></li>
        </ul>

        <ul class="get_features_list">
            <li class="left"><i class="fa fa-check fa-2x"></i></li>
            <li class="right">
                <h5>EXPERT STAIN REMOVAL</h5>
                <p>Lorem lpsum simply dummy typesetting industry ever.</p></li>
        </ul>

    </div>

    <div class="one_third last">

        <ul class="get_features_list">
            <li class="left"><i class="fa fa-check fa-2x"></i></li>
            <li class="right">
                <h5>DOOR-STEP PICKUP</h5>
                <p>Lorem lpsum simply dummy typesetting industry ever.</p></li>
        </ul>

        <ul class="get_features_list">
            <li class="left"><i class="fa fa-check fa-2x"></i></li>
            <li class="right">
                <h5>DOOR-STEP DELIVERY</h5>
                <p>Lorem lpsum simply dummy typesetting industry ever.</p></li>
        </ul>


    </div>

</div>

<div class="clearfix divider_line"></div>

    <?php if(isset($this->specials)){ ?>
        <div class="one_full">
            <h2><strong>Special</strong> Offers</h2>
            <div class="one_full">
                <ul class="list1">
                    <?php foreach($this->specials as $special){ ?>
                        <li><i class="fa fa-angle-double-right"></i><?php echo $special->offer ?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    <?php } ?>



</div>

    <center>
        <a href="<?php echo URL ?>/data/downloads/pricelist.pdf" class="but_thumbs_down"><i class="fa fa-download fa-lg"></i> Download our Price List</a>
    </center>
</div><!-- end content area -->


<div class="clearfix mar_top10"></div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#tiny .services").addClass("active");
    });
</script>
