<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if(!isset($this->opt['lang']))
{
	$this->opt['lang']='en-US';
	
}

$current_language = false;
if(isset($_REQUEST[$this->internal['prefix'].'current_language']))
{
	if(isset($_REQUEST['cb_plugins_nonce_set_language']) && wp_verify_nonce( sanitize_key( $_REQUEST['cb_plugins_nonce_set_language'] ), 'cb_plugins_nonce_set_language' ))
	{
		$current_language = sanitize_text_field($_REQUEST[$this->internal['prefix'].'current_language']);
	}
}



echo '<h2>'.wp_kses_post($this->lang['admin_title_choose_reset_language']).'</h2>';

echo '<form action="admin.php?page=settings_cb_p6&'.esc_attr($this->internal['prefix']).'tab=languages" name="" method="post" class="'.esc_attr($this->internal['prefix']).'inline_block_form">';

echo $this->do_admin_language_selector();

echo '<input type="hidden" name="'.esc_attr($this->internal['prefix']).'action" value="choose_language">';
echo '<input type="hidden" name="cb_plugin" value="'.esc_attr($this->internal['id']).'">';
echo '<input type="hidden" name="'.esc_attr($this->internal['prefix']).'current_language" value="'.esc_attr($this->opt['lang']).'">';
echo '<input type="hidden" name="cb_plugins_nonce_set_language" value="' . wp_create_nonce( 'cb_plugins_nonce_set_language' ) . '">';
echo '<input type="submit" value="'.esc_attr($this->lang['set_language_button_label']).'" class="'.esc_attr($this->internal['prefix']).'admin_button"  aria-label="Set language">';

echo '</form>';


echo '<form action="admin.php?page=settings_cb_p6&'.esc_attr($this->internal['prefix']).'tab=languages" name="" method="post" class="'.esc_attr($this->internal['prefix']).'inline_block_form">';


echo '<input type="hidden" name="'.esc_attr($this->internal['prefix']).'action" value="reset_languages">';
echo '<input type="hidden" name="cb_plugin" value="'.esc_attr($this->internal['id']).'">';
echo '<input type="hidden" name="cb_p6_nonce_reset_languages" value="' . wp_create_nonce( 'cb_p6_nonce_reset_languages' ) . '">';
echo '<input type="submit" value="'.esc_attr($this->lang['reset_languages_button_label']).'" class="'.esc_attr($this->internal['prefix']).'admin_button"  aria-label="Reset language">';
echo '</form>';

if(wp_script_is('jquery')) {

   echo '<br><br>';
   echo '<button type="submit" class="'.esc_attr($this->internal['prefix']).'admin_toggle_button '.esc_attr($this->internal['prefix']).'admin_button" target="'.esc_attr($this->internal['prefix']).'language_translation_toggle">'.esc_html($this->lang['toggle_to_view_edit_current_language']).'</button>';

   echo '<div id="'.esc_attr($this->internal['prefix']).'language_translation_toggle" style="display:none;">';

}

echo '<h2>'.wp_kses_post($this->lang['admin_title_modify_current_language']).'</h2>';

echo '<form action="admin.php?page=settings_cb_p6&'.esc_attr($this->internal['prefix']).'tab=languages" name="" method="post">';

foreach($this->lang as $key => $value)
{
	echo '<br>';
	echo esc_html($key);
	echo '<br>';
	echo '<br>';
	echo '<textarea cols="50" rows="3" name="'.esc_attr($this->internal['prefix']).'lang_strings['.esc_attr($key).']">'.esc_textarea($this->lang[$key]).'</textarea>';
	echo '<br>';
	
}

echo '<input type="hidden" name="'.esc_attr($this->internal['prefix']).'action" value="save_language">';
echo '<input type="hidden" name="cb_plugin" value="'.esc_attr($this->internal['id']).'">';
echo '<input type="hidden" name="'.esc_attr($this->internal['prefix']).'lang" value="'.esc_attr($this->opt['lang']).'">';
echo '<input type="hidden" name="cb_plugins_nonce_save_language_settings" value="' . wp_create_nonce( 'cb_plugins_nonce_save_language_settings' ) . '">';
echo '<br>';
echo '<input type="submit" value="'.esc_attr($this->lang['set_language_button_label']).'" class="'.esc_attr($this->internal['prefix']).'admin_button"  aria-label="Set language">';

echo '</form>';

if(wp_script_is('jquery')) {

   echo '</div>';

}



?>
