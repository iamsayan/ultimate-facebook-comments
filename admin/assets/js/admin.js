jQuery(document).ready(function ($) {

    $("#btn1").click(function () {
        $("#show-main").fadeIn("slow");
        $("#show-settings").hide();
        $("#show-display").hide();
        $("#show-title").hide();
        $("#show-notice").hide();
        $("#show-notification").hide();
        $("#show-others").hide();
        $("#show-shortcode").hide();
        $("#show-tools").hide();
        $("#show-help").hide();

    });

    $("#btn2").click(function () {
        $("#show-main").hide();
        $("#show-settings").fadeIn("slow");
        $("#show-display").hide();
        $("#show-title").hide();
        $("#show-notice").hide();
        $("#show-notification").hide();
        $("#show-others").hide();
        $("#show-shortcode").hide();
        $("#show-tools").hide();
        $("#show-help").hide();

    });

    $("#btn3").click(function () {
        $("#show-main").hide();
        $("#show-settings").hide();
        $("#show-display").fadeIn("slow");
        $("#show-title").hide();
        $("#show-notice").hide();
        $("#show-notification").hide();
        $("#show-others").hide();
        $("#show-shortcode").hide();
        $("#show-tools").hide();
        $("#show-help").hide();

    });

    $("#btn4").click(function () {
        $("#show-main").hide();
        $("#show-settings").hide();
        $("#show-display").hide();
        $("#show-title").fadeIn("slow");
        $("#show-notice").hide();
        $("#show-notification").hide();
        $("#show-others").hide();
        $("#show-shortcode").hide();
        $("#show-tools").hide();
        $("#show-help").hide();

    });

    $("#btn5").click(function () {
        $("#show-main").hide();
        $("#show-settings").hide();
        $("#show-display").hide();
        $("#show-title").hide();
        $("#show-notice").fadeIn("slow");
        $("#show-notification").hide();
        $("#show-others").hide();
        $("#show-shortcode").hide();
        $("#show-tools").hide();
        $("#show-help").hide();

    });

    $("#btn6").click(function () {
        $("#show-main").hide();
        $("#show-settings").hide();
        $("#show-display").hide();
        $("#show-title").hide();
        $("#show-notice").hide();
        $("#show-notification").fadeIn("slow");
        $("#show-others").hide();
        $("#show-shortcode").hide();
        $("#show-tools").hide();
        $("#show-help").hide();

    });

    $("#btn7").click(function () {
        $("#show-main").hide();
        $("#show-settings").hide();
        $("#show-display").hide();
        $("#show-title").hide();
        $("#show-notice").hide();
        $("#show-notification").hide();
        $("#show-others").fadeIn("slow");
        $("#show-shortcode").hide();
        $("#show-tools").hide();
        $("#show-help").hide();

    });

    $("#btn8").click(function () {
        $("#show-main").hide();
        $("#show-settings").hide();
        $("#show-display").hide();
        $("#show-title").hide();
        $("#show-notice").hide();
        $("#show-notification").hide();
        $("#show-others").hide();
        $("#show-shortcode").fadeIn("slow");
        $("#show-tools").hide();
        $("#show-help").hide();

    });

    $("#btn9").click(function () {
        $("#show-main").hide();
        $("#show-settings").hide();
        $("#show-display").hide();
        $("#show-title").hide();
        $("#show-notice").hide();
        $("#show-notification").hide();
        $("#show-others").hide();
        $("#show-shortcode").hide();
        $("#show-tools").fadeIn("slow");
        $("#show-help").hide();

    });

    $("#btn10").click(function () {
        $("#show-main").hide();
        $("#show-settings").hide();
        $("#show-display").hide();
        $("#show-title").hide();
        $("#show-notice").hide();
        $("#show-notification").hide();
        $("#show-others").hide();
        $("#show-shortcode").hide();
        $("#show-tools").hide();
        $("#show-help").fadeIn("slow");

    });

    var $select = $('select#post-types').selectize({
        plugins: ['remove_button'],
        delimiter: ',',
        placeholder: 'Select post types',
        persist: false,
        create: false
    });

    $('input#fbcn-email-receive').selectize({
        plugins: ['remove_button', 'restore_on_backspace', 'drag_drop'],
        persist: false,
        create: true,
        createOnBlur: true,
        delimiter: ',',
    });

    $('.ufc-color-picker').wpColorPicker();

    $(".coffee-amt").change(function() {
        var btn = $('.buy-coffee-btn');
        btn.attr('href', btn.data('link') + $(this).val());
    });
    $(".coffee-amt").trigger('change');
 
    $('#fb-comments-display').change(function() {
        if ($('#fb-comments-display').val() == 'replace_native_comment') {
            $('#replace-comments').show();
        }
        if ($('#fb-comments-display').val() != 'replace_native_comment') {
            $('#replace-comments').hide();
        }
        if ($('#fb-comments-display').val() == 'after_content') {
            $('#fb-comments-priority-span').show();
            $('#fb-comments-priority').attr('required', 'required');
        }
        if ($('#fb-comments-display').val() != 'after_content') {
            $('#fb-comments-priority-span').hide();
            $('#fb-comments-priority').removeAttr('required');
        }
        if ($('#fb-comments-display').val() == 'disable') {
            $('.fbc-post-types').hide();
        }
        if ($('#fb-comments-display').val() != 'disable') {
            $('.fbc-post-types').show();
        }
    });
    $('#fb-comments-display').trigger('change');

    $('#fbc-url').change(function() {
        if ($('#fbc-url').val() == 'custom_url') {
            $('#fbc-curl-show').show();
            $('#fbc-curl').attr('required', 'required');
        }
        if ($('#fbc-url').val() != 'custom_url') {
            $('#fbc-curl-show').hide();
            $('#fbc-curl').removeAttr('required');
        }
    });
    $('#fbc-url').trigger('change');

    $('#fb-comments-load').change(function() {
        if ($('#fb-comments-load').val() == 'on_click') {
            $('#fbc-on-click').show();
        }
        if ($('#fb-comments-load').val() != 'on_click') {
            $('#fbc-on-click').hide();
        }
    });
    $('#fb-comments-load').trigger('change');

    if ( location.href.match(/page\=ultimate-facebook-comments#main/ig) ) {

        $("#show-settings").hide();
        $("#show-display").hide();
        $("#show-title").hide();
        $("#show-notice").hide();
        $("#show-notification").hide();
        $("#show-others").hide();
        $("#show-shortcode").hide();
        $("#show-tools").hide();
        $("#show-help").hide();

    } else if ( location.href.match(/page\=ultimate-facebook-comments#settings/ig) ) {

        $("#btn1").removeClass("active");
        $("#btn2").addClass("active");
        $("#show-main").hide();
        $("#show-settings").show();
        $("#show-display").hide();
        $("#show-title").hide();
        $("#show-notice").hide();
        $("#show-notification").hide();
        $("#show-others").hide();
        $("#show-shortcode").hide();
        $("#show-tools").hide();
        $("#show-help").hide();

    } else if( location.href.match(/page\=ultimate-facebook-comments#display/ig) ) {

        $("#btn1").removeClass("active");
        $("#btn3").addClass("active");
        $("#show-main").hide();
        $("#show-settings").hide();
        $("#show-display").show();
        $("#show-title").hide();
        $("#show-notice").hide();
        $("#show-notification").hide();
        $("#show-others").hide();
        $("#show-shortcode").hide();
        $("#show-tools").hide();
        $("#show-help").hide();

    } else if( location.href.match(/page\=ultimate-facebook-comments#title/ig) ) {

        $("#btn1").removeClass("active");
        $("#btn4").addClass("active");
        $("#show-main").hide();
        $("#show-settings").hide();
        $("#show-display").hide();
        $("#show-title").show();
        $("#show-notice").hide();
        $("#show-notification").hide();
        $("#show-others").hide();
        $("#show-shortcode").hide();
        $("#show-tools").hide();
        $("#show-help").hide();

    } else if( location.href.match(/page\=ultimate-facebook-comments#notice/ig) ) {

        $("#btn1").removeClass("active");
        $("#btn5").addClass("active");
        $("#show-main").hide();
        $("#show-settings").hide();
        $("#show-display").hide();
        $("#show-title").hide();
        $("#show-notice").show();
        $("#show-notification").hide();
        $("#show-others").hide();
        $("#show-shortcode").hide();
        $("#show-tools").hide();
        $("#show-help").hide();

    } else if( location.href.match(/page\=ultimate-facebook-comments#notification/ig) ) {

        $("#btn1").removeClass("active");
        $("#btn6").addClass("active");
        $("#show-main").hide();
        $("#show-settings").hide();
        $("#show-display").hide();
        $("#show-title").hide();
        $("#show-notice").hide();
        $("#show-notification").show();
        $("#show-others").hide();
        $("#show-shortcode").hide();
        $("#show-tools").hide();
        $("#show-help").hide();
        
    } else if( location.href.match(/page\=ultimate-facebook-comments#others/ig) ) {

        $("#btn1").removeClass("active");
        $("#btn7").addClass("active");
        $("#show-main").hide();
        $("#show-settings").hide();
        $("#show-display").hide();
        $("#show-title").hide();
        $("#show-notice").hide();
        $("#show-notification").hide();
        $("#show-others").show();
        $("#show-shortcode").hide();
        $("#show-tools").hide();
        $("#show-help").hide();
        
    } else if( location.href.match(/page\=ultimate-facebook-comments#shortcode/ig) ) {

        $("#btn1").removeClass("active");
        $("#btn8").addClass("active");
        $("#show-main").hide();
        $("#show-settings").hide();
        $("#show-display").hide();
        $("#show-title").hide();
        $("#show-notice").hide();
        $("#show-notification").hide();
        $("#show-others").hide();
        $("#show-shortcode").show();
        $("#show-tools").hide();
        $("#show-help").hide();
        
    } else if( location.href.match(/page\=ultimate-facebook-comments#tools/ig) ) {

        $("#btn1").removeClass("active");
        $("#btn9").addClass("active");
        $("#show-main").hide();
        $("#show-settings").hide();
        $("#show-display").hide();
        $("#show-title").hide();
        $("#show-notice").hide();
        $("#show-notification").hide();
        $("#show-others").hide();
        $("#show-shortcode").hide();
        $("#show-tools").show();
        $("#show-help").hide();
        
    } else if( location.href.match(/page\=ultimate-facebook-comments#help/ig) ) {

        $("#btn1").removeClass("active");
        $("#btn10").addClass("active");
        $("#show-main").hide();
        $("#show-settings").hide();
        $("#show-display").hide();
        $("#show-title").hide();
        $("#show-notice").hide();
        $("#show-notification").hide();
        $("#show-others").hide();
        $("#show-shortcode").hide();
        $("#show-tools").hide();
        $("#show-help").show();
        
    }

});