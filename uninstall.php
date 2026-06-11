<?php



	// if uninstall.php is not called by WordPress, die
		if (!defined('WP_UNINSTALL_PLUGIN')) {
			die;
		}
	

		global $wpdb;
	


		// Create dud object for loading options and internal vars:
		
		class cb_p6_dud_object {
			
			public $internal = array(
	
			// Holds internal and generated vars. Never saved.

			);
			public $opt = array(
	
			// Holds internal and generated vars. Never saved.

			);
			public $hardcoded = array(
	
			// Holds hardcoded vars. Never saved.

			);
			
					
			public function __construct() 
			{
			
				require_once('core/includes/default_internal_vars.php');
				require_once('plugin/includes/default_internal_vars.php');
				require_once('plugin/includes/hardcoded_vars.php');
					
			
			}
		}	
		$cb_p6 = new cb_dud_object;
		
		// Include internal vars from file:
		
		
		// Get options 
		
		$cb_p6->opt=get_option($cb_p6->internal['prefix'].'options');		

		if($cb_p6->opt['delete_options_on_uninstall']=='yes')
		{
			$wpdb->query( $wpdb->prepare( "DELETE FROM " . $wpdb->options . " WHERE option_name LIKE %s", $cb_p6->internal['id'] . '_%' ) );
		
		}
	
		if($cb_p6->opt['delete_data_on_uninstall']=='yes')
		{
			
			foreach($cb_p6->internal['tables'] as $key => $value)
			{
				$safe_key = preg_replace( '/[^a-zA-Z0-9_]/', '', $key );
				$wpdb->query( "DROP TABLE IF EXISTS " . $wpdb->prefix . $cb_p6->internal['id'] . "_" . $safe_key );
				
			}
			foreach($cb_p6->internal['meta_tables'] as $key => $value)
			{
				$safe_key = preg_replace( '/[^a-zA-Z0-9_]/', '', $key );
				$wpdb->query( "DROP TABLE IF EXISTS " . $wpdb->prefix . $cb_p6->internal['id'] . "_" . $safe_key );
				
			}
			
			// Remove wordpress posts
			
			// Get posts first:
	
			$results = $wpdb->get_results( $wpdb->prepare( "SELECT ID FROM " . $wpdb->posts . " WHERE post_type = %s", $cb_p6->internal['id'] . '_ticket' ), ARRAY_A );
			
			foreach($results as $key => $value)
			{
				$post_id = intval( $results[$key]['ID'] );
				
				// Delete post meta
				
				$wpdb->query( $wpdb->prepare( "DELETE FROM " . $wpdb->postmeta . " WHERE post_id = %d", $post_id ) );
				
				// Delete post 
				
				$wpdb->query( $wpdb->prepare( "DELETE FROM " . $wpdb->posts . " WHERE ID = %d", $post_id ) );
				
				
			}
			
			// Delete custom taxonomy
						
			// Delete terms
			$taxonomy_name = $cb_p6->internal['id'] . '_support';
			$wpdb->query( $wpdb->prepare( "
				DELETE FROM
				" . $wpdb->terms . "
				WHERE term_id IN
				( SELECT * FROM (
					SELECT " . $wpdb->terms . ".term_id
					FROM " . $wpdb->terms . "
					JOIN " . $wpdb->term_taxonomy . "
					ON " . $wpdb->term_taxonomy . ".term_id = " . $wpdb->terms . ".term_id
					WHERE taxonomy = %s
				) as T
				);
			", $taxonomy_name ) );

			// Delete taxonomies
			$wpdb->query( $wpdb->prepare( "DELETE FROM " . $wpdb->term_taxonomy . " WHERE taxonomy = %s", $taxonomy_name ) );

			
		}
		

?>