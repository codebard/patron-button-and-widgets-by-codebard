<?php

$tab=$_REQUEST[$this->internal['prefix'].'tab'];


echo $this->do_admin_settings_form_header($tab);

		if(isset($_REQUEST[$this->internal['prefix'].'tab']))
		{
			
			$tab=$_REQUEST[$this->internal['prefix'].'tab'];
		}
		
		$open_new_window_checked_yes = '';
		$open_new_window_checked_no = '';
		$force_site_checked_yes = '';
		$force_site_checked_no = '';
		$use_old_patreon_button_yes = '';
		$use_old_patreon_button_no = '';


		if(isset($this->opt[$tab]['open_new_window']) AND $this->opt[$tab]['open_new_window']=='yes')
		{
		
			$open_new_window_checked_yes=" CHECKED";
		
		}
		else
		{
			$open_new_window_checked_no=" CHECKED";	
		}	

		if(isset($this->opt[$tab]['force_site_button']) AND $this->opt[$tab]['force_site_button']=='yes')
		{
		
			$force_site_checked_yes=" CHECKED";
		
		}
		else
		{
			$force_site_checked_no=" CHECKED";	
		}
		
		
		if(isset($this->opt[$tab]['old_button']) AND $this->opt[$tab]['old_button']=='yes')
		{
		
			$use_old_patreon_button_yes=" CHECKED";
		
		}
		else
		{
			
			$use_old_patreon_button_no=" CHECKED";
			
		}
		
		if(!isset($this->opt[$tab]['custom_button']))
		{
		
			$this->opt[$tab]['custom_button']='';
		
		}
		if(!isset($this->opt[$tab]['custom_button_width']))
		{
		
			$this->opt[$tab]['custom_button_width']='';
		
		}
		
		
		
?>
			<h3>Site's Patreon user</h3>
			If you chose not to use Patreon accounts of Authors, or an Author does not have any Patreon username saved in his/her author profile page, this Patreon username will be used for Buttons for users to support in any single post. This affects both the <b>Buttons under Posts</b>, and the <b>Author Patreon sidebar widget</b>.<br><br>
			<input type="text" style="width : 500px" name="opt[<?php echo $tab; ?>][site_account]" value="<?php echo $this->opt[$tab]['site_account']; ?>">
			
			
			<h3>Open pages in new window?</h3>
			If 'Yes', Your Patreon Profile will be opened in a new window when users click your Patreon Buttons.
			
			<br><br>
			Yes <input type="radio" name="opt[<?php echo $tab; ?>][open_new_window]" value="yes"<?php echo $open_new_window_checked_yes; ?>>
			No <input type="radio" name="opt[<?php echo $tab; ?>][open_new_window]" value="no"<?php echo $open_new_window_checked_no; ?>>
			<br><br>		
			
			
			<h3>Force Site Button instead of Author</h3>
			If 'Yes', Site's own Patreon account will be used for <b>Buttons under Posts</b> and <b>Author Patreon sidebar widget</b> instead of Authors' own accounts.
			
			<br><br>
			Yes <input type="radio" name="opt[<?php echo $tab; ?>][force_site_button]" value="yes"<?php echo $force_site_checked_yes; ?>>
			No <input type="radio" name="opt[<?php echo $tab; ?>][force_site_button]" value="no"<?php echo $force_site_checked_no; ?>>
			<br><br>
			
			<h3>Use old Patreon Button</h3>
			Recently Patreon updated their design, logo and patron button. The plugin now comes with the official default button which Patreon recommends using. But if you wish, you can keep using the old Patreon button by setting 'Yes' for below setting.
			
			<br><br>
			Yes <input type="radio" name="opt[<?php echo $tab; ?>][old_button]" value="yes"<?php echo $use_old_patreon_button_yes; ?>>
			No <input type="radio" name="opt[<?php echo $tab; ?>][old_button]" value="no"<?php echo $use_old_patreon_button_no; ?>>
			<br><br>
			<h3>Use a custom Button</h3>
			You can use a custom image for your button! Just click on below field to be taken to your WordPress media library to select your button or upload a new button and select that one. After selecting your button, save options and your new custom button will be made active.
			
			<br><br>			
			 <input class="cb_p6_file_upload" type="text" id="opt[<?php echo $tab; ?>]_custom_button" size="36" name="opt[<?php echo $tab; ?>][custom_button]" value="<?php echo $this->opt[$tab]['custom_button']; ?>" /> <a href="" class="cb_p6_clear_prevfield">Clear</a>
		<br><br>
		Current custom button :
		<br>
		<?php
			if($this->opt[$tab]['custom_button']!='')
			{
				echo '<a rel="nofollow"'.@$new_window.' href="'.@$url.'"><img style="margin-top: '.$this->opt['sidebar_widgets']['button_margin'].';margin-bottom: '.$this->opt['sidebar_widgets']['button_margin'].';max-width:50px;width:100%;height:auto;" src="'.$this->opt[$tab]['custom_button'].'"></a>';				
				
			}
		?>
			<h3>Width for your custom button</h3>
			You can set the width for your custom button if you want to have it display larger or smaller. Height will be adjusted automatically. If you leave this empty, default width of 200px will be used - something close to official Patreon button. Experiment with this value if you think your custom button is larger/smaller than you wish. 
			<br><br>
			<input type="text" style="width : 50px" name="opt[<?php echo $tab; ?>][custom_button_width]" value="<?php echo $this->opt[$tab]['custom_button_width']; ?>">
		
		<br><br>
		

<?php


$this->do_setting_section_additional_settings($tab);

echo $this->do_admin_settings_form_footer($tab);

?>