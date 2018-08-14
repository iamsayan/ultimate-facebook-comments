(function($) {

    // Copy of the WP inline edit post function.
    var $wp_inline_edit = inlineEditPost.edit;

    // Overwrite the function.
    inlineEditPost.edit = function( id ) {

        // Invoke the original function.
        $wp_inline_edit.apply( this, arguments );

        var $post_id = 0;
        if ( typeof( id ) == 'object' ) {
            $post_id = parseInt( this.getId( id ) );
        }

        if ( $post_id > 0 ) {
            // Define the edit row.
            var $edit_row = $( '#edit-' + $post_id );
            var $post_row = $( '#post-' + $post_id );

            // Get the data
            var $ufc_disable_fbc = !! $( '.column-fb-comments-status .ufc-disable', $post_row ).size();
            var $ufc_switch_fbc = $( '.column-fb-comments-status .ufc-disable', $post_row ).size();

            // Populate the data.
            $( ':input[name="disablefbcomment"]', $edit_row ).prop('checked', $ufc_disable_fbc );
            $( ':input[name="disablefbchidden"]', $edit_row ).val( $ufc_switch_fbc );
        }
    };

})(jQuery);