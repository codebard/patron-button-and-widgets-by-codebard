<?php


class cb_p6_plugin extends cb_p6_core
{
	public function plugin_construct()
	{

		add_action('init', array(&$this, 'init'));
		
		add_action('upgrader_process_complete', array(&$this, 'upgrade'),10, 2);
		
		register_activation_hook( __FILE__, array(&$this,'activate' ));
		
		register_deactivation_hook(__FILE__, array(&$this,'deactivate'));
		
		if(is_admin())
		{
			add_action('init', array(&$this, 'admin_init'));
		}
		else
		{
			add_action('init', array(&$this, 'frontend_init'),99);
		}

		add_action('admin_init',array(&$this,'check_redirect_to_setup_wizard'),99);			
		
	}
	public function add_admin_menus_p()
	{
		
		add_menu_page( $this->lang['admin_menu_label'], $this->lang['admin_menu_label'], 'administrator', 'settings_'.$this->internal['id'], array(&$this,'do_settings_pages'), $this->internal['plugin_url'].'images/admin_menu_icon.png', 86 );
		
	}
	public function admin_init_p()
	{
		
		// Updates are important - Add update nag if update exist
		add_filter( 'pre_set_site_transient_update_plugins', array(&$this, 'check_for_update' ),99 );
		
		add_action( 'cb_p6_action_before_do_admin_page_tabs', array( &$this, 'pro_pitch' ) );

		/* Old Widget notice  - can be used to show new notices.
	   if(!isset($this->opt['widget_update_notice_shown']) AND !$this->opt['setup_is_being_done']) {
			$this->queue_notice($this->lang['updated_widgets_notice'],'info','widget_update_notice','perma',true);	
			$this->opt['widget_update_notice_shown']=true;
			$this->update_opt();
	   }
		*/
		// Do setup wizard if it was not done
		if($this->opt['setup_is_being_done'])
		{
			add_action($this->internal['prefix'].'action_before_do_settings_pages',array(&$this,'do_setup_wizard'),99,1);
		}	
		
	}
	public function frontend_init_p()
	{
		
	}
	public function init_p()
	{
	
		// Below function checks the request in any way necessary, and queues any action/filter depending on request. This way, we avoid filtering content or putting any actions in pages or operations not relevant to plugin
				
		add_action( 'wp', array(&$this, 'route_request'));
		
		add_action( 'template_redirect', array(&$this, 'template_redirections'));
		
		$upload_dir = wp_upload_dir();
		
		$this->internal['attachments_dir'] = $upload_dir['basedir'] . '/'.$this->internal['prefix'].'ticket_attachments/';
	
		$this->internal['attachment_url'] =  $upload_dir['baseurl'] . '/'.$this->internal['prefix'].'ticket_attachments/';
		
		// Get relative attachment dir/url :
		
		$this->internal['attachment_relative_url']=substr(wp_make_link_relative($upload_dir['baseurl']),1).'/'.$this->internal['prefix'].'ticket_attachments/';
		
		
		$this->internal['plugin_update_url'] =  wp_nonce_url(get_admin_url().'update.php?action=upgrade-plugin&plugin='.$this->internal['plugin_id'].'/index.php','upgrade-plugin_'.$this->internal['plugin_id'].'/index.php');
		

		add_action( 'show_user_profile', array(&$this, 'add_custom_user_field') );
		add_action( 'edit_user_profile', array(&$this, 'add_custom_user_field') );

		add_action( 'personal_options_update', array(&$this, 'save_custom_user_field') );
		add_action( 'edit_user_profile_update', array(&$this, 'save_custom_user_field') );			
		
		
	}
	public function load_options_p()
	{
		// Initialize and modify plugin related variables
		

		return $this->internal['core_return'];
		
	}

