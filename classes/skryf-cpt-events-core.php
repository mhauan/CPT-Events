<?php
// SCPTE core class
class SkryfCptEvents {
	
	function __construct() {
		
		 // Init custom post type
		$this->init_cpt();
		
		// Init taxonomies
		$this->init_ctax();
		
	}
	
	private function init_cpt() { // Create custom post type
		
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
			'supports' => array('title','editor','author','thumbnail','excerpt','comments')
		); 

		register_post_type('skryf_cpt_events',$args);		
				
	}
	
	private function init_ctax() { // Create taxonomies
	
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

}