<?php
/**
 * Sweet Sassy Molassy.
 *
 * This file adds functions to the Sweet Sassy Molassy Theme.
 *
 * @package Sweet Sassy Molassy
 * @author  Andy Stitt
 * @license GPL-2.0+
 * @link    http://andystitt.com/
 */

//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'sweet-sassy-molassy', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'sweet-sassy-molassy' ) );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Sweet Sassy Molassy' );
define( 'CHILD_THEME_URL', 'https://github.com/andystitt829/sweetsassymolassy' );
define( 'CHILD_THEME_VERSION', '1.0.0' );

//* Enqueue Scripts and Styles
add_action( 'wp_enqueue_scripts', 'ssm_enqueue_scripts_styles' );
function ssm_enqueue_scripts_styles() {

	wp_enqueue_style( 'sweet-sassy-molassy-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css' );
	wp_enqueue_script( 'sweet-sassy-molassy-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );
	$output = array(
		'mainMenu' => __( 'Menu', 'sweet-sassy-molassy' ),
		'subMenu'  => __( 'Menu', 'sweet-sassy-molassy' ),
	);
	wp_enqueue_script( 'bootstrap-js', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), true);		wp_localize_script( 'sweet-sassy-molassy-responsive-menu', 'sweetsassyMolassyL10n', $output );

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

//* Add Accessibility support
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'width'           => 600,
	'height'          => 160,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Add Image Sizes
add_image_size( 'featured-image', 720, 400, TRUE );

//* Unregister content/sidebar/sidebar layout setting
genesis_unregister_layout( 'content-sidebar-sidebar' );
 
//* Unregister sidebar/sidebar/content layout setting
genesis_unregister_layout( 'sidebar-sidebar-content' );
 
//* Unregister sidebar/content/sidebar layout setting
genesis_unregister_layout( 'sidebar-content-sidebar' );

//* Rename primary and secondary navigation menus
add_theme_support( 'genesis-menus' , array( 'primary' => __( 'After Header Menu', 'sweet-sassy-molassy' ), 'secondary' => __( 'Footer Menu', 'sweet-sassy-molassy' ) ) );

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

//* Reduce the secondary navigation menu to one level depth
add_filter( 'wp_nav_menu_args', 'ssm_secondary_menu_args' );
function ssm_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

//* Modify size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'ssm_author_box_gravatar' );
function ssm_author_box_gravatar( $size ) {

	return 90;

}

//* Modify size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'ssm_comments_gravatar' );
function ssm_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}