	public function title_filters_p($title)
	{
		global $post;

		
		return $title;
	}
	public function content_filters_p($wordpress_content)
	{
		global $post;
	
		
		if(is_singular() AND isset($this->opt['post_button']['show_button_under_posts']) AND $this->opt['post_button']['show_button_under_posts']=='yes')
		{
			
			$wordpress_content = $this->append_to_content($wordpress_content,$this->opt['post_button']['append_to_content_order']);
			return $wordpress_content;
		}
	
		return $wordpress_content;
	}
	public function template_redirections_p($link)
	{
		global $post;

		return $link;
	}
	public function setup_languages_p()
	{
		// Here we do plugin specific language procedures. 
		
		// Set up the custom post type and its taxonomy slug into options:
		
		$current_lang=get_option($this->internal['prefix'].'lang_'.$this->opt['lang']);
		
		// Get current options

		$current_options=get_option($this->internal['prefix'].'options');

		$current_options['ticket_post_type_slug']=$current_lang['ticket_post_type_slug'];
		$current_options['ticket_category_slug']=$current_lang['ticket_post_type_category_slug'];
		
		// Update options :
		
		update_option($this->internal['prefix'].'options',$current_options);
		
		// Set current options the same as well :
		
		$this->opt=$current_options;
		
	}
	public function activate_p()
	{

		
	}

