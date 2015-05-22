

<style type="text/css">
    #offerTable thead{
        text-transform: uppercase;
        text-align: center;
        border: none;
        font-weight: bold;
    }

    #offerTable tbody tr td:nth-child(2){
        text-align: right;
    }
</style>

<div class="container">
    <div class="row">

        <!--List of special offers-->
        <div class="col-md-5 col-md-offset-2">
            <table id="offerTable" class="table table-condensed table-hover">
                <?php  if( $this->offers !== null ){ ?>
                   <thead><tr><td>Special Offers</td><td></td></tr></thead>
                    <tbody>
                    <?php foreach($this->offers as $offer){ ?>
                        <tr>
                            <td><?php print $offer->offer ?></td>
                            <td><a data-offer-id="<?php print $offer->offer_id ?>" class="btn btn-danger remove btn-xs"><i class=" glyphicon glyphicon-remove"></i></a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                <?php   }else{ ?>
                    <thead><tr><td>Special Offers</td><td></td></tr></thead>
                <?php } ?>
            </table>
        </div>


        <!-- Add New Special offer form-->
    <div class="col-md-5" >
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title"><strong>New Special Offer </strong></h3></div>
            <div class="panel-body">
                <form role="form" id="addForm">
                    <div class="form-group">
                        <textarea id="offerContent" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-block btn-default">Post</button>
                </form>
            </div>
        </div>
    </div>

         </div>
        </div>
<!--row end-->

<script type="text/javascript">
    $(document).ready(function(){
        var Table = $("#offerTable") ;
        var form = $("#addForm");
        var content = $("#offerContent") ;
        var oTable = Table.DataTable({});
        var removeBtn = ".remove";

        /* Delete an offer */
        $('body').on('click', removeBtn , function(e){
            e.preventDefault();
            var verify = confirm("sure you want to delete this offer ?");
            if(verify === true){
            var $this = $(this);
            var offer_id = $this.attr("data-offer-id") ;
            $.ajax({
                url: URL + '/service/admin/special_offer/delete/' + offer_id ,
                type: 'delete',
                success: function(data){
                    if(data.status == false){
                        alert(data.result);
                    }else{
                        oTable.row( $this.parents('tr') )
                            .remove()
                            .draw();
                    }
                }
            });
        }
        });

        /* Add new offer */
        form.on("submit", function(e){
            e.preventDefault();
            if(content.val().length < 10){
                alert("Special offer can't be less than 10 characters");
            }else{
                var postData = { 'offer' : $.trim(content.val()) } ;
                $.post(URL + '/service/admin/special_offer/new' , postData , function(data){
                    if(data.status == true){
                        newTableEntry(data.result,$.trim(content.val()));
                        content.val("");
                    }else{
                        alert(data.result);
                    }
                });
            }
        });

        /* Add new entry to dataTable */
        var newTableEntry = function(offer_id,message){
            var HTML =  "<a data-offer-id='"+ offer_id +"' class='btn btn-danger remove btn-xs'>" ;
                HTML += "<span class='glyphicon glyphicon-remove'></span></a>" ;
            oTable.row.add([ message , HTML ]).draw();
        };

    });
</script>