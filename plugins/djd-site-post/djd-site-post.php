<?php
/*
Plugin Name: DJD Site Post
Plugin URI: http://www.djdesign.de/djd-site-post-plugin-en/
Description: Write, publish and edit posts on the front end
Version: 0.6
Author: Dirk Jarzyna
Author URI: http://www.djdesign.de
License: GPL2

  Copyright 2013 Dirk Jarzyna

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

if (!class_exists("DjdSitePost")) {
	class DjdSitePost {

	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/

	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	function __construct() {

		// Load plugin text domain
		add_action( 'init', array( $this, 'plugin_textdomain' ) );

		// Register admin styles and scripts
		//add_action( 'admin_print_styles', array( $this, 'register_admin_styles' ) );
		//add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );

		// Register site styles and scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_styles' ) );
		//add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_scripts' ) );

		// Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );
		register_uninstall_hook( __FILE__, array( 'djd-site-post', 'uninstall' ) );

		//Hooking in to setup admin settings page and settings menu
		add_action('admin_init', array($this, 'admin_init'));
		add_action('admin_menu', array($this, 'add_menu'));

		/**
		 * Custom actions
		 */

		// Hide Toolbar
		add_action('init', array($this, 'hide_toolbar'));
		 
		// Register a widget to show the post form in a sidebar
		add_action( 'widgets_init', array($this,'register_form_widget' ));

		// Turn output buffering on
		add_action('template_redirect', array($this, 'turn_on_output_buffer'));
		
		// Save an auto-draft to get a valid post-id
		add_action ('save_djd_auto_draft', array($this, 'save_djd_auto_draft'));

		/**
		 * Custom filter
		 */

		// Set default markup filter for html4 elements
		add_filter('form_markup', array($this, 'set_default_markup_filter'));

		// Print an edit post on front end link whenever an edit post link is printed on front end.
		// This will come with next (or pro) release to enable front end editting of existing posts.
		//add_filter('edit_post_link', array($this, 'edit_post_link'), 10, 2);

		//Call our shortcode handler
		add_shortcode('djd-site-post', array($this, 'handle_shortcode'));


	} // end constructor

	/**
	 * Fired when the plugin is activated.
	 *
	 * @param	boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog
	 */
	public function activate( $network_wide ) {
		$this->set_default_options();
	} // end activate

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @param	boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog
	 */
	public function deactivate( $network_wide ) {
		// TODO:	Define deactivation functionality here
	} // end deactivate

	/**
	 * Fired when the plugin is uninstalled.
	 *
	 * @param	boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog
	 */
	public function uninstall( $network_wide ) {
		// TODO:	Define uninstall functionality here
	} // end uninstall

	/**
	 * Loads the plugin text domain for translation
	 */
	public function plugin_textdomain() {
		$domain = 'djd-site-post';
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
		load_textdomain( $domain, WP_LANG_DIR.'/'.$domain.'/'.$domain.'-'.$locale.'.mo' );
		load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
	} // end plugin_textdomain

	/**
	 * Registers and enqueues admin-specific styles.
	 */
	public function register_admin_styles() {
		wp_enqueue_style( 'djd-site-post-admin-styles', plugins_url( 'djd-site-post/css/admin.css' ) );

	} // end register_admin_styles

	/**
	 * Registers and enqueues admin-specific JavaScript.
	 */
	public function register_admin_scripts() {
		wp_enqueue_script( 'djd-site-post-admin-script', plugins_url( 'djd-site-post/js/admin.js' ) );
	} // end register_admin_scripts

	/**
	 * Registers and enqueues plugin-specific styles.
	 */
	public function register_plugin_styles() {
		wp_enqueue_style( 'djd-site-post-styles', plugins_url( 'djd-site-post/css/display.css' ) );
	} // end register_plugin_styles

	/**
	 * Registers and enqueues plugin-specific scripts.
	 */
	public function register_plugin_scripts() {
		wp_enqueue_script( 'djd-site-post-script', plugins_url( 'djd-site-post/js/display.js' ) );
	} // end register_plugin_scripts
	
	
	/**
	 * Registers our post form widget.
	 */
	public function register_form_widget() {
		require(sprintf("%s/inc/djdsp-widget.php", dirname(__FILE__)));
		register_widget( 'djd_site_post_widget' );
	} // end register_form_widget

	/*
	 * Hook into WP's admin_init action hook
	 */
	public function admin_init() {
		// Set up the settings for this plugin
		$this->init_settings();
		// Possibly do additional admin_init tasks
	} // end public static function activate

	/*
	 * Setting default values and store them in db
	 */
     


	public function set_default_options() {
		$defaultAdminOptions = array(
			'djd-form-name' => '',
			'djd-publish-status' => 'publish',
			'djd-post-confirmation' => '',
			'djd-post-fail' => '',
			'djd-redirect' => '',
			'djd-mail' => '1',
			'djd-hide-toolbar' => '1',
			'djd-login-link' => '1',
			'djd-allow-guest-posts' => '0',
			'djd-guest-account' => '1',
			'djd-guest-cat-select' => '0',
			'djd-guest-cat' => '',
			'djd-categories' => 'list',
			'djd-default-category' => '1',
			'djd-allow-new-category' => '0',
			'djd-category-order' => 'id',
			'djd-title-required' => '1',
			'djd-show-excerpt' => '0',
			'djd-allow-media-upload' => '1',
			'djd-upload-no-content' => '1',
			'djd-show-tags' => '0',
			'djd-guest-info' => '1',
			'djd-title' => '',
			'djd-excerpt' => '',
			'djd-content' => '',
			'djd-editor-style' => 'rich',
			'djd-upload' => '',
			'djd-tags' => '',
			'djd-categories-label' => '',
			'djd-create-category' => '',
			'djd-send-button' => '');
		// Check for previous options that might be stored in db
		$dbOptions = get_option('djd_site_post_settings');
		if (!empty($dbOptions)) {
		foreach ($dbOptions as $key => $option)
			$defaultAdminOptions[$key] = $option;
		}
		update_option('djd_site_post_settings', $defaultAdminOptions);
	} // end set_default_options()

	/*
	 * Initialize some custom settings
	 */
	public function init_settings() {
		// Register the settings for this plugin
		register_setting('djd_site_post_template_group', 'djd_site_post_settings', array($this, 'djd_site_post_validate_input'));
	} // end public function init_custom_settings()

	/*
	 * Add a menu for our settings page
	 */
	public function add_menu() {
		add_options_page(__('DJD Site Post Settings', 'djd-site-post'), __('DJD Site Post', 'djd-site-post'), 'manage_options', 'djd-site-post-settings', array($this, 'plugin_settings_page'));
	} // end public function add_menu()

	/*
	 * Admin menu callback
	 */
	public function plugin_settings_page() {
		if(!current_user_can('manage_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.', 'djd-site-post'));
		}
		// Render the settings template
		include(sprintf("%s/views/admin.php", dirname(__FILE__)));
	} // end public function plugin_settings_page()

	/*
	 * Validate input
	 */
	public function djd_site_post_validate_input($input) {

		// Create our array for storing the validated options
		$output = array();

		// Loop through each of the incoming options
		foreach( $input as $key => $value ) {

		    // Check to see if the current option has a value. If so, process it.
		    if( isset( $input[$key] ) ) {
			// Strip all HTML and PHP tags and properly handle quoted strings
			$output[$key] = esc_attr(strip_tags( stripslashes( $input[ $key ] ) ) );
		    }
		}
		// Return the array processing any additional functions filtered by this action
		return apply_filters( 'djd_site_post_validate_input', $output, $input );
	}

	// Following two functions make sure that image attachment gets the right post-id
	public function djd_insert_media_fix( $post_id ) {
		global $djd_media_post_id;
		global $post_ID; 
	
		/* WordPress 3.4.2 fix */
		$post_ID = $post_id; 
	
		/* WordPress 3.5.1 fix */
		$djd_media_post_id = $post_id;
		add_filter( 'media_view_settings', array($this, 'djd_insert_media_fix_filter'), 10, 2 );
	}

	public function djd_insert_media_fix_filter( $settings, $post ) {
		global $djd_media_post_id;
	
		$settings['post']['id'] = $djd_media_post_id;
		$settings['post']['nonce'] = wp_create_nonce( 'update-post_' . $djd_media_post_id );
		return $settings;
	}
	
	/*---------------------------------------------*
	 * Core Functions
	 *---------------------------------------------*/

	/*
	 * Turn on output buffering if this is a response for a form submission (so we can set HTTP status)
	 * A hidden input element such as @name=_form_name_submitted is sent along with the name of the form.
	 */
	function turn_on_output_buffer(){
		if(isset($_REQUEST['_form_name_submitted']) && (int)method_exists( $this, $_REQUEST['_form_name_submitted'] )) {
			ob_start();
		}
	}

	/*
	 * Default filter which ensures that non-empty elements in HTML4 don't get serialized out as XML empty elements.
	 */
	function set_default_markup_filter($markup) {
		$emptyElements = array(
			'area', 'base', 'basefont', 'br', 'col', 'frame', 'hr', 'img', 'input', 'isindex', 'link', 'meta', 'param'
		);
		$regex = '{<(?!(?:' . join('|', $emptyElements) . ')\b)(\w+?\b)([^>]*?)/>}';
		return preg_replace($regex, '<$1$2></$1>', $markup);
	}

	/*
	 * Print a link to edit post on front end whenever an edit post link is printed on front end.
	 */
	function edit_post_link($link, $post_id) {
		$link = $link . ' | <a class="post-edit-link" href="' . home_url('/') . '?page_id=2" title="Frontend Edit">Frontend Edit</a>';
		return $link;
	}

	/*
	 * Serialize the form
	 */
	function serialize_form(&$doc, &$xpath){
		return apply_filters('form_markup', $doc->saveXML($doc->documentElement));
	}

	/*
	 * Format error messages for output.
	 */
	function format_error_msg($message, $type = '',  $source = ''){
		$html = '<p style="color:red"><em>';
		if(!$type)
			$type = __("Error", 'djd-site-post');
		$html .= "<strong>" . htmlspecialchars($type) . "</strong>: ";
		$html .= $message;
		$html .= '</em></p>';
		if($source){
			$html .= '<pre style="margin-left:5px; border-left:solid 1px red; padding-left:5px;"><code class="xhtml malformed">';
			$html .= htmlspecialchars($source);
			$html .= '</code></pre>';
		}
		return $html;
	}

	/*
	 * Hide the WordPress Toolbar.
	 */
	function hide_toolbar() {
		$djd_options = get_option('djd_site_post_settings');
		if ( $djd_options['djd-hide-toolbar'] ) {
			add_filter('show_admin_bar', '__return_false');
		}
	}

	/*
	 * Get current user info. If user is not logged in we check if guest posts are permitted and set variables accordingly.
	 */
	function verify_user() {
		$djd_userinfo = array ();
		$djd_options = get_option('djd_site_post_settings');

		if (is_user_logged_in()) {
			global $current_user;
			get_currentuserinfo();
			$djd_userinfo['djd_user_id'] = $current_user->ID;
			$djd_userinfo['djd_user_login'] = $current_user->user_login;
			if ( current_user_can('publish_posts') )
				$djd_userinfo['djd_can_publish_posts'] = true;
			if ( current_user_can('manage_categories') )
				$djd_userinfo['djd_can_manage_categories'] = true;
				
			if ( current_user_can('contributor') && !current_user_can('upload_files') ) {
				$contributor = get_role('contributor');
				$contributor->add_cap('upload_files');
				$djd_userinfo['media_upload'] = true;
			}
			return $djd_userinfo;

		} elseif ( (!is_user_logged_in()) && ($djd_options['djd-allow-guest-posts']) ) {
			$user_query = get_userdata($djd_options['djd-guest-account']);
			$djd_userinfo['djd_user_id'] = $user_query->ID;
			$djd_userinfo['djd_user_login'] = $user_query->user_login;
			
			// We give guests rights as a subscriber. Very limited, no media uploads.
			$djd_userinfo['djd_can_manage_categories'] = false;
			$djd_userinfo['djd_can_publish_posts'] = true;
			$djd_userinfo['publish_status'] = 'pending';
			$djd_userinfo['media_upload'] = false;

			return $djd_userinfo;
		}
		return false;
	} // end verify_user()

	function djd_check_user_role( $role, $user_id = null ) {
	 
		if ( is_numeric( $user_id ) )
			$user = get_userdata( $user_id );
		else
			$user = wp_get_current_user();
	 
		if ( empty( $user ) )
			return false;
		return in_array( $role, (array) $user->roles );
	}
	
	function save_djd_auto_draft() {
		global $djd_post_id;

		//Checking if auto-draft exists already
		$args = array(
			'numberposts' => 1,
			'post_type' => 'post',
			'post_status' => 'auto-draft',
			'suppress_filters' => true );
	
		if ($postslist = get_posts( $args )){
			foreach ($postslist as $post) {
				$djd_post_id = $post->ID;
			}
		} else {
		
		// Saving an auto-draft to get a post-id
		// Create post object with defaults
		$my_post = array(
			'ID' => '',
			'post_title' => 'DJD Auto-Save',
			'post_status' => 'auto-draft',
			'post_author' => $user_verified['djd_user_id'],
			'post_category' => '',
			'comment_status' => 'open',
			'ping_status' => 'open',
			'post_content' => '',
			'post_excerpt' => '',
			'post_type' => 'post',
			'tags_input' => '',
			'to_ping' =>  '' );
			
			$djd_post_id = wp_insert_post( $my_post );
		}
		// Getting the right post-id for media attachments
		$this->djd_insert_media_fix( $djd_post_id );
	}

	/*
	 * Registers the shortcode that has a required @name param indicating the function which returns the HTML code for the shortcode.
	 *
	 * Shortcode: [djd-site-post] With parameters: [djd-site-post success_url="url" success_page_id="id"]
	 * Parameters:
	 * 	success_url: URL of the page to redirect to after the post.
	 * 	success_page_id: ID of the page to redirect to after the post. Overwrites success_url if set.
	 */
	function handle_shortcode($atts, $content = null){

		global $shortcode_cache, $post, $djd_post_id;

		extract(shortcode_atts(array(
			'success_url' => '',
			'success_page_id' => 0,
			'called_from_widget' => '0',
		), $atts));
		$form_name = 'site_post_form';
		$djd_options = get_option('djd_site_post_settings');

		// Check for user logged in or guest posts permitted.
		if(!$user_verified = $this->verify_user())
			return $this->format_error_msg(__("Please login or register to use this function.", 'djd-site-post'),__("Notice", 'djd-site-post'));

		do_action ('save_djd_auto_draft');
			
		// Serve cached output if it has already been processed.
		if(!empty($shortcode_cache[$form_name]))
			return $shortcode_cache[$form_name];

		// success_page_id overwrites success_url.
		if($success_page_id)
			$success_url = get_permalink($success_page_id);

		// Shortcode 'success_url' attribute. This has priority over redirect set in admin panel.
		if(!$success_url) {
			$success_url = $djd_options['djd-redirect'];
			if (empty($success_url)) $success_url = home_url();
		}

		// Call the function and grab the results (if nothing, output a comment noting that it was empty).
		// This one calls the form presented to the user.
		$xhtml = call_user_func_array(array($this, $form_name), array($atts, $content, $user_verified, $called_from_widget));
		if(!$xhtml)
			return "<!-- form handler '$form_name' returned nothing -->";

		//Parse the form, return error if isn't well-formed.
		$doc = new DOMDocument();
		if(!$doc->loadXML('<?xml version="1.0" encoding="utf-8"?>' . $xhtml))
			return $this->format_error_msg(sprintf(__("The function <code>%s</code> did not return wellformed XML:", 'djd-site-post'), htmlspecialchars($form_name)), __('XML Parse Error', 'djd-site-post'), $xhtml);
		$xpath = new DOMXPath($doc);

		//Error: root element must be "form".
		if($doc->documentElement->nodeName != 'form')
			return $this->format_error_msg(sprintf(__("The function <code>%s</code> did not return valid XML. Root element must be <code>form</code>:", 'djd-site-post'), htmlspecialchars($atts['name'])), __('XML Wellformedness Error', 'djd-site-post'), $xhtml);
		$form = $doc->documentElement;

		//Add a hidden input which tells the server which form the request data is associated with.
		//This element is removed before processing.
		$formNameInput = $doc->createElement('input');
		$formNameInput->setAttribute('type', 'hidden');
		$formNameInput->setAttribute('name', '_form_name_submitted');
		$formNameInput->setAttribute('value', $form_name);
		$form->appendChild($formNameInput);

		//Set the default attributes on the FORM element
		if(!$form->hasAttribute('action'))
			$form->setAttribute('action', get_permalink());
		if(!$form->hasAttribute('method'))
			$form->setAttribute('method', 'post');
		if(!$form->hasAttribute('id'))
			$form->setAttribute('id', $form_name);

		//Populate the form with the values provided in the request
		$items = $this->populate_with_request_and_return_values($doc, $xpath);

		$invalidCount = 0;
		$invalidElements = array();

		//Allow the form to be customized
		do_action('form_before_validation', $form_name, $doc, $xpath);

		//Detect whether or not any of the elements are in error (only if the request method is the same as the form's method,
		//so that we can pre-fill form values for POST requests with GET parameters.)
		//Attention! If there are two forms on a page, this will fail!!
		if(strtoupper($doc->documentElement->getAttribute('method')) == $_SERVER['REQUEST_METHOD'] &&
			(($_SERVER['REQUEST_METHOD'] == 'POST' && @$_POST['_form_name_submitted'] == $form_name) ||
			($_SERVER['REQUEST_METHOD'] == 'GET'  && @$_GET['_form_name_submitted'] == $form_name)) ){
			//$validFileInputs = array();
			foreach($xpath->query("//*[@name and not(@disabled) and not(@readonly)]") as $input){
				//Skip the hidden self-identifying field
				if($input->getAttribute('name') == '_form_name_submitted')
					continue;

				$invalidTypes = array();
				$isToggle = ($input->getAttribute('type') == 'radio' || $input->getAttribute('type') == 'checkbox');

				if($input->nodeName == 'textarea')
					$value = (string)$input->textContent;
				else if($input->nodeName == 'select'){
					$selectedOption = $xpath->query(".//option[@selected]", $input)->item(0); //TODO: No multiple values supported
					if($selectedOption){
						$value = $selectedOption->hasAttribute('value') ? $selectedOption->getAttribute('value') : $selectedOption->textContent;
					}
					else {
						$value = null;
					}
				}
				else
					$value = (string)$input->getAttribute('value');

				//Required
				if($input->hasAttribute('required') && ($isToggle ? !$input->hasAttribute('checked') : !$value)){
					$invalidTypes[] = 'valueMissing';
				}
				else if($value) {
					//Pattern
					if($value && $input->getAttribute('pattern') && !preg_match('/^(?:' . $input->getAttribute('pattern') . ')$/', $value)){
						$invalidTypes[] = 'patternMismatch';
					}

					//Maxlenght
					if((int)$input->getAttribute('maxlength') && mb_strlen($value, 'utf-8') > (int)$input->getAttribute('maxlength')){
						$invalidTypes[] = 'tooLong';
					}

					//Input types
					switch($input->getAttribute('type')){
						case 'email':
							if(!preg_match('/.+@.+(\.\w+)$/', $value)){
								$invalidTypes[] = 'typeMismatch';
							}
							break;
						case 'range':
						case 'number':
							$value = trim($value);
							//Verify value
							if(!preg_match('/^-?\d+(\.\d+)?$/', $value)){
								$invalidTypes[] = 'typeMismatch';
							}
							else {
								$value = floatval($value);

								//Min
								if($input->hasAttribute('min')){
									$min = floatval($input->getAttribute('min'));
									if((float)$min > $value)
										$invalidTypes[] = 'rangeUnderflow';
								//Max
								}
								else if($input->hasAttribute('max')){
									$max = floatval($input->getAttribute('max'));
									if((float)$max < $value)
										$invalidTypes[] = 'rangeOverflow';
								}
							}
							if(!preg_match('/\d+/', $value)) #TODO: make this more robust
								$invalidTypes[] = 'typeMismatch';
							break;
						case 'url':
							if(!preg_match('{^http://.+}', $value))
								$invalidTypes[] = 'typeMismatch';
							break;

						#TODO: More input types
					}
				}

				//Custom Validity
				$validationMessage = apply_filters('form_control_custom_validity', $input->getAttribute('data-validationMessage'), $input, $form_name, $doc, $xpath);
				if($validationMessage){
					$input->setAttribute('data-validationMessage', $validationMessage);
					$invalidTypes[] = 'customError';
				}
				//Set the state of the input if it is invalid
				if(!empty($invalidTypes)){
					$input->setAttribute('class', $input->getAttribute('class') . ' invalid');
					$invalidElements[] = $input;
					$input->setAttribute('data-invalidity', join(' ', $invalidTypes));
					$invalidCount++;
				}

			} //foreach

			//Get custom form validity
			$error_message = '';
			$formValid = !count($invalidElements);
			if($formValid) {
				$error_message = apply_filters('form_custom_validity', '', $form_name, $doc, $xpath);
				if($error_message)
					$formValid = false;
			}

			//If there is an invalid element, then the form is invalid; autofocus on it
			if(!$formValid){
				@status_header(400);
				$form->setAttribute('class', $form->getAttribute('class') . ' form_error_400');

				//Remove any existing autofocus, and set it on the first invalid element
				foreach($xpath->query("//*[@autofocus]") as $input)
					$input->removeAttribute('autofocus');
				if(count($invalidElements))
					$invalidElements[0]->setAttribute('autofocus','autofocus');

				if(!$error_message){
					if(count($invalidElements) == 1)
						$error_message = __('There was an error with your form submission.', 'djd-site-post');
					else
						$error_message = __('There were errors with your form submission.', 'djd-site-post');
				}
				$error_message = apply_filters('form_error_message', $error_message, $form_name, $invalidElements, $doc, $xpath);
				do_action('form_error', $form_name, $error_message, $doc, $xpath);
				populate_errors($doc, $xpath, $error_message);

				do_action('form_complete', $form_name);
				return $this->serialize_form($doc, $xpath);
			} else {
				try {	//Try processing the data

					$success = true;

					//Write post entry

					// Create post object with defaults
					$my_post = array(
						//If we have an ID we are updating an existing post
						//'ID' => '',
						'ID' => $djd_post_id,
						'post_title' => '',
						'post_status' => 'publish',
						'post_author' => '',
						'post_category' => '',
						'comment_status' => 'open',
						'ping_status' => 'open',
						'post_content' => '',
						'post_excerpt' => '',
						'post_type' => 'post',
						'tags_input' => '',
						'to_ping' =>  '' );

					//Fill our $my_post array
					$my_post['post_title'] = wp_strip_all_tags($_POST['djd_site_post_title']);
					if( array_key_exists('djd_site_post_content', $_POST)) {
						$my_post['post_content'] = $_POST['djd_site_post_content'];
					}
					if( array_key_exists('djd_site_post_excerpt', $_POST)) {
						$my_post['post_excerpt'] = wp_strip_all_tags($_POST['djd_site_post_excerpt']);
					}
					if( array_key_exists('djd_site_post_select_category', $_POST)) {
						$ourCategory = 	array($_POST['djd_site_post_select_category']);
					}
					if( array_key_exists('djd_site_post_checklist_category', $_POST)) {
						$ourCategory = 	$_POST['djd_site_post_checklist_category'];
					}
					if( array_key_exists('djd_site_post_new_category', $_POST)) {
						if (!empty( $_POST['djd_site_post_new_category']) ) {
							require_once(WP_PLUGIN_DIR . '/../../wp-admin/includes/taxonomy.php');
							if ($newCatId = wp_create_category(wp_strip_all_tags($_POST['djd_site_post_new_category']))) {
								$ourCategory = 	array($newCatId);
							} else {
								throw new Exception(__('Unable to create new category. Please try again or select an existing category.', 'djd-site-post'));
							}
						}
					}
					
					if ( ! is_user_logged_in() && ! $djd_options['djd-guest-cat-select'] ) {
						$ourCategory = array( $djd_options['djd-guest-cat'] );
					}
					
					$my_post['post_category'] = $ourCategory;
					$my_post['post_author'] = $user_verified['djd_user_id'];

					if( array_key_exists('djd_site_post_tags', $_POST)) {
						$my_post['tags_input'] = wp_strip_all_tags($_POST['djd_site_post_tags']);
					}
					if( $djd_options['djd-publish-status']) {
						$my_post['post_status'] = $djd_options['djd-publish-status'];
					}
					// Insert the post into the database
					$post_success = wp_insert_post( $my_post );
					
					if( array_key_exists('djd_site_post_guest_name', $_POST)) {
						add_post_meta( $post_success, 'guest_name', wp_strip_all_tags($_POST['djd_site_post_guest_name']), true ) || update_post_meta( $post_success, 'guest_name', wp_strip_all_tags($_POST['djd_site_post_guest_name']) );
					}
					if( array_key_exists('djd_site_post_guest_email', $_POST)) {
						add_post_meta( $post_success, 'guest_email', wp_strip_all_tags($_POST['djd_site_post_guest_email']), true ) || update_post_meta( $post_success, 'guest_name', wp_strip_all_tags($_POST['djd_site_post_guest_name']) );
					}
					
					if(apply_filters('form_abort_on_failure', true, $form_name))
						$success = $post_success;
					if($success){
						if($djd_options['djd-mail']) {
							$this->djd_sendmail($post_success, wp_strip_all_tags($_POST['djd_site_post_title']));
						}
						$formSerialized = $return_message;
						$success_url = apply_filters('form_success_url', $success_url, $form_name, $doc, $xpath);
						do_action('form_success', $form_name, $success_url, $doc, $xpath);

						if($success_url) {
							wp_redirect($success_url); exit;
						}
					}
					else {
						throw new Exception( $djd_options['djd-post-fail'] ? $djd_options['djd-post-fail'] : __('We were unable to accept your post at this time. Please try again. If the problem persists tell the site owner.', 'djd-site-post'));
					}
					do_action('form_complete', $form_name);
					return $formSerialized;
				}
				catch(Exception $e){
					do_action('form_error', $form_name, $e->getMessage(), $doc, $xpath, $e);
					@status_header(500);
					$form->setAttribute('class', $form->getAttribute('class') . ' form_error_500');
					$this->djd_populate_errors($doc, $xpath, $e->getMessage());

					//Set the autofocus on the submit button (this only works if there is only one submit button! TODO)
					$submit = $xpath->query('//*[@type = "submit"]')->item(0);
					if($submit){
						foreach($xpath->query("//*[@autofocus]") as $input)
							$input->removeAttribute('autofocus');
						$submit->setAttribute('autofocus','autofocus');
					}
					do_action('form_complete', $form_name);
					return $this->serialize_form($doc, $xpath);
				}
			}
		}
		else {
			return $this->serialize_form($doc, $xpath);
		}
	}

	/**
	 * Populate the form with the error message
	 */
	function djd_populate_errors(&$doc, &$xpath, $message){
		$containers = $xpath->query('//*[contains(@class, "form_error_message")]');
		if($containers->length){
			foreach($containers as $container){
				while($container->firstChild)
					$container->removeChild($container->firstChild);
				$em = $doc->createElement('em');
				$em->appendChild($doc->createTextNode($message));
				$container->appendChild($em);

				//Make sure that it's visible
				$container->removeAttribute('hidden');
				if($container->hasAttribute('style'))
					$container->setAttribute('style', preg_replace('/display:\s*none\s*;?|visibility:\s*hidden\s*;?/i', '', $container->getAttribute('style')));
			}
		}
		else {
			$notice = $doc->createElement('p');
			$notice->setAttribute('class', 'form_error_message');
			$em = $doc->createElement('em');
			$em->appendChild($doc->createTextNode($message));
			$notice->appendChild($em);
			$doc->documentElement->insertBefore($notice, $doc->documentElement->firstChild);
		}
	}

	/**
	 * Populate the form with the values present in the request
	 */
	function populate_with_request_and_return_values(&$doc, &$xpath){

		if($_SERVER['REQUEST_METHOD'] == 'POST')
			$request = &$_POST;
		else if($_SERVER['REQUEST_METHOD'] == 'GET')
			$request = &$_GET;
		else
			return null;

		$items = array();

		$populatedValues = 0;

		//Strip magic quotes
		$request = stripslashes_deep((array)$request);

		//Iterate over the request name/value pairs
		foreach($request as $attrName => $attrValue){
			//Skip the hidden self-identifying field
			if($attrName == '_form_name_submitted')
				continue;

			$items[$attrName] = array();

			/*** Array values *********************************************/
			if(is_array($attrValue)){

				$originalAttrValue = (array) $attrValue;

				//Iterate over all form elements with the current name
				$inputs = $xpath->query("//*[@name='{$attrName}[]']");
				if(!$inputs->length)
					continue;
				$populatedValues++;

				//$inputValue = '';
				foreach($inputs as $input){
					switch($input->nodeName){
						//Input elements
						case 'input':
							switch($input->getAttribute('type')){
								case 'checkbox':
								case 'radio':
									if($input->getAttribute('value') == @$attrValue[0] || (!$input->hasAttribute('value') && @$attrValue[0] == 'on')){
										$input->setAttribute('checked','checked');
										@array_shift($attrValue);
									}
									else {
										$input->removeAttribute('checked');
									}
									break;
								default:
									$input->setAttribute('value', @$attrValue[0]);
									@array_shift($attrValue);
									break;
							}
							break;
						//Textarea element
						case 'textarea':
							while($input->firstChild)
								$input->removeChild($input->firstChild);
							if(@$attrValue[0]){
								$input->appendChild($doc->createTextNode(@$attrValue[0]));
								@array_shift($attrValue);
							}
							break;
						//Select element
						case 'select':
							$options = $input->getElementsByTagName('option');
							if($options->length){
								foreach($options as $option){
									//If the OPTION has a @value
									if($option->hasAttribute('value')){
										if($option->getAttribute('value') == @$attrValue[0]){
											$option->setAttribute('selected','selected');
											@array_shift($attrValue);
										}
										else {
											$option->removeAttribute('selected');
										}
									}
									//If value passed from child node
									else {
										if((!@$attrValue[0] && !$option->firstChild) || ($option->firstChild && $option->firstChild->nodeValue == @$attrValue[0])){
											$option->setAttribute('selected','selected');
											@array_shift($attrValue);
										}
										else
											$option->removeAttribute('selected');
									}
								}
							}
							break;
					}

					$isRadioOrCheckbox = ($input->getAttribute('type') == 'radio' || $input->getAttribute('type') == 'checkbox');
					if(!$isRadioOrCheckbox || $input->hasAttribute('checked')){
						$item = array(
							'value' => $input->getAttribute('value'),
							'label' => '',
							'input' => $input );
						if($input->nodeName == 'button' || $input->getAttribute('type') == 'submit')
							$item['label'] = $input;
						else #if(!$isRadioOrCheckbox)
							$item['label'] = $xpath->query("//label[@for = '" . $input->getAttribute('id') . "']")->item(0);
						$items[$attrName][] = $item;
					}
				}
			}
			/*** Scalar values *********************************************/
			else {
				$inputs = $xpath->query("//*[@name='$attrName']");
				if($inputs->length){ //== 1
					$populatedValues++;
					foreach($inputs as $input){
						switch($input->nodeName){
							//INPUT elements
							case 'input':
								switch($input->getAttribute('type')){
									case 'checkbox':
									case 'radio':
										if($input->getAttribute('value') == @$attrValue || (!$input->hasAttribute('value') && @$attrValue == 'on')) //if($input->getAttribute('value') == $attrValue)
											$input->setAttribute('checked','checked');
										else
											$input->removeAttribute('checked');
										break;
									default:
										$input->setAttribute('value', $attrValue);
										break;
								}
								break;
							//Textarea element
							case 'textarea':
								while($input->firstChild)
									$input->removeChild($input->firstChild);
								$input->appendChild($doc->createTextNode($attrValue));
								break;
							//Select element
							case 'select':
								$options = $input->getElementsByTagName('option');
								if($options->length){
									foreach($options as $option){
										//If the OPTION has a @value
										if($option->hasAttribute('value')){
											if($option->getAttribute('value') == $attrValue)
												$option->setAttribute('selected','selected');
											else
												$option->removeAttribute('selected');
										}
										//If value passed from child node
										else {
											if((!$attrValue && !$option->firstChild) || ($option->firstChild && $option->firstChild->nodeValue == $attrValue))
												$option->setAttribute('selected','selected');
											else
												$option->removeAttribute('selected');
										}
									}
								}
								break;
						}

						$isRadioOrCheckbox = ($input->getAttribute('type') == 'radio' || $input->getAttribute('type') == 'checkbox');
						if(!$isRadioOrCheckbox || $input->hasAttribute('checked')){
							$item = array(
								'value' => $attrValue,
								'label' => '',
								'input' => $input );
							if($input->nodeName == 'button' || $input->getAttribute('type') == 'submit')
								$item['label'] = $input;
							else #if(!$isRadioOrCheckbox)
								$item['label'] = $xpath->query("//label[@for = '" . $input->getAttribute('id') . "']")->item(0);
							$items[$attrName][] = $item;
						}
					}
				}
			}

		} //end foreach

		if($populatedValues)
			$doc->documentElement->setAttribute('class', $doc->documentElement->getAttribute('class') . " form_populated");
		return $items;
	}

	/**
	 * Print the post form at the front end
	 */
	function site_post_form($attrs, $content = null, $verified_user, $called_from_widget){
		ob_start();
		global $current_user; //Global WordPress variable that stores what get_currentuserinfo() returns.
		get_currentuserinfo();
		$djd_options = get_option('djd_site_post_settings'); //Read the plugin's settings out of wpdb table wp_options.

		// Render the form html
		
		include_once (sprintf("%s/views/display.php", dirname(__FILE__)));

		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}

	/**
	 * Notify admin about new post via email
	 */
	function djd_sendmail ($post_id, $post_title) {
		$blogname = get_option('blogname');
		$email = get_option('admin_email');
		$headers = "MIME-Version: 1.0\r\n" . "From: ".$blogname." "."<".$email.">\n" . "Content-Type: text/HTML; charset=\"" . get_settings('blog_charset') . "\"\r\n";
		$content = '<p>'.__('New post submitted from frontend to', 'djd-site-post').' '.$blogname.'.'.'<br/>' .__('To view the entry click here:', 'djd-site-post') . ' '.'<a href="'.get_permalink($post_id).'"><strong>'.$post_title.'</strong></a></p>';
		wp_mail($email, __('New frontend post to', 'djd-site-post') . ' ' . $blogname . ': ' . $post_title, $content, $headers);
	}
    } // end class
} // end if (!class_exists)

$djd_site_post = new DjdSitePost();
