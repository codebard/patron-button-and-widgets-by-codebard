<?php

class cb_p6_dud_language_object {
	
	public $internal = array(

	// Holds internal and generated vars. Never saved.

	);
	public $opt = array(

	// Holds internal and generated vars. Never saved.

	);
	public $hardcoded = array(

	// Holds hardcoded vars. Never saved.

	);
	public $lang = array(

	// Holds hardcoded vars. Never saved.

	);
	
			
	public function __construct() 
	{
	


	
	}
	public function load_language($v1=false)
	{

		// Loads language from db.
		
		if(isset($this->opt['lang']))
		{
			$lang = $this->opt['lang'];
		}
		else
		{
			$lang = 'en-US';			
		}		
		
		$lang_file = __DIR__ . '/../../plugin/includes/languages/'.$lang.'.php';
		
		if(!file_exists($lang_file))
		{
			$lang='en-US';
			$this->opt['lang']='en-US';
			$this->update_opt();
			$lang_file = __DIR__ . '/../../plugin/includes/languages/'.$lang.'.php';
			
		}
		
		 
		// Get saved values in db:
		
		$language_values = get_option($this->internal['prefix'].'lang_'.$lang);
		
		include($lang_file);
		$this->lang=$lang;
			
		if(!is_array($language_values))
		{
			// Get the language from language file:

			
			$language_values = $this->lang;
			
		}
		

		
		$language_values = array_replace_recursive(
		
							$lang,
							$language_values
		);
	
		return array_map('stripslashes', $language_values);
			
	}
	public function update_opt()
	{
		// Does nothing but wrap update_options for options:
		
		return update_option($this->internal['prefix'].'options',$this->opt);		

		
	}
	public function load_internal_vars()
	{
		require_once(__DIR__ . '/../../core/includes/default_internal_vars.php');
		require_once(__DIR__ . '/../../plugin/includes/default_internal_vars.php');
		require_once(__DIR__ . '/../../plugin/includes/hardcoded_vars.php');
		
	}
}

class cb_p6_sidebar_user_widget extends WP_Widget {
	public $cb_p6 = '';
    public function __construct() {
		
		global $cb_p6;
		
		if( !isset( $cb_p6 ) ) {
			// If plugin is not initialized, we may be in wp-cli or some other tool that accessed this file without initiating this plugin. Use a dud object to replace it:
			
			$this->cb_p6 = new cb_p6_dud_language_object();
			// Get options 
			$this->cb_p6->internal['prefix']='cb_p6';
			$this->cb_p6->opt=get_option($this->cb_p6->internal['prefix'].'options');	
			$this->cb_p6->internal = $this->cb_p6->load_internal_vars();
		}
		else {
			$this->cb_p6=$cb_p6;			
		}
		
		
		// Load language from db
		$this->cb_p6->lang = $this->cb_p6->load_language();

        parent::__construct(
            'patreon_sidebar_user_widget', // Base ID
             $this->cb_p6->lang['sidebar_user_widget_name'], // Name
            array( 'description' => $this->cb_p6->lang['sidebar_user_widget_desc'] ) // Args
        );
    }
 
 
    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {	
	
			
		if(!is_single()) {
			return;
		
		}
		
		global $cb_p6;
        extract( $args );
        $title 		= apply_filters('widget_title', $instance['title']);
		  $message 	= $instance['message'];
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
							
								<?php 
									
								
								?>
									<div style="text-align: <?php echo $this->cb_p6->opt['sidebar_widgets']['insert_text_align']; ?> !important;font-size: <?php echo $this->cb_p6->opt['sidebar_widgets']['message_font_size']; ?>;margin-top: <?php echo $this->cb_p6->opt['sidebar_widgets']['message_over_post_button_margin']; ?>;margin-bottom: <?php echo $this->cb_p6->opt['sidebar_widgets']['message_over_post_button_margin']; ?>;"><?php echo $this->cb_p6->author_sidebar_widget_message($message); ?></div>
								
	<?php echo $this->cb_p6->author_sidebar_widget(); ?>
							
     
						
              <?php echo $after_widget; ?>
        <?php
    }
 
    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['message'] = strip_tags($new_instance['message']);
        return $instance;
    }
 
    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {	
		global $cb_p6;
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'message'=>$this->cb_p6->lang['sidebar_author_widget_message'] ) );
        $title 		= esc_attr($instance['title']);
        $message	= esc_attr($instance['message']);
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		<p>
          <label for="<?php echo $this->get_field_id('message'); ?>"><?php echo $this->cb_p6->lang['message_over_button'] ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('message'); ?>" name="<?php echo $this->get_field_name('message'); ?>" type="text" value="<?php echo $message ?>" />
        </p>
		<p>
          <?php echo $this->cb_p6->author_sidebar_widget(); ?>
        </p>		
		
        <?php 
    }
	


}


