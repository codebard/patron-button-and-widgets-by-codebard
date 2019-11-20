<?php


$tab=$_REQUEST[$this->internal['prefix'].'tab'];


echo $this->do_admin_settings_form_header($tab);

		$hide_site_widget_on_single_post_page_checked_yes = '';
		$hide_site_widget_on_single_post_page_checked_no = '';
		$widget_insert_text_align_checked_left = '';
		$widget_insert_text_align_checked_center = '';
		$widget_insert_text_align_checked_right = '';

		if(isset($this->opt[$tab]['hide_site_widget_on_single_post_page']) AND $this->opt[$tab]['hide_site_widget_on_single_post_page']=='yes')
		{
		
			$hide_site_widget_on_single_post_page_checked_yes=" CHECKED";
		
		}
		else
		{
			$hide_site_widget_on_single_post_page_checked_no=" CHECKED";
				
		
		}
		if(isset($this->opt[$tab]['insert_text_align']) AND $this->opt[$tab]['insert_text_align']=='left')
		{
		
			$widget_insert_text_align_checked_left=" CHECKED";
		
		}
		if(isset($this->opt[$tab]['insert_text_align']) AND $this->opt[$tab]['insert_text_align']=='center')
		{

			$widget_insert_text_align_checked_center=" CHECKED";
		
		}
		if(isset($this->opt[$tab]['insert_text_align']) AND $this->opt[$tab]['insert_text_align']=='right')
		{
		
			$widget_insert_text_align_checked_right=" CHECKED";
		
		}

?>



<h1>Sidebar Widget Styles</h1>
			<hr>		
			<h3>Alignment of Message text And Button in Widget</h3>
			You can align the message and button to the left, center, or right.		
			<br><br>
			Left <input type="radio" name="opt[<?php echo $tab; ?>][insert_text_align]" value="left"<?php echo $widget_insert_text_align_checked_left; ?>>
			Center <input type="radio" name="opt[<?php echo $tab; ?>][insert_text_align]" value="center"<?php echo $widget_insert_text_align_checked_center; ?>>
			Right <input type="radio" name="opt[<?php echo $tab; ?>][insert_text_align]" value="right"<?php echo $widget_insert_text_align_checked_right; ?>>

		<h3>Widget Message Font Size</h3>
			You can adjust the size of the message over button in Widget with the below value. px, %, pt accepted.<br><br>
			<input type="text" name="opt[<?php echo $tab; ?>][message_font_size]" value="<?php echo $this->opt[$tab]['message_font_size']; ?>">	
			
			
			<h3>Message over Button Top and Bottom Margin</h3>
			This allows you to change the margin above and under the text message over the button to change distance of text from button below.<br><br>
			<input type="text" name="opt[<?php echo $tab; ?>][message_over_post_button_margin]" value="<?php echo $this->opt[$tab]['message_over_post_button_margin']; ?>">
			
			<h3>Button Top and Bottom Margin</h3>
			You can change the margin of the Button independently from the above margin, in case you need it.<br><br>
			<input type="text" name="opt[<?php echo $tab; ?>][button_margin]" value="<?php echo $this->opt[$tab]['button_margin']; ?>">
			
			<h3>Hide Site widget on Single Post pages</h3>
			If you turn this on, plugin will hide the Site button on Single post pages. If you also added author widget, then only author widget will be shown. This is useful to prevent two widgets unnecessarily appearing at the same time in a singular post page.<br><br>	
			Yes <input type="radio" name="opt[<?php echo $tab; ?>][hide_site_widget_on_single_post_page]" value="yes"<?php echo $hide_site_widget_on_single_post_page_checked_yes; ?>>
			No <input type="radio" name="opt[<?php echo $tab; ?>][hide_site_widget_on_single_post_page]" value="no"<?php echo $hide_site_widget_on_single_post_page_checked_no; ?>>				
		

			

<?php


$this->do_setting_section_additional_settings($tab);

echo $this->do_admin_settings_form_footer($tab);

?>