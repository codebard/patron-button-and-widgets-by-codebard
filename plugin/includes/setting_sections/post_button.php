<?php

$tab=$_REQUEST[$this->internal['prefix'].'tab'];


echo $this->do_admin_settings_form_header($tab);

		$show_button_under_posts_checked_yes = '';
		$show_button_under_posts_checked_no = '';
		$show_message_over_post_button_checked_yes = '';
		$show_message_over_post_button_checked_no = '';
		$post_button_align_checked_left = '';
		$post_button_align_checked_center = '';
		$post_button_align_checked_right = '';
		$post_insert_text_align_checked_left = '';
		$post_insert_text_align_checked_center = '';
		$post_insert_text_align_checked_right = '';

		if(isset($this->opt[$tab]['show_button_under_posts']) AND $this->opt[$tab]['show_button_under_posts']=='yes')
		{
		
			$show_button_under_posts_checked_yes=" CHECKED";
		
		}
		else
		{
			$show_button_under_posts_checked_no=" CHECKED";
				
		
		}
		if(isset($this->opt[$tab]['show_message_over_post_button']) AND $this->opt[$tab]['show_message_over_post_button']=='yes')
		{
		
			$show_message_over_post_button_checked_yes=" CHECKED";
		
		}
		else
		{
			$show_message_over_post_button_checked_no=" CHECKED";
				
		
		}
		if(isset($this->opt[$tab]['button_align']) AND $this->opt[$tab]['button_align']=='left')
		{
		
			$post_button_align_checked_left=" CHECKED";
		
		}
		if(isset($this->opt[$tab]['button_align']) AND $this->opt[$tab]['button_align']=='center')
		{
		
			$post_button_align_checked_center=" CHECKED";
		
		}
		if(isset($this->opt[$tab]['button_align']) AND $this->opt[$tab]['button_align']=='right')
		{
		
			$post_button_align_checked_right=" CHECKED";
		
		}
		if(isset($this->opt[$tab]['insert_text_align']) AND $this->opt[$tab]['insert_text_align']=='left')
		{
		
			$post_insert_text_align_checked_left=" CHECKED";
		
		}
		if(isset($this->opt[$tab]['insert_text_align']) AND $this->opt[$tab]['insert_text_align']=='center')
		{
		
			$post_insert_text_align_checked_center=" CHECKED";
		
		}
		if(isset($this->opt[$tab]['insert_text_align']) AND $this->opt[$tab]['insert_text_align']=='right')
		{
		
			$post_insert_text_align_checked_right=" CHECKED";
		
		}
		

?>
			<h1>Button under Posts</h1>
			<hr>
			
			<h3>Show Button under Posts</h3>		
			Yes <input type="radio" name="opt[<?php echo $tab; ?>][show_button_under_posts]" value="yes"<?php echo $show_button_under_posts_checked_yes; ?>>
			No <input type="radio" name="opt[<?php echo $tab; ?>][show_button_under_posts]" value="no"<?php echo $show_button_under_posts_checked_no; ?>>
						
			
			<h3>Button In Post Appearance Order</h3>
			In case the Buttons under Posts are not appearing in the order you would like them, change this number to a lower or higher number to move them up or down in order of appearance. For example, if the button is appearing under your Social Share buttons at the end of your post and you want to move it higher, lower the number.<br><br>
			<input type="text" name="opt[<?php echo $tab; ?>][append_to_content_order]" value="<?php echo $this->opt[$tab]['append_to_content_order']; ?>">
			
			<h3>Show a message over Buttons in Posts</h3>	
			If you set "Yes" a message will be shown above buttons inside posts. The message can be customized below.<br><br>
			Yes <input type="radio" name="opt[<?php echo $tab; ?>][show_message_over_post_button]" value="yes"<?php echo $show_message_over_post_button_checked_yes; ?>>
			No <input type="radio" name="opt[<?php echo $tab; ?>][show_message_over_post_button]" value="no"<?php echo $show_message_over_post_button_checked_no; ?>>
			
			<h3>Alignment of Message text And Button under Posts</h3>
			You can align the message over buttons left, center, or right.		
			<br><br>
			Left <input type="radio" name="opt[<?php echo $tab; ?>][insert_text_align]" value="left"<?php echo $post_insert_text_align_checked_left; ?>>
			Center <input type="radio" name="opt[<?php echo $tab; ?>][insert_text_align]" value="center"<?php echo $post_insert_text_align_checked_center; ?>>
			Right <input type="radio" name="opt[<?php echo $tab; ?>][insert_text_align]" value="right"<?php echo $post_insert_text_align_checked_right; ?>>	

			
			<h3>Top and Bottom Margin for Patreon Button and Text inside post</h3>
			This decides how much distance from top and down will entire Patreon addition to your posts will have.<br><br>
			<input type="text" name="opt[<?php echo $tab; ?>][insert_margin]" value="<?php echo $this->opt[$tab]['insert_margin']; ?>">			
			
			<h3>Message over Buttons in Posts</h3>
			If the above is set to yes, this is the message that will appear over buttons inside posts. {authorname} is a placeholder you can use in the message. It will automatically be replaced by Author's display name.<br><br>
			<input type="text" style="width : 500px;" name="opt[<?php echo $tab; ?>][message_over_post_button]" value="<?php echo $this->opt[$tab]['message_over_post_button']; ?>">
					
			<h3>Message over Buttons Font Size</h3>
			You can adjust the size of the message over buttons with the below value. px, %, pt accepted.<br><br>
			<input type="text" name="opt[<?php echo $tab; ?>][message_over_post_button_font_size]" value="<?php echo $this->opt[$tab]['message_over_post_button_font_size']; ?>">
			
			<h3>Message over Button Top and Bottom Margin</h3>
			This allows you to change the margin above and under the text message over the button to change distance of text from button below.<br><br>
			<input type="text" name="opt[<?php echo $tab; ?>][message_over_post_button_margin]" value="<?php echo $this->opt[$tab]['message_over_post_button_margin']; ?>">
			
			<h3>Button Top and Bottom Margin</h3>
			You can change the margin of the Button independently from the above margin, in case you need it.<br><br>
			<input type="text" name="opt[<?php echo $tab; ?>][button_margin]" value="<?php echo $this->opt[$tab]['button_margin']; ?>">

			

<?php


$this->do_setting_section_additional_settings($tab);

echo $this->do_admin_settings_form_footer($tab);

?>