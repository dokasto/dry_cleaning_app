
$.ajaxSetup({
    type: 'POST',
    timeout: 1000000,
    cache: false
});

function showOverlay() {
    var ov = $("#bodyOverlay");
    var pos = ov.offset();
    var doc = $(document);
    ov.css({
        left: pos.left + 'px',
        top: pos.top + 'px',
        width: 0,
        height: 0
    })
            .show()
            .animate({
                left: 0,
                top: 0,
                width: '100%',
                height: '100%'
            }, 10);

}

function Ajax_Error(jqXHR){
    var alerts ;
    if (jqXHR.status === 0) {
        alerts = 'Not connected Verify Network.' ;
    } else if (jqXHR.status == 404) {
        alerts = 'Requested page not found. [404]';
    } else if (jqXHR.status == 500) {
        alerts = 'Internal Server Error [500].';
    } else if (exception === 'parsererror') {
        alerts = 'Requested JSON parse failed.';
    } else if (exception === 'timeout') {
        alerts = 'Time out error.';
    } else if (exception === 'abort') {
        alerts = 'Ajax request aborted';
    } else {
        alerts = 'Uncaught Error.\n' + jqXHR.responseText ;
    }
    return alerts ;
}

//Validate email address check
function valid_email(email){
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(email);
}


//Validate interger value input
function isInt(n){
    var reInt = new RegExp(/^-?\d+$/);
    if (!reInt.test(n)) {
        return false;
    }
}

/* Custom alert dialog */
function alert(msg){
    showOverlay();
    $(".loading").hide();
    $(".alertDialog").show().find("span").html(msg) ;
}


$(function(){

    $.ajaxSetup({
        type: 'POST',
        timeout: 1000000,
        cache: false
    });


    /* Ajax loading effect */
    $(document).ajaxStart(function(){
        showOverlay();
        $(".loading").fadeIn("fast");
    }).ajaxStop(function() {
        $(".loading").hide();
        $("#bodyOverlay").hide();
    });

    $(".alertDialog a").click(function(e){
        e.preventDefault();
        $("#bodyOverlay").hide();
        $(".alertDialog").hide();
        $(".loading").hide();
    });

});
