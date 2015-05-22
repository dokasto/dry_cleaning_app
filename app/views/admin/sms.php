



<div class="container">
    <div class="row">

    <div class="col-md-6 col-md-offset-4" >
    
        <div class="well" style=>
        <form role="form" class="smsForm">
  <div class="form-group">
        <label><i class="glyphicon glyphicon-edit"></i> Compose Message</label>
      <span class="label label-primary" id="counter"  style="float: right">count</span>
           <textarea maxlength="320" placeholder="Enter your message here" style="font-size:20px; font-family:sanserif;" class="form-control" id="message" rows="6"></textarea>
           </div>
            <button class="btn btn-success btn-block"><i class="glyphicon glyphicon-envelope"></i> Send Bulk SMS</button>
           </form>
        </div>
      </div>

      


</div>
</div>

<!--row end-->

<script type="text/javascript">
    $(document).ready(function(){
        var form = $(".smsForm");
        var textarea = $("#message");
        var counter = $("#counter");

        function countWords(){
            var total = $(this).val().length ;
            counter.text(total);
        }

        /* count words */
        textarea.on('keyup mouseout focus',countWords);

        /* Send SMS */
        form.on("submit", function(e){
            e.preventDefault();
            if(textarea.val().length < 5){
                alert("Please enter a valid message") ;
            }else{
                var postData = { 'message' : $.trim(textarea.val()) } ;
                $.post(URL + '/service/admin/sms', postData , function(data){
                    if(data.status == true){
                        textarea.val("");
                        alert("Your message has been sent successfully !");
                    }else{
                        alert(data.result);
                    }
                });
            }
        });

    });
</script>