class cb_p6_sidebar_site_widget extends WP_Widget {
 
 
    /** constructor -- name this the same as the class above */
    public function __construct() {
		
		global $cb_p6;
		
		if( !isset( $cb_p6 ) ) {
			// If plugin is not initialized, we may be in wp-cli or some other tool that accessed this file without initiating this plugin. Use a dud object to replace it:
			
			$this->cb_p6 = new cb_p6_dud_language_object();
			// Get options 
			$this->cb_p6->internal['prefix']='cb_p6';
			$this->cb_p6->opt=get_option($this->cb_p6->internal['prefix'].'options');	
			$this->cb_p6->internal = $this->cb_p6->load_internal_vars();
		}
		else {
			$this->cb_p6=$cb_p6;			
		}
		
		
		// Load language from db
		$this->cb_p6->lang = $this->cb_p6->load_language();
		
        parent::__construct(
            'patreon_sidebar_site_widget', // Base ID
             $this->cb_p6->lang['sidebar_site_widget_name'], // Name
            array( 'description' => $this->cb_p6->lang['sidebar_site_widget_desc'] ) // Args
        );
    }
 
    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) 
	{	
		global $cb_p6;
		
		
	    if( $this->cb_p6->opt['sidebar_widgets']['hide_site_widget_on_single_post_page']=='yes' AND is_singular('post'))
		{
			// Dont show the site widget on single post page 
			return;
			
		}
		
        extract( $args );
        $title 		= apply_filters('widget_title', $instance['title']);
        $message 	= $instance['message'];
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
						
								<?php if($message!='')
								{
								?>
								<div style="text-align: <?php echo $this->cb_p6->opt['sidebar_widgets']['insert_text_align']; ?> !important;font-size: <?php echo $this->cb_p6->opt['sidebar_widgets']['message_font_size']; ?>;margin-top: <?php echo $this->cb_p6->opt['sidebar_widgets']['message_over_post_button_margin']; ?>;margin-bottom: <?php echo $this->cb_p6->opt['sidebar_widgets']['message_over_post_button_margin']; ?>;"><?php echo $this->cb_p6->site_sidebar_widget_message($message); ?></div>
								<?php } ?>
							
          <?php echo $this->cb_p6->site_sidebar_widget(); ?>
     
						
              <?php echo $after_widget; ?>
        <?php
    }
 
    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['message'] = strip_tags($new_instance['message']);
        return $instance;
    }
 
    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {	
		global $cb_p6;
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'message'=>$this->cb_p6->lang['sidebar_site_widget_message'] ) );
        $title 		= esc_attr($instance['title']);
        $message	= esc_attr($instance['message']);
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		<p>
          <label for="<?php echo $this->get_field_id('message'); ?>"><?php echo $cb_p6->lang['message_over_button'] ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('message'); ?>" name="<?php echo $this->get_field_name('message'); ?>" type="text" value="<?php echo $message ?>" />
        </p>
		<p>
          <?php echo $this->cb_p6->site_sidebar_widget(); ?>
        </p>		
		
        <?php 
    }
	

}

