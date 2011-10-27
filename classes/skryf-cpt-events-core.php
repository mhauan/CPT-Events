<?php
// SCPTE core class
class SkryfCptEvents {
	
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
	
}