	public function check_redirect_to_setup_wizard_p()
	{

		if(!is_user_logged_in())
		{
			return;
		}
		// If setup was not done, redirect to wizard
		if($this->opt['quickstart']['site_account']=='Delete this and enter your Site or your personal (admin) Patreon account here' AND !isset($_REQUEST['setup_stage']))
		{

			$this->opt['setup_is_being_done']=true;
			$this->update_opt();
			$this->queue_modal('setup');
			return;
				
		}

		// If setup was not done, redirect to wizard
		if(!$this->opt['pro_pitch_done'] AND !isset($_REQUEST['setup_stage']))
		{
		
			$this->opt['setup_is_being_done']=true;
			$this->update_opt();
			
			$this->queue_modal('pro_pitch');
			
		}
		
		
	}
	public function enqueue_frontend_styles_p()
	{
		wp_enqueue_style( $this->internal['id'].'-css-main', $this->internal['template_url'].'/'.$this->opt['template'].'/style.css' );
	}
	public function enqueue_admin_styles_p()
	{
		$current_screen=get_current_screen();

		if($current_screen->base=='toplevel_page_settings_'.$this->internal['id'])
		{
			wp_enqueue_style( $this->internal['id'].'-css-admin', $this->internal['plugin_url'].'plugin/includes/css/admin.css' );
			
		}
	}
	public function enqueue_frontend_scripts_p()
	{
	
	
	
		
	}	
	public function enqueue_admin_scripts_p()
	{
	
		// This will enqueue the Media Uploader script
		wp_enqueue_media();	
		wp_enqueue_script( $this->internal['id'].'-js-admin', $this->internal['plugin_url'].'plugin/includes/scripts/admin.js' );	
		
		
	}	
	public function route_request_p()
	{
		global $post;
		
		$current_term = get_queried_object();
		$current_user = wp_get_current_user();
		
		// Placeholder queuer
		
		// Support desk main page. Queue content filter or any necessary function
		
		$this->queue_content_filters();

		
			
		
		
	}
	public function queue_title_filters_p()
	{
		// This function is a wrapper for queueing content filter
		
		if(!isset($this->internal['title_filter_queued']))
		{
			$this->internal['title_filter_queued']=true;
			add_filter('the_title', array(&$this, 'title_filters'));		
		}
	}
	public function queue_content_filters_p()
	{
		// This function is a wrapper for queueing content filter
		
		if(!isset($this->internal['content_filter_queued']))
		{
			$this->internal['content_filter_queued']=true;
			add_filter('the_content', array(&$this, 'content_filters'));		
		}
	}
	public function choose_language_p($v1)
	{
		
		// Check if language was successfully changed and hook to create pages if necessary:
		if($this->internal['core_return'])
		{
			add_action( 'admin_init', array(&$this, 'check_create_pages'));			
		}
	}
	public function check_for_update($checked_data) 
	{
			global $wp_version, $plugin_version, $plugin_base;
		
			if ( empty( $checked_data->checked ) ) {
				return $checked_data;
			}

			if(isset($checked_data->response[$this->internal['plugin_id'].'/index.php']) AND version_compare( $this->internal['version'], $checked_data->response[$this->internal['plugin_id'].'/index.php']->new_version, '<' ))
			{
				// place update link into update lang string :
				
				$update_link = $this->process_vars_to_template(array('plugin_update_url'=>$this->internal['plugin_update_url']),$this->lang['update_available']);

				$this->queue_notice($update_link,'info','update_available','perma',true);		
			}
			return $checked_data;
		
	}	
	public function upgrade_p($v1,$v2)
	{
		
		$upgrader_object = $v1;
		$options = $v2;
		$this->opt=get_option($this->internal['prefix'].'options');
		
		// The path to our plugin's main file
		 $our_plugin = $this->internal['plugin_slug'];

		 // If an update has taken place and the updated type is plugins and the plugins element exists
		 if( $options['action'] == 'update' && $options['type'] == 'plugin' && isset( $options['plugins'] ) ) {
		  // Iterate through the plugins being updated and check if ours is there
		  foreach( $options['plugins'] as $plugin ) {
	
		   if( $plugin == $our_plugin ) {
			   
				$this->dismiss_admin_notice(array('notice_id'=>'update_available','notice_type'=>'info'));
				if($this->check_addon_exists('patron_plugin_pro')=='notinstalled')
				{
					
					$this->opt['pro_pitch_done']=false;
					$this->update_opt();				
					$this->queue_notice($this->lang['cb_p6_a1_addon_available'],'info','pro_pitch','perma',true);
					
				
				}
				else
				{
					
					$this->dismiss_admin_notice(array('notice_id'=>'pro_pitch','notice_type'=>'info'));
					
				}						
			
			}
			}
		 }
		

		
		if(!current_user_can('manage_options'))
		{
			$this->queue_notice($this->lang['error_operation_failed_no_permission'],'error','error_operation_failed_no_permission','admin');
			return false;
		}


		
	}
	public function do_setup_wizard_p($v1)
	{

		if($this->opt['quickstart']['site_account']=='Delete this and enter your Site or your personal (admin) Patreon account here')
		{
			$this->internal['setup_is_being_done']=true;
			
			// No setup was done in this install. do setup
			if(isset($_POST['setup_stage']) AND $_POST['setup_stage']=='1')
			{
				
				require($this->internal['plugin_path'].'plugin/includes/setup_2.php');
		
			}	
			return;
		}
		
		// Return left here for future modifications
		return;

	}
	public function pro_pitch_p()
	{
		// This function displays pro pitch after page admin header
		
		if($this->check_addon_exists('patron_plugin_pro')=='notinstalled')
		{	

			echo '<div class="cb_p6_pro_pitch">';
			echo $this->lang['cb_p6_a1_addon_available_header'];	
			echo '</div>';
		}
		
	}
	public function display_addons_p()
	{
		// This function displays addons from internal vars
		echo '<div class="cb_addons_list">';
		foreach($this->internal['addons'] as $key => $value)
		{
			echo $this->display_addon($key);
			
		}
		echo '</div>';
		
		
	}
	public function display_addon_p($v1)
	{
		$addon_key=$v1;
		
		$addon=$this->internal['addons'][$addon_key];
		
		// This function displays a particular addon
	
		echo '<div class="cb_addon_listing">';	
		echo '<div class="cb_addon_icon"><a href="'.$this->internal['addons'][$addon_key]['link'].'" target="_blank"><img src="'.$this->internal['plugin_url'].'images/'.$addon['icon'].'" /></a></div>';echo '<div class="cb_addon_title"><a href="'.$this->internal['addons'][$addon_key]['link'].'" target="_blank">'.$this->lang['addon_'.$addon_key.'_title'].'</a></div>';		
		echo '<div class="cb_addon_status">'.$this->check_addon_status($addon_key).'</div>';
		echo '</div>';			
		
	}
	public function wrapper_check_addon_license_p($v1)
	{
		// Wrapper solely for the purpose of letting addons check their licenses
		
	}
	public function check_addon_status_p($v1)
	{
		// Checks addon status, license, and provides links if inecessary
		
		$addon_key = $v1;
		
		// Check if addon is active:
		
		if ( is_plugin_active( $this->internal['addons'][$addon_key]['slug'] ) ) 
		{
			//plugin is active
			
			echo $this->wrapper_check_addon_license($addon_key);
			
		}
		else
		{
			// Check if plugin exists:
		
			if(file_exists(WP_PLUGIN_DIR.'/'.$this->internal['addons'][$addon_key]['slug']))
			{
			
				return $this->lang['inactive']; 
				
			}
			else			
			{
		
				// Not installed. 
				return '<a href="'.$this->internal['addons'][$addon_key]['link'].'" class="cb_get_addon_link" target="_blank">'.$this->lang['get_this_addon'].'</a>';
				
			}
			
		}
		
		
	}
	public function check_addon_exists_p($v1)
	{
		// Checks addon status, license, and provides links if inecessary
		
		$addon_key = $v1;
		
		// Check if addon is active:
		
		if ( is_plugin_active( $this->internal['addons'][$addon_key]['slug'] ) ) 
		{
			//plugin is active
			
			return 'active';
			
		}
		else
		{
			// Check if plugin exists:
			
			if(file_exists(WP_PLUGIN_DIR.'/'.$this->internal['addons'][$addon_key]['slug']))
			{
				
				return 'notactive';
				
			}
			else			
			{
				// Not installed. 
				return 'notinstalled';
				
			}
			
		}
		
		
	}
	public function add_custom_user_field_p($v1)
	{
		$user=$v1;
		?>
					
					<table class="form-table">
						<tr><th>
							<label for="address"><?php _e('Your Patreon User', $this->internal['id']); ?>
							</label></th>
							<td>
								<input type="text" name="<?php echo $this->internal['id'];?>_patreon_user" id="<?php echo $this->internal['id'];?>_patreon_user" value="<?php echo esc_attr( get_the_author_meta( $this->internal['prefix'].'patreon_user', $user->ID ) ); ?>" class="regular-text" /><br />
									<span class="description"><?php _e('Please enter your Patreon user.', $this->internal['id']); ?></span>
							</td>
						</tr>
					</table>
						
		<?php		
		
	}
	
	


