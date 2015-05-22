

   <div class="container">
   <div class="row">
     <div class="well">
      <span class="h3">Feed-Back Form</span>
     </div>
   </div> 
   <div class="row">
     <div class="panel panel-default" style="margin-top:20px;">
     <div class="panel-body">
     <div class="row" style="margin-bottom:20px;margin-top:20px;">
      <div class="col-md-8 col-md-offset-2">
        <div class="well">
        <form id="feedbackForm" role="form">
          <div class="form-group">
    <div class="input-group">
      <div class="input-group-addon" style="font-size:20px; font-family:sanserif;">Subject :</div>
      <input class="form-control req" name="subject" style="font-size:20px; font-family:sanserif;" type="text" placeholder="">
    </div>
  </div>
  <div class="form-group">
         <label for="exampleInputEmail1">Message</label>
           <textarea style="font-size:20px; font-family:sanserif;" class="form-control req" name="message" id="txtarea" rows="4"></textarea>
           </div>
           

        </div>

          <input type="hidden" name="client_id" value="<?php echo $this->client_id ?>" />

        <div class="form-group">
        <div class="col-md-3 col-md-offset-4">
             <button class="btn btn-success btn-block" type="submit">SEND</button>
           </div>
           </div>
           </form>
      </div>
      </div>
      </div> 
     </div>
      </div><!--container-->
     <style>
            body {
                padding-top: 0px;
                padding-bottom:0px;
                background-color: #eee
            }
             #txtarea{
              resize:none;
            }
           
        </style>


       <script type="text/javascript">
           $(document).ready(function(){
               $(".navbar").find(".feedback").addClass("active") ;

               /* feedback form */
               $("#feedbackForm").on('submit', function(e){
                   e.preventDefault();
                   var $this = $(this);
                   $this.find(".req").each(function(){
                       if( $(this).val().length < 2 ){
                           alert("please enter " + $(this).attr("name"));
                           exit();
                       }
                   }); // end of loop checking

                   $.post( URL + "/service/client/feedback", $this.serialize() , function(data){
                       if(data.status == true){
                           alert("Your feedback has been sent and will be duly noted");
                           $this.find(".req").val("");
                       }else{
                           alert("Sending Failed, please try again later");
                       }
                   });

               });

           });
       </script>
