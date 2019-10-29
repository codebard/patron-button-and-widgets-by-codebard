<?php 
	// $this->check_woocommerce_exists();


	
	
	if($this->check_addon_exists('patron_plugin_pro')=='active')
	{

	
		$pro_manual='<button class="cb_p6_admin_button" onclick="window.open(\'https://codebard.com/patron-plugin-pro-manual\');" target="_blank">'.$this->lang['setup_read_pro_manual'].'</button>';

	}
	else
	{
		$pro_manual='';
	}
	?>
	<div class="cb_p6_setup_wizard_one_col" style="text-align : center;font-size : 100%; max-width : 600px;padding-top: 30px;">
	
			<button class="cb_p6_admin_button" onclick="window.open('https://codebard.com/patreon-button-and-plugin-manual');" target="_blank"><?php echo $this->lang['setup_read_manual'];?></button>
	
			
		<?php 	echo $pro_manual; 	?>

	</div>
	<div class="cb_p6_setup_wizard_two_col" style="max-width : 600px;">
	
		<div class="cb_p6_setup_wizard_col_33" style="text-align : center; max-width : 600px;">
		
			<?php echo $this->lang['setup_wizard_follow_us_on_twitter'];?><br><br><a href="https://twitter.com/codebardcom" class="twitter-follow-button" data-show-count="false"><?php echo $this->lang['setup_wizard_twitter_follow_label_prefix'];?> @CodeBard</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
			
		</div>
	
		<div class="cb_p6_setup_wizard_col_33" style="text-align : center;">
		
			<?php echo $this->lang['setup_wizard_join_list']; ?>
			<br><br>
	
			<button class="cb_p6_admin_button" onclick="window.open('<?php echo $this->lang['newsletter_link'] ?>');" target="_blank"><?php echo $this->lang['setup_wizard_join_mailing_list_link_label'];?></button>
		</div>
		

		<div class="cb_p6_setup_wizard_col_33" style="text-align : center;">
		
			<a href="<?php echo $this->lang['tell_your_friends_tweet']; ?>" target="_blank"><?php echo $this->lang['tell_your_friends']; ?></a>
			<br><br>
	
		</div>
		

	</div>