	public function save_custom_user_field_p($v1)
	{
		$user_id=$v1;

		if ( !current_user_can( 'edit_user', $user_id ) ) $return = FALSE;

		update_usermeta( $user_id, $this->internal['prefix'].'patreon_user', $_POST[$this->internal['prefix'].'patreon_user'] );					
		
	}

	public function site_sidebar_widget_p($v1)
	{
		//************************Site Sidebar Widget**********************//
		$content=$v1;
		//if(in_array('get_the_excerpt', $GLOBALS['wp_current_filter']) OR 'post' !== get_post_type()) $return = $content;
			
		global $post;
		
		$get_url=get_permalink();	
		$append = '';
		$append.='<div class="'.$this->internal['prefix'].'patreon_site_widget" style="text-align:'.$this->opt['sidebar_widgets']['insert_text_align'].' !important;">';
		

		if($this->opt['quickstart']['redirect_url']=='')
		{
			$redirect=$get_url;
		
		}
		else
		{
			$redirect=$this->opt['quickstart']['redirect_url'];
		
		}	

		$user=$this->opt['quickstart']['site_account'];			
			

		// Lets check if what is saved is an url
		if(substr($user,0,4)=='http')
		{
			// It is! Load the value to url value
			$url=$user;
		}
		else
		{
			// This is a user name/slug. Make the url :
			$url='https://www.patreon.com/'.$user;
			
		}
		// Lets shove in the target=_blank if open in new window is set :
		
		if($this->opt['quickstart']['open_new_window']=='yes')
		{
			$new_window=' target="_blank"';
		
		}
		
		if($this->opt['quickstart']['old_button']=='yes')
		{
			$button=$this->internal['plugin_url'].'images/'."patreon-medium-button.png";
			$max_width = '200';
		}
		else
		{
			
			$button=$this->internal['plugin_url'].'images/'."become_a_patron_button.png";
			$max_width = '200';
			
		}
		
		if($this->opt['quickstart']['custom_button']!='')
		{
			$button=$this->opt['quickstart']['custom_button'];
			
			if($this->opt['quickstart']['custom_button_width']!='')
			{
				$max_width = $this->opt['quickstart']['custom_button_width'];
				
			}
			else
			{
				$max_width = '200';
			}
			
		}
		
		if($this->opt['quickstart']['open_new_window']=='yes')
		{
			$new_window=true;
		}
		else
		{
			$new_window=false;
		}
			
	
		
		$button = $this->make_to_patreon_link($url,$button,$this->opt['sidebar_widgets']['button_margin'],$max_width,$new_window);
		
		$append.=$button;
		
		$append.='</div>';

		return $append;	


		//************************Site Sidebar Widget EOF*********************************//
		
	}	


