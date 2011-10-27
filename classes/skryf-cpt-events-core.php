<?php
// SCPTE core class
class SkryfCptEvents {
	
	function SkryfCptEvents() {
		$this->__construct();
	} // function
	
	function __construct() {

		 // Init custom post type
		add_action("init", array(&$this, "init_cpt"));
		
		// Init taxonomies
		add_action("init", array(&$this, "init_ctax"));
		
		// Init metaboxes
		add_action("add_meta_boxes", array(&$this, "init_meta"));
		
		// Register admin scripts
		add_action("admin_init", array(&$this, "register_scripts_css"));
		
	} // function
	
	static function init_cpt() { // Create custom post type
		
		$labels = array(
			'name' => _x('Events', 'post type general name', 'skryf-cpt-events'),
			'singular_name' => _x('Event', 'post type singular name', 'skryf-cpt-events'),
			'add_new' => _x('Add New', 'event', 'skryf-cpt-events'),
			'add_new_item' => __('Add New Event', 'skryf-cpt-events'),
			'edit_item' => __('Edit Event', 'skryf-cpt-events'),
			'new_item' => __('New Event', 'skryf-cpt-events'),
			'all_items' => __('All Events', 'skryf-cpt-events'),
			'view_item' => __('View Event', 'skryf-cpt-events'),	
			'search_items' => __('Search Events', 'skryf-cpt-events'),
			'not_found' =>  __('No events found', 'skryf-cpt-events'),
			'not_found_in_trash' => __('No events found in Trash', 'skryf-cpt-events'), 
			'parent_item_colon' => '',
			'menu_name' => __('Events', 'skryf-cpt-events')
		);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'show_in_menu' => true, 
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'has_archive' => true, 
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array('title','editor','author','thumbnail','excerpt','comments','trackbacks')
		); 

