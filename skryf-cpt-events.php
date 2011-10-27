<?php
/*
Plugin Name: Skryf Custom Post Type Events
Version: 1.0dev
Author: Morten Hauan
Author URI: http://hauan.me
*/

/*
DEFINE CONSTANTS
*/
define('SKRYF_CPT_EVENTS_VERSION', '1.0dev');
define('SKRYF_CPT_EVENTS_DIR', dirname(__FILE__));
define('SKRYF_CPT_EVENTS_URI', plugins_url(NULL, __FILE__));

// Set to true for debuging
define('SKRYF_DEBUG', true);

// Define finished localizations
define('SKRYF_CPT_EVENTS_LOCALE', serialize(array("en_US", "nb_NO")));


/*
LOAD LOCALIZATION FILES
*/
load_plugin_textdomain( 'skryf-cpt-events', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );


/*
INCLUDE CORE FILES
*/
require_once("classes/skryf-cpt-events-core.php"); // Core class



/*
INIT PLUGIN
*/

// Make global
global $skryf_cpt_events;
$skryf_cpt_events = new SkryfCptEvents();