	public function return_plugin_name_p($v1)
	{
		// Wrapper to modify the plugin name when shown anywhere
		
		return $this->lang['plugin_name']; 
		
	}
	public function append_to_content_p($v1,$v2)
	{

		//************************APPEND TO CONTENT*********************************//
		
		$content=$v1;
		$append_to_content_order=$v2;
	
				
		if(in_array('get_the_excerpt', $GLOBALS['wp_current_filter']) OR 'post' !== get_post_type() OR !is_singular('post')) {
			
			return $content;
		
		}

		global $post;
			
		$get_url=get_permalink();
			

		// form array of items set to 1
		$append='<div class="'.$this->internal['prefix'].'patreon_button" style="text-align:'.$this->opt['post_button']['insert_text_align'].' !important;margin-top:'.$this->opt['post_button']['insert_margin'].';margin-bottom:'.$this->opt['post_button']['insert_margin'].';">';
			

			
		if($this->opt['post_button']['show_message_over_post_button']=='yes')
		{
			$author_name=get_the_author_meta('display_name');

			if($this->opt['quickstart']['force_site_button']=='yes')
			{
				$author_name=	$site_name=$bloginfo = get_bloginfo( 'name', 'raw' );

			}	

			$insert_message=str_replace('{authorname}',$author_name,$this->opt['post_button']['message_over_post_button']);
				
				
			$append.='<div class="'.$this->internal['prefix'].'message_over_post_button" style="font-size:'.$this->opt['post_button']['message_over_post_button_font_size'].';margin-top:'.$this->opt['post_button']['message_over_post_button_margin'].';margin-bottom:'.$this->opt['post_button']['message_over_post_button_margin'].';">'.$insert_message.'</div>';
				
			
		}
			

		$author_id=get_the_author_meta('ID');
		$user=esc_attr( get_the_author_meta( $this->internal['prefix'].'patreon_user', $author_id ) );
		
		
		if($this->opt['quickstart']['force_site_button']=='yes' OR $user=='')
		{
			$user=$this->opt['quickstart']['site_account'];	
		
		}
		
		// Lets check if what is saved is an url
		if(substr($user,0,4)=='http')
		{
			// It is! Load the value to url value
			$url=$user;
		}
		else
		{
			// This is a user name/slug. Make the url :
			$url='https://www.patreon.com/'.$user;
			
		}	
		

		if(isset($this->opt['quickstart']['old_button']) AND $this->opt['quickstart']['old_button']=='yes')
		{
			$button=$this->internal['plugin_url'].'images/'."patreon-medium-button.png";
			$max_width = '200';
		}
		else
		{
			
			$button=$this->internal['plugin_url'].'images/'."become_a_patron_button.png";
			$max_width = '200';
			
		}
		
		if(isset($this->opt['quickstart']['custom_button']) AND $this->opt['quickstart']['custom_button']!='')
		{			
			$button=$this->opt['quickstart']['custom_button'];
			if($this->opt['quickstart']['custom_button_width']!='')
			{
				$max_width = $this->opt['quickstart']['custom_button_width'];
				
			}
			else
			{
				$max_width = '200';
			}
			
		}
		if(@$this->opt['quickstart']['open_new_window']=='yes')
		{
			$new_window=' target="_blank"';
			
		}
		else
		{
			$new_window='';
		}
		if($this->opt['quickstart']['force_site_button']=='yes')
		{
			$append.= $this->make_to_patreon_link($url,$button,$this->opt['sidebar_widgets']['button_margin'],$max_width,$new_window);
			
		}
		else
		{
			$append.= $this->make_to_patreon_link_to_profile($url,$button,$this->opt['sidebar_widgets']['button_margin'],$max_width,$new_window);
		}
	
			
		$append.='</div>';	
		
		return $content.$append;

	}
	public function author_sidebar_widget_p($v1)
	{
		

		$content=$v1;
				
		//if(in_array('get_the_excerpt', $GLOBALS['wp_current_filter']) OR 'post' !== get_post_type()) $return = $content;
	
		global $post;
		
		$get_url=get_permalink();
		$append='';
		$append.='<div class="'.$this->internal['prefix'].'patreon_author_widget" style="text-align:'.$this->opt['sidebar_widgets']['insert_text_align'].' !important;">';
		

		$author_id=get_the_author_meta('ID');
		
		$user=esc_attr( get_the_author_meta( $this->internal['prefix'].'patreon_user', $author_id ) );

		if($this->opt['quickstart']['force_site_button']=='yes' OR $user=='')
		{
			$user=$this->opt['quickstart']['site_account'];			
			
		}	

		// Lets check if what is saved is an url
		if(substr($user,0,4)=='http')
		{
			// It is! Load the value to url value
			$url=$user;
		}
		else
		{
			// This is a user name/slug. Make the url :
			$url='https://www.patreon.com/'.$user;
			
		}

		if($this->opt['quickstart']['old_button']=='yes')
		{
			$button=$this->internal['plugin_url'].'images/'."patreon-medium-button.png";
			$max_width = '200';
		}
		else
		{
			
			$button=$this->internal['plugin_url'].'images/'."become_a_patron_button.png";
			$max_width = '200';
			
		}
		
		if($this->opt['quickstart']['custom_button']!='')
		{
			$button=$this->opt['quickstart']['custom_button'];
			if($this->opt['quickstart']['custom_button_width']!='')
			{
				$max_width = $this->opt['quickstart']['custom_button_width'];
				
			}
			else
			{
				$max_width = '200';
			}
			
		}
		if($this->opt['quickstart']['open_new_window']=='yes')
		{
			$new_window=true;
		}
		else
		{
			$new_window=false;
		}
			

		if($this->opt['quickstart']['force_site_button']=='yes')
		{
			$button = $this->make_to_patreon_link($url,$button,$this->opt['sidebar_widgets']['button_margin'],$max_width,$new_window);
			
		}
		else
		{
			$button = $this->make_to_patreon_link_to_profile($url,$button,$this->opt['sidebar_widgets']['button_margin'],$max_width,$new_window);
		}
		
	
		$append.=$button;
		
		$append.='</div>';

		return $append;
		
	}
	public function author_sidebar_widget_message_p($message)
	{
	
		global $post;
		if($this->opt['quickstart']['force_site_button']=='yes')
		{
			$site_name=$bloginfo = get_bloginfo( 'name', 'raw' );
			$message=str_replace('{authorname}',$site_name,$message);			
			
		}
		else
		{
			$author_name=get_the_author_meta('display_name');
			$message=str_replace('{authorname}',$author_name,$message);
		}
		return $message;			
		
	}
	