class cb_p6_sidebar_goals_site_widget extends WP_Widget {
	public $cb_p6 = '';
    public function __construct() {
		
		global $cb_p6;
		
		if( !isset( $cb_p6 ) ) {
			// If plugin is not initialized, we may be in wp-cli or some other tool that accessed this file without initiating this plugin. Use a dud object to replace it:
			
			$this->cb_p6 = new cb_p6_dud_language_object();
			// Get options 
			$this->cb_p6->internal['prefix']='cb_p6';
			$this->cb_p6->opt=get_option($this->cb_p6->internal['prefix'].'options');	
			$this->cb_p6->internal = $this->cb_p6->load_internal_vars();
		}
		else {
			$this->cb_p6=$cb_p6;			
		}
		
		
		// Load language from db
		$this->cb_p6->lang = $this->cb_p6->load_language();

        parent::__construct(
            'patreon_sidebar_goals_site_widget', // Base ID
             $this->cb_p6->lang['sidebar_goals_site_widget'], // Name
            array( 'description' => $this->cb_p6->lang['sidebar_goals_site_widget_desc'] ) // Args
        );
    }
 
 
    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {	
	
		
		global $cb_p6;
        extract( $args );
        $title 		= apply_filters('widget_title', $instance['title']);
		  $message 	= $instance['message'];
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
							
								<?php 
									
								
								?>
									<div style="text-align: <?php echo $this->cb_p6->opt['sidebar_widgets']['insert_text_align']; ?> !important;font-size: <?php echo $this->cb_p6->opt['sidebar_widgets']['message_font_size']; ?>;margin-top: <?php echo $this->cb_p6->opt['sidebar_widgets']['message_over_post_button_margin']; ?>;margin-bottom: <?php echo $this->cb_p6->opt['sidebar_widgets']['message_over_post_button_margin']; ?>;"><?php echo $this->cb_p6->site_goals_sidebar_widget_message($message); ?></div>
								
	<?php echo $this->cb_p6->site_goals_sidebar_widget(); ?>
							
     
						
              <?php echo $after_widget; ?>
        <?php
    }
 
    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['message'] = strip_tags($new_instance['message']);
        return $instance;
    }
 
    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {	
		global $cb_p6;
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'message'=>$this->cb_p6->lang['sidebar_author_widget_message'] ) );
        $title 		= esc_attr($instance['title']);
        $message	= esc_attr($instance['message']);
				
		if( class_exists( 'Patreon_Wordpress' ) ) {
			
				// Show a notice if setup was not done
				$setup_done = get_option( 'patreon-setup-done', false );
				
				// Check if this site is a v2 site - temporary until we move to make all installations v2
				$api_version = get_option( 'patreon-installation-api-version', false );
				
				// If setup needs doing or any access credential is kaput, prompt for setup.
				
				// Some convoluted logic. could be handled better
				if( ( !$setup_done AND $api_version == '2' ) OR 
				
					(	!get_option( 'patreon-client-id', false ) 
						AND !get_option( 'patreon-client-secret', false ) 
						AND !get_option( 'patreon-creators-access-token' , false )
						AND !get_option( 'patreon-creators-refresh-token' , false )
					) OR 
					
					(	get_option( 'patreon-client-id', false ) == ''
						OR get_option( 'patreon-client-secret', false ) == '' 
						OR get_option( 'patreon-creators-access-token' , false ) == ''
						OR get_option( 'patreon-creators-refresh-token' , false ) == ''
					)
					
				) {
					
					if ( current_user_can( 'manage_options' ) ) {
						?>
						<p>
						<?php
						echo $this->cb_p6->lang['pw_install_message_10'];
						?>
						</p>
						<?php
					}
				}
				else {
					?>
					<p>
					Goals widget shows your financial goals. Updates itself daily.
					</p>
					<p>
					  <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
					  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
					</p>
					<p>
					  <label for="<?php echo $this->get_field_id('message'); ?>">Message over goal (optional)</label> 
					  <input class="widefat" id="<?php echo $this->get_field_id('message'); ?>" name="<?php echo $this->get_field_name('message'); ?>" type="text" value="<?php echo $message ?>" />
					</p>
					<p>
					Widget preview:
					</p>
					<p>
					  <?php echo $this->cb_p6->site_goals_sidebar_widget(); ?>
					</p>
					<?php
						if ( !is_plugin_active( 'patron-plugin-pro/index.php' ) ) {
							
					?>	
						<hr>
						<p>
						<?php echo $this->cb_p6->lang['new_patreon_widget_message_in_widget_desc']; ?>
						</p>
						
						<?php
						
					}
					
				}				

		}
		else {
			
			if ( current_user_can( 'manage_options' ) ) {
			 ?>
			 <p>
			 <?php
				echo $this->cb_p6->lang['goals_widget_require_pw'];
			?>
			</p>
			
			<?php
			}
		}
		
    }
	
}

function cb_p6_register_widgets()
{

	register_widget( 'cb_p6_sidebar_user_widget' );
	register_widget( 'cb_p6_sidebar_site_widget' );
	register_widget( 'cb_p6_sidebar_goals_site_widget' );

}

add_action('widgets_init', 'cb_p6_register_widgets');


?>