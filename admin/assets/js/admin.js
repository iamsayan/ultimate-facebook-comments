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
            $('.fbc-notice-btn').show();
        }
        if (!$('#fbc-notice').is(':checked')) {
            $('.fbc-notice-title').hide();
            $('.fbc-notice-msg').hide();
            $('.fbc-notice-btn').hide();
        }
    });
    $('#fbc-notice').trigger('change');
 
    $('#fb-comments-display').change(function() {
        if ($('#fb-comments-display').val() == 'after_content') {
            $('#fb-comments-priority-span').show();
            $('#fb-comments-priority').attr('required', 'required');
        }
        if ($('#fb-comments-display').val() != 'after_content') {
            $('#fb-comments-priority-span').hide();
            $('#fb-comments-priority').removeAttr('required');
        }
        if ($('#fb-comments-display').val() == 'disable') {
            $('.fbc-loading').hide();
            $('.fbc-post-types').hide();
        }
        if ($('#fb-comments-display').val() != 'disable') {
            $('.fbc-loading').show();
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

});