		register_post_type('skryf_cpt_events',$args);		
				
	}
	
	static function init_ctax() { // Create taxonomies
	
		// Make new Category taxonomy for event
		$labels = array(
			'name' => _x( 'Categories', 'taxonomy general name', 'skryf-cpt-events' ),
			'singular_name' => _x( 'Category', 'taxonomy singular name', 'skryf-cpt-events' ),
			'search_items' =>  __( 'Search Categories', 'skryf-cpt-events' ),
			'all_items' => __( 'All Categories', 'skryf-cpt-events' ),
			'parent_item' => __( 'Parent Category', 'skryf-cpt-events' ),
			'parent_item_colon' => __( 'Parent Category:', 'skryf-cpt-events' ),
			'edit_item' => __( 'Edit Category', 'skryf-cpt-events' ), 
			'update_item' => __( 'Update Category', 'skryf-cpt-events' ),
			'add_new_item' => __( 'Add New Category', 'skryf-cpt-events' ),
			'new_item_name' => __( 'New Category Name', 'skryf-cpt-events' ),
			'menu_name' => __( 'Category', 'skryf-cpt-events' ),
		); 	
		
		register_taxonomy('skryf_cpt_events_category',array('skryf_cpt_events'), array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'event-category' ),
		));
		
		// Make Tags taxonomy for event
		$labels = array(
			'name' => _x( 'Tags', 'taxonomy general name', 'skryf-cpt-events' ),
			'singular_name' => _x( 'Tag', 'taxonomy singular name', 'skryf-cpt-events' ),
			'search_items' =>  __( 'Search Tags', 'skryf-cpt-events' ),
			'popular_items' => __( 'Popular Tags', 'skryf-cpt-events' ),
			'all_items' => __( 'All Tags', 'skryf-cpt-events' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Tag', 'skryf-cpt-events' ), 
			'update_item' => __( 'Update Tag', 'skryf-cpt-events' ),
			'add_new_item' => __( 'Add New Tag', 'skryf-cpt-events' ),
			'new_item_name' => __( 'New Tag Name', 'skryf-cpt-events' ),
			'separate_items_with_commas' => __( 'Separate tags with commas', 'skryf-cpt-events' ),
			'add_or_remove_items' => __( 'Add or remove tags', 'skryf-cpt-events' ),
			'choose_from_most_used' => __( 'Choose from the most used tags', 'skryf-cpt-events' ),
			'menu_name' => __( 'Tags', 'skryf-cpt-events' ),
		); 
		
		register_taxonomy('skryf_cpt_events_tag','skryf_cpt_events',array(
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var' => true,
			'rewrite' => array( 'slug' => 'event-tag' ),
		));	

	}
	
	static function register_scripts_css() {

	    global $pagenow, $typenow;
		// Fix to get $pagenow and $typenow during the admin_init hook
	    if (empty($typenow) && !empty($_GET['post'])) {
	        $post = get_post($_GET['post']);
	        $typenow = $post->post_type;
	    }
		
		
		// Register scripts in full or minified version based on the SCRIPT_DEBUG constant
		if(defined('SCRIPT_DEBUG') && SCRIPT_DEBUG == true) {
			
			wp_register_script('jquery-ui-widget', SKRYF_CPT_EVENTS_URI . '/scripts/jquery.ui.widget.js', array('jquery', 'jquery-ui-core'), '1.8.12');
			wp_register_script('jquery-ui-mouse', SKRYF_CPT_EVENTS_URI . '/scripts/jquery.ui.mouse.js', array('jquery', 'jquery-ui-core', 'jquery-ui-widget'), '1.8.12');
			wp_register_script('jquery-ui-slider', SKRYF_CPT_EVENTS_URI . '/scripts/jquery.ui.slider.js', array('jquery', 'jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-mouse'), '1.8.12');
			wp_register_script('jquery-ui-datepicker', SKRYF_CPT_EVENTS_URI . '/scripts/jquery.ui.datepicker.js', array('jquery', 'jquery-ui-core'), '1.8.12');
			wp_register_script('jquery-ui-timepicker', SKRYF_CPT_EVENTS_URI . '/scripts/jquery.ui.timepicker.js', array('jquery', 'jquery-ui-core', 'jquery-ui-datepicker', 'jquery-ui-slider', 'jquery-ui-widget'), '0.9.7');
			wp_register_script('skryf-cpt-events-core', SKRYF_CPT_EVENTS_URI . '/scripts/skryf.cpt.events.core.js', array('jquery', 'jquery-ui-core', 'jquery-ui-datepicker', 'jquery-ui-timepicker', 'jquery-ui-slider', 'jquery-ui-widget'), '1.0');
			
		}
		else {
			
			wp_register_script('jquery-ui-widget', SKRYF_CPT_EVENTS_URI . '/scripts/jquery.ui.widget.min.js', array('jquery', 'jquery-ui-core'), '1.8.12');
			wp_register_script('jquery-ui-mouse', SKRYF_CPT_EVENTS_URI . '/scripts/jquery.ui.mouse.min.js', array('jquery', 'jquery-ui-core', 'jquery-ui-widget'), '1.8.12');
			wp_register_script('jquery-ui-slider', SKRYF_CPT_EVENTS_URI . '/scripts/jquery.ui.slider.min.js', array('jquery', 'jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-mouse'), '1.8.12');
			wp_register_script('jquery-ui-datepicker', SKRYF_CPT_EVENTS_URI . '/scripts/jquery.ui.datepicker.min.js', array('jquery', 'jquery-ui-core'), '1.8.12');
			wp_register_script('jquery-ui-timepicker', SKRYF_CPT_EVENTS_URI . '/scripts/jquery.ui.timepicker.min.js', array('jquery', 'jquery-ui-core', 'jquery-ui-datepicker', 'jquery-ui-slider', 'jquery-ui-widget'), '0.9.7');
			wp_register_script('skryf-cpt-events-core', SKRYF_CPT_EVENTS_URI . '/scripts/skryf.cpt.events.core.js', array('jquery', 'jquery-ui-core', 'jquery-ui-datepicker', 'jquery-ui-slider', 'jquery-ui-widget', 'jquery-ui-timepicker'), '1.0'); // OPTIMIZE: Add minified version of core script on launch
			
		}
		
		// Register styles
		wp_register_style('jquery-ui-core', SKRYF_CPT_EVENTS_URI . '/css/jquery.ui.core.css', NULL, '1.8.12');
		wp_register_style('jquery-ui-theme', SKRYF_CPT_EVENTS_URI . '/css/jquery.ui.theme.css', array('jquery-ui-core'), '1.8.12');
		wp_register_style('jquery-ui-slider', SKRYF_CPT_EVENTS_URI . '/css/jquery.ui.slider.css', array('jquery-ui-core', 'jquery-ui-theme'), '1.8.12');
		wp_register_style('jquery-ui-datepicker', SKRYF_CPT_EVENTS_URI . '/css/jquery.ui.datepicker.css', array('jquery-ui-core'), '1.8.12');
		wp_register_style('jquery-ui-timepicker', SKRYF_CPT_EVENTS_URI . '/css/jquery.ui.timepicker.css', array('jquery-ui-core', 'jquery-ui-datepicker', 'jquery-ui-slider'), '0.9.7');
		wp_register_style('skryf-cpt-events-admin', SKRYF_CPT_EVENTS_URI . '/css/skryf.cpt.events.admin.css', array('jquery-ui-core', 'jquery-ui-datepicker', 'jquery-ui-timepicker', 'jquery-ui-slider'), '1.0');

		if (is_admin() && $pagenow=='post-new.php' OR $pagenow=='post.php' && $typenow=='skryf_cpt_events') { // Load only on the skryf_cpt_events pages
			
			wp_enqueue_script('skryf-cpt-events-core');
			wp_enqueue_style('skryf-cpt-events-admin');
			
		}
		
	}
	
	static function init_meta() {
		
		add_meta_box('skryf-cpt-events-meta', __('Time and place'), array('SkryfCptEvents', 'timeplace_meta'), 'skryf_cpt_events', 'side', 'high');
		
	}
	
	static function timeplace_meta() {
		require_once(SKRYF_CPT_EVENTS_DIR . "/meta/timeplace.php");
	}

}