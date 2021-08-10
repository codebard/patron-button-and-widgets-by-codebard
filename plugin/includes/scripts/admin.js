jQuery.noConflict(); // Reverts '$' variable back to other JS libraries

jQuery(document).ready(function($) {

	jQuery('body').on("click",'.cb_p6_admin_toggle_button',function(e) {
		target_div = document.getElementById($(this).attr( 'target' ));
		$(target_div).fadeToggle(1800);
	});
	
	jQuery(document).on( 'click', '.cb_p6_notice .notice-dismiss', function(e) {

	
		jQuery.ajax({
			url: ajaxurl,
			type:"POST",
			dataType : 'html',
			data: {
				action: 'cb_p6_dismiss_admin_notice',
				notice_id: jQuery(this).parent().attr("id"),
				notice_type: jQuery(this).parent().attr("notice_type"),
			}
		});

	});
	
	jQuery(document).on('submit', '.cb_license_save_form', function(e) {
			
		e.preventDefault();
 
		var form = jQuery(this);
		var oldcontent = form.parent().html();
		var targetdiv = form.parent();

		
		jQuery.post(form.attr('action'), form.serialize(), function(data) {
	
			
			targetdiv.html(data['message']);

			if(data['result'] == 'success')
			{
			}
			else
			{
				
				targetdiv.fadeOut(6000, function() {
					jQuery(this).html(oldcontent);
					jQuery(this).fadeIn(1000);
				});


				
			}
			
		}, 'json');


	});
	
	jQuery(document).on('click', '.cb_p6_file_upload', function(e) {		
		var cb_p6_input_target = jQuery(this);
        e.preventDefault();
        var image = wp.media({ 
            title: 'Upload Image',
            // mutiple: true if you want to upload multiple files at once
            multiple: false
        }).open()
        .on('select', function(e){
            // This will return the selected image from the Media Uploader, the result is an object
            var uploaded_image = image.state().get('selection').first();
            // We convert uploaded_image to a JSON object to make accessing it easier
            // Output to the console uploaded_image
            var image_url = uploaded_image.toJSON().url;
            // Let's assign the url value to the input field
             cb_p6_input_target.val(image_url);
			 
        });
    });
	

	
	jQuery(document).on( 'click', '.cb_p6_notice .notice-dismiss', function(e) {

		jQuery.ajax({
			url: ajaxurl,
			type:"POST",
			dataType : 'html',
			data: {
				action: 'cb_p6_dismiss_admin_notice',
				notice_id: jQuery( this ).parent().attr( "id" ),
			}
		});
	});	
	
	jQuery(document).on('click', '.cb_p6_clear_prevfield', function(e) {
		e.preventDefault();
		
		jQuery(this).prev().val('');
	
	});		
  
});