<?php
/*
Plugin Name: Labeffect Custom Menu
Description: A little plugin to add attributes to WordPress menus
Version: 0.1
Author: Jay Chow
Author URI: http://labeffect.com
Text Domain: le_cm
Domain Path: languages
*/
class le_custom_menu {

    /*--------------------------------------------*
     * Constructor
     *--------------------------------------------*/

    /**
     * Initializes the plugin by setting localization, filters, and administration functions.
     */
    function __construct() {
        // save menu custom fields
        add_action( 'wp_update_nav_menu_item', array( $this, 'le_cm_update_custom_nav_fields'), 10, 3 );

        // edit menu walker
        add_filter( 'wp_edit_nav_menu_walker', array( $this, 'le_cm_edit_walker'), 10, 2 );

    } // end constructor

    /* All functions will be placed here */
    /**
     * Add custom fields to $item nav object
     * in order to be used in custom Walker
     *
     * @access      public
     * @since       1.0
     * @return      void
     */
    function le_cm_add_custom_nav_fields( $menu_item ) {

        $menu_item->faicon = get_post_meta( $menu_item->ID, '_menu_item_faicon', true );
        return $menu_item;

    }
    /**
     * Save menu custom fields
     *
     * @access      public
     * @since       1.0
     * @return      void
     */
    function le_cm_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {

        // Check if element is properly sent
        if ( is_array( $_REQUEST['menu-item-faicon']) ) {
            $faicon_value = $_REQUEST['menu-item-faicon'][$menu_item_db_id];
            update_post_meta( $menu_item_db_id, '_menu_item_faicon', $faicon_value );
        }

    }

    /**
     * Define new Walker edit
     *
     * @access      public
     * @since       1.0
     * @return      void
     */
    function rc_scm_edit_walker($walker,$menu_id) {

        return 'Walker_Nav_Menu_Edit_Custom';

    }

}
// instantiate plugin's class
$GLOBALS['labeffect_custom_menu'] = new le_custom_menu();
include_once( 'edit_custom_walker.php' );
include_once( 'custom_walker.php' );