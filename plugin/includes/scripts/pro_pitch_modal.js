 jQuery(document).ready(function(){
      jQuery('#cb_p6_pro_pitch_modal').dialog({
		      title: 'Upgrade!',
			      dialogClass: 'wp-dialog',
           autoOpen: true, //FALSE if you open the dialog with, for example, a button click
           modal: true,
		   width: 'auto',
    resizable: true,
    closeOnEscape: true,
	position: {
      my: "center",
      at: "center",
      of: window
    }, 
      });
 });