<?php

$this->internal = array_replace_recursive(
	
	
	$this->internal,
	
	array(
		
		'id' => 'cb_p6',
		'plugin_id' => 'patron-button-and-widgets-by-codebard',
		'prefix' => 'cb_p6_',
		'version' => '2.1.2',
		'plugin_name' => 'Patreon Button, Widgets and Plugin by CodeBard',
		
		'callable_from_request' => array(
			
			'save_settings' => 1,
			'reset_languages' => 1,
			'save_language' => 1,
			'choose_language' => 1,
			'do_setup_wizard' => 1,
			
			'save_license' => 1,
		
			'ignore the ones after this line they were allowed for development!' => 1,
			
		),
			
		
		'do_log' => false,
		
		'calllimits' => array(
		
			'add_admin_menu'=>1,
		),		
		
		'callcount' => array(
		
		),		
		
		'tables'=> array(


		),	
		'data'=> array(


		),	
		

		'meta_tables'=> array(

						
		),	
		
		
		'admin_tabs' => array(
		
			'dashboard'=>array(
				
			),
			'quickstart'=>array(
				
				
			),
			'post_button'=>array(
				
				
			),
			'sidebar_widgets'=>array(
				
				
			),
			'languages'=>array(
				
				
			),
			'addons'=>array(
				
				
				
			),
			'extras'=>array(
				
			
				
			),
			'support'=>array(
				
				
			),
		
		
		
		),
		
		'addons' => array(
		
			'patron_plugin_pro' => array(
			
				'title' => 'Patron Plugin Pro',
				'icon' => 'patron_plugin_pro.png',		
				'link' => 'https://codebard.com/patron-plugin-pro',		
				'slug' => 'patron-plugin-pro/index.php',		
				'class_name' => 'cb_p6_a1',		
			
			),
		
		
		
		
		),
		'template_parts' => array(
			'content' => '',
		),
	
	)
	
);

?>