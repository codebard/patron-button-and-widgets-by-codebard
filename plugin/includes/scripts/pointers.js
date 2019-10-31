jQuery(document).ready( function($) {
    cb_p6_open_pointer(0);
    function cb_p6_open_pointer(i) {
        pointer = cbp6Pointer.pointers[i];
        options = jQuery.extend( pointer.options, {
            close: function() {
                jQuery.post( ajaxurl, {
                    pointer: pointer.pointer_id,
                    action: 'dismiss-wp-pointer'
                });
            }
        });
        jQuery(pointer.target).pointer( options ).pointer('open');
    }
});