	public function site_sidebar_widget_message_p($message)
	{
	
		$site_name=$bloginfo = get_bloginfo( 'name', 'raw' );
		$message=str_replace('{sitename}',$site_name,$message);			
						
		
		return $message;			
		
	}
	
	public function make_to_patreon_link_p($url, $button, $margin=10, $max_width=200, $new_window=false)
	{
		if($new_window)
		{
			$new_window = ' target="_blank"';
			
		}
		else
		{
			$new_window='';
		
		}
		
		$url = $this->make_to_patreon_url($url);
		
		return '<a rel="nofollow"'.$new_window.' href="'.$url.'"><img style="margin-top: '.$this->opt['sidebar_widgets']['button_margin'].';margin-bottom: '.$this->opt['sidebar_widgets']['button_margin'].';max-width:'.$max_width.'px;width:100%;height:auto;" src="'.$button.'"></a>';
		
		
	}
	public function make_to_patreon_link_to_profile_p($url, $button, $margin=10, $max_width=200, $new_window=false)
	{
		if($new_window)
		{
			$new_window = ' target="_blank"';
			
		}
		else
		{
			$new_window='';
		
		}
		
		$url = $this->make_to_patreon_url($url);
		
		return '<a rel="nofollow"'.$new_window.' href="'.$url.'"><img style="margin-top: '.$this->opt['sidebar_widgets']['button_margin'].';margin-bottom: '.$this->opt['sidebar_widgets']['button_margin'].';max-width:'.$max_width.'px;width:100%;height:auto;" src="'.$button.'"></a>';
		
		
	}
	public function make_to_patreon_url_p($url)
	{
		// wrapper to add some params and filter the url.
		// For now we cant do that because patreon doesnt recognize urls with parameters
		// $url = add_query_arg( 'utm_content', 'patron_widgets_plugin_link', $url );
		
		return $url;
		
		
	}
	public function queue_modal_p($modal)
	{
		// This function queues modals as necessary. 

		// We want our styles in even if we arent on our own admin page:
	
		wp_enqueue_style( $this->internal['id'].'-css-admin', $this->internal['plugin_url'].'plugin/includes/css/admin.css' );
		
		add_action('admin_footer',array(&$this,'queue_footer_modal'));
	
		$this->internal['queue_modal']=$modal;
		$this->opt['queue_modal']=$modal;
		$this->update_opt();

		wp_enqueue_script( 'jquery-ui-dialog' ); 
		wp_enqueue_style( 'wp-jquery-ui-dialog' );
		
		wp_enqueue_script( $this->internal['id'].'-js-'.$modal, $this->internal['plugin_url'].'plugin/includes/scripts/'.$modal.'_modal.js' );
	
	}
	public function queue_footer_modal_p($v1)
	{
	
		include($this->internal['plugin_path'].'plugin/includes/'.$this->internal['queue_modal'].'_modal.php');
		
		$this->internal['setup_is_being_done']=true;
		
		if($this->internal['queue_modal']=='pro_pitch')
		{
			$this->opt['pro_pitch_done']=true;
		}
		$this->opt['queue_modal']=false;
		$this->update_opt();
	
	}
}


$cb_p6 = cb_p6_plugin::get_instance();

function cb_p6_get()
{

	// This function allows any plugin to easily retieve this plugin object
	return cb_p6_plugin::get_instance();

}

?>