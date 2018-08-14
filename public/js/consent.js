jQuery(document).ready(function($){

    if ($.cookie('UFC_CA') != 'true') {
        $("#consent-notice").show();
        $(".ufc-comments").hide();
        $("#poweredby").hide();
        $("#fbc-comments-text").hide();
        $("#fbc-comments-div").hide();
        //$("#policy").hide();
        //alert('The paragraph was clicked.');
    }

    $("#ufc-accept").click(function() {
        $("#consent-notice").slideUp();
        $(".ufc-comments").show();
        $("#poweredby").show();
        $("#fbc-comments-text").show();
        $("#fbc-comments-div").show();
        $.cookie('UFC_CA', 'true', {expires: 365 });
        //alert('The paragraph was clicked.');
        //console.log( "ready!" );
    });

    $("#ufc-decline").click(function() {
        $("#consent-notice").slideUp();
    });

});