<?php
/**
 * Get/Define theme settings
 *
 */

$theme_version = '';
$pgbo_output = '';

if( function_exists( 'wp_get_theme' ) ) {
	
    if( is_child_theme() ) {
		$temp_obj = wp_get_theme();
		$theme_obj = wp_get_theme( $temp_obj->get('Template') );
	} else {
		$theme_obj = wp_get_theme();    
	}

	$theme_version = $theme_obj->get('Version');
	$theme_name = $theme_obj->get('Name');
	$theme_uri = $theme_obj->get('ThemeURI');
	$author_uri = $theme_obj->get('AuthorURI');

} else {

	$theme_data = get_theme_data( get_template_directory().'/style.css' );
	$theme_version = $theme_data['Version'];
	$theme_name = $theme_data['Name'];
	$theme_uri = $theme_data['ThemeURI'];
	$author_uri = $theme_data['AuthorURI'];

}


if( !defined('ADMIN_PATH') )
	define( 'ADMIN_PATH', get_template_directory() . '/includes/' );

if( !defined('ADMIN_DIR') )
	define( 'ADMIN_DIR', get_template_directory_uri() . '/includes/' );

define( 'ADMIN_IMAGES', ADMIN_DIR . 'admin/images/' );

define( 'LAYOUT_PATH', ADMIN_PATH . 'layouts/' );
define( 'THEMENAME', $theme_name );

/* Theme version, uri, and the author uri are not completely necessary, but may be helpful in adding functionality */
define( 'THEMEVERSION', $theme_version );
define( 'THEMEURI', $theme_uri );
define( 'THEMEAUTHORURI', $author_uri );

define( 'BACKUPS','backups' );

require_once ( ADMIN_PATH . 'admin/class.pgb_options.php' );
require_once ( ADMIN_PATH . 'admin/functions.load.php' );

add_action('admin_init','progobaseframework_admin_init');
add_action('admin_menu', 'progobaseframework_add_admin');

add_action('wp_ajax_pgb_ajax_post_action', 'pgb_ajax_callback');