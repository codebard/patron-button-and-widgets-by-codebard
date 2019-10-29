<?php

if(isset($_REQUEST['site_account']) AND ($_REQUEST['site_account']=='' OR $_REQUEST['site_account']=='Delete this and enter your Site or your personal (admin) Patreon account here'))
{
	// Error!!!

	$this->error[]=$this->lang['error_wizard_empty_profile_name'];
	$this->opt['setup_is_being_done']=true;
	$this->update_opt();
	require($this->internal['plugin_path'].'plugin/includes/setup_modal.php');
	
}
else
{

	$this->opt['quickstart']['site_account']=$_REQUEST['site_account'];
		
	$this->opt['queue_modal']=false;
	$this->opt['setup_done'] = true;
	$this->opt['setup_done'] = true;
	$this->opt['pro_pitch_done'] = true;
	$this->opt['setup_is_being_done'] = false;
	$this->update_opt();
	
?>



<div class="<?php echo $this->internal['prefix'];?>settings">


	<div style="font-size:175%;font-weight:bold;margin-top:30px;display:inline-table;width:100%;">Great! Patreon Button & Plugin by <a href="http://codebard.com" target="_blank"><img src="<?php echo $this->internal['plugin_url']; ?>images/codebard_very_small.png"></a> is now ready!</div>

	
	<div style="font-size:150%;font-weight:bold;margin-top:30px;margin-bottom:15px;display:inline-table;width:100%;">Now if you wish, you can: 
<br><br> <a href="<?php echo $this->internal['admin_url']; ?>widgets.php" target="_blank">Put Patreon Widgets to your Sidebar</a>
<br><br> <a href="<?php echo $this->internal['admin_url'].'admin.php?page=settings_'.$this->internal['id']; ?>" target="_blank">Customize Your Buttons, Button Messages and their features</a>
<br><br> <a href="<?php echo $this->internal['admin_url'].'admin.php?page=settings_'.$this->internal['id']; ?>&<?php echo $this->internal['prefix'];?>tab=extras" target="_blank">Check out Extras</a></div>

	<div style="font-size:200%;font-weight:bold;margin-top:10px;margin-bottom:15px;display:inline-table;width:100%;line-height: 1;">And, Upgrade to Patron Plugin Pro to get most out of your Patreon and increase your pledges!</div>
	<div style="font-size:150%;font-weight:bold;margin-top:0px;margin-bottom:15px;display:inline-table;width:100%;line-height: 1;">
	Our new plugin, Patron Plugin Pro integrates your WordPress and Patreon tightly and allows you to make Patron-only posts. Post Patron-only content to your own website and get pledges from your users! Have your users login with Patreon. Have your "Be a Patron" buttons send users directly to Patron Pipeline and increase your conversions! Put up customizable "Patron only" notifications for any protected content to get more Patrons!
	</div>
	<div style="font-size:150%;font-weight:bold;margin-top:0px;margin-bottom:15px;display:inline-table;width:100%;line-height: 1;">
		<ul>
			<li>- Mark any content Patron-only with a single click</li>
			<li>- Make parts of your content Patron-only with a single button click</li>
			<li>- Make any post type Patron-only easily</li>
			<li>- Designate your entire website as Patron-only</li>
			<li>- Show customizable notifications for Patron-only content</li>
			<li>- Protect excerpts in listings so protected posts will not be visible in excerpts</li>
			<li>- Use a custom banner for any single post of any type</li>
			<li>- Send your visitors directly to Patron Pipeline to gain new patrons</li>
			<li>- Have your users log into your WordPress with Patreon</li>
			<li>- Designate a specific Pledge amount to be able to view a post</li>
		</ul>
	</div>

	<div style="font-size:175%;font-weight:bold;margin-top:0px;margin-bottom:15px;display:inline-table;width:100%;"> <a href="https://codebard.com/patron-plugin-pro" target="_blank">Click here to Get going in 15 minutes</a> and increase your income!</div>

		

		
	
<?php

?>

<?php
}


?>
