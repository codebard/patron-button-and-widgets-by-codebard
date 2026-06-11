<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
		<form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=settings_<?php echo $this->internal['id']; ?>">
			<input type="submit" value="  <?php echo $this->lang['reset_options']; ?>  " style="float:left;"   aria-label="Reset options">
			<input type="hidden" name="<?php echo $this->internal['id']; ?>_action" value="reset_options">
			<input type="hidden" name="<?php echo $this->internal['id']; ?>_tab" value="<?php echo $this->internal['current_tab']; ?>">
			<input type="hidden" name="cb_plugins_nonce_reset_options" value="<?php echo wp_create_nonce('cb_plugins_nonce_reset_options'); ?>">
		</form>
