jQuery(document).ready(function ($) {

    $('select').select2({
        placeholder: 'Select',
        minimumResultsForSearch: Infinity
    });

    $('select#fb-comments-lang').select2({
        placeholder: 'Select'
    });

    $('select#post-types').select2({
        placeholder: 'Select post types',
        //allowClear: true
    });
    
    $('.ufc-color-picker').wpColorPicker();

    $('#fbc-notice').change(function () {
        if ($('#fbc-notice').is(':checked')) {
            $('.fbc-notice-title').show();
            $('.fbc-notice-msg').show();
        }
        if (!$('#fbc-notice').is(':checked')) {
            $('.fbc-notice-title').hide();
            $('.fbc-notice-msg').hide();
        }
    });
    $('#fbc-notice').trigger('change');
 
    $('#fb-comments-display').change(function() {
        if ($('#fb-comments-display').val() == 'After Content') {
            $('#fb-comments-override-span').show();
        }
        if ($('#fb-comments-display').val() != 'After Content') {
            $('#fb-comments-override-span').hide();
        }
    });
    $('#fb-comments-display').trigger('change');

    $('#fbc-url').change(function() {
        if ($('#fbc-url').val() == 'Custom URL') {
            $('#fbc-curl-show').show();
            $('#fbc-curl').attr('required', 'required');
        }
        if ($('#fbc-url').val() != 'Custom URL') {
            $('#fbc-curl-show').hide();
            $('#fbc-curl').removeAttr('required');
        }
    });
    $('#fbc-url').trigger('change');

    $('#fb-comments-load').change(function() {
        if ($('#fb-comments-load').val() == 'On Click') {
            $('#fbc-on-click').show();
        }
        if ($('#fb-comments-load').val() != 'On Click') {
            $('#fbc-on-click').hide();
        }
    });
    $('#fb-comments-load').trigger('change');

    $('#fbc-trace').change(function () {
        if ($('#fbc-trace').is(':checked')) {
            $('#fbc-override-span').hide();
        }
        if (!$('#fbc-trace').is(':checked')) {
            $('#fbc-override-span').show();
        }
    });
    $('#fbc-trace').trigger('change');

});