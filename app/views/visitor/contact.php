
<div class="clearfix"></div>

<!-- Contant
======================================= -->

<div class="container">

    <div class="content_fullwidth">

        <div class="one_half">
            <br />
            <h3>Contact <strong>Form</strong></h3>

            <form class="contactForm">

                <fieldset>

                        <label for="name" class="blocklabel">Your Name*</label>
                        <p class="" ><input name="name" class="input_bg req" type="text" /></p>

                        <label for="email" class="blocklabel">E-Mail*</label>
                        <p class="" ><input name="email" class="input_bg req" type="text" /></p>

                        <label for="message" class="blocklabel">Your Message*</label>
                        <p class=""><textarea name="message" class="textarea_bg req"  cols="20" rows="7" ></textarea></p>
                    <p>
                        <div class="clearfix"></div>
                        <input type="submit" value="SUBMIT" class="comment_submit" id="send"/></p>

                </fieldset>

            </form>

        </div>

        <div class="one_half last">

            <div class="address-info">
                <h3>Address <strong>Info</strong></h3>
                <ul>
                    <li>
                        <strong><?php echo SITENAME ?></strong><br />
                        <strong>Office Address:</strong> <?php echo SITE_ADDRESS ?><br />
                        <strong>Factory Address:</strong> <?php echo SITE_ADDRESS_2 ?><br />
                        Telephone: <?php echo CONTACT_PHONE ?><br />
                        E-mail: <a href="<?php echo CONTACT_EMAIL ?>"><?php echo CONTACT_EMAIL ?></a><br />
                        Website: <a href="<?php echo URL ?>"><?php echo URL ?></a>
                    </li>
                </ul>
            </div>



        </div>

    </div>

</div><!-- end content area -->


<div class="clearfix mar_top10"></div>

<script type="text/javascript">
    $(document).ready(function(){
        var link = $("#tiny").find(".contact");
        var form = $(".contactForm") ;

        link.addClass("active");

        form.on("submit", function(e){
            e.preventDefault();
            var $this = $(this);
            $this.find(".req").each(function(){
                if( $(this).val().length < 2 ){
                    alert("please enter " + $(this).attr("name"));
                    exit();
                }
            }); // end of loop checking

            $.post( URL + "/contact/enquiry", $this.serialize() , function(data){
                if(data.status == true){
                    alert("Your message has been sent successfully");
                    $this.find(".req").val("");
                }else{
                    alert("Message Sending Failed, please try again later");
                }
            });

        });
    });
</script>
