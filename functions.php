<?php
/*
 *  Author: Ivan
 */

global $theme_name;
$theme_name = 'photo';


foreach ( glob( get_template_directory() . '/lib/*/functions.php') as $lib_functions ) {
	include_once( $lib_functions );
}
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

//Se se quiere menus, descomentar
/*
if ( function_exists( 'register_nav_menus' ) ) {
  	register_nav_menus(
  		array(
  		  'main_menu' => 'Main Menu'
  		)
  	);
}
*/

if ( function_exists( 'add_theme_support' ) ) {

	global $theme_name;

	add_theme_support( 'post-thumbnails' );

	add_image_size('list_post_large', 800, 200, true);

}


// Load header scripts (header.php)
function load_header_scripts() {
	if ( $GLOBALS['pagenow'] != 'wp-login.php' && !is_admin() ) {

		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', 'https://code.jquery.com/jquery-3.0.0.min.js', false, null );
		wp_enqueue_script( 'jquery' );


		wp_register_script('angular', get_template_directory_uri() . '/node_modules/angular/angular.min.js', array( 'jquery' ), null, false);
		wp_enqueue_script('angular');

		wp_register_script('angular-animate',  get_template_directory_uri() . '/node_modules/angular-animate/angular-animate.min.js', array( 'angular' ), null, false);
		wp_enqueue_script('angular-animate');

		wp_register_script('angular-route', get_template_directory_uri() . '/node_modules/angular-route/angular-route.min.js', array( 'angular' ), null, false);
		wp_enqueue_script('angular-route');

		wp_register_script('angular-sanitize', get_template_directory_uri() . '/node_modules/angular-sanitize/angular-sanitize.min.js', array( 'angular' ), null, false);
		wp_enqueue_script('angular-sanitize');

		wp_register_script('ng-infinite-scroll', get_template_directory_uri() . '/node_modules/ng-infinite-scroll/build/ng-infinite-scroll.min.js', array( 'angular' ), null, false);
		wp_enqueue_script('ng-infinite-scroll');

		wp_register_script('angular-locale', get_template_directory_uri() . '/lib/i18n/angular-locale_es-es.min.js', array( 'angular' ), null, false);
		wp_enqueue_script('angular-locale');

		wp_register_script('magnific-popup', get_template_directory_uri() . '/lib/magnific-popup/js/jquery.magnific-popup.min.js', array( 'jquery' ), null, false);
		wp_enqueue_script('magnific-popup');

		wp_register_script('bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js', array( 'jquery' ), null, false);
		wp_enqueue_script('bootstrap');


		wp_enqueue_script('app', get_template_directory_uri() . '/js/angular/app.js', array( 'angular' ), null, true );
		wp_enqueue_script('post-factory', get_template_directory_uri() . '/js/angular/factories/post.factory.js', array( 'angular' ), null, true );
		wp_enqueue_script('user-factory', get_template_directory_uri() . '/js/angular/factories/user.factory.js', array( 'angular' ), null, true );
		wp_enqueue_script('post-filter', get_template_directory_uri() . '/js/angular/filters/post.filter.js', array( 'angular' ), null, true );
		wp_enqueue_script('portfolio-factory', get_template_directory_uri() . '/js/angular/factories/portfolio.factory.js', array( 'angular' ), null, true );
		wp_enqueue_script('home-ctrl', get_template_directory_uri() . '/js/angular/controllers/home.controller.js', array( 'angular' ), null, true );
		wp_enqueue_script('user-ctrl', get_template_directory_uri() . '/js/angular/controllers/user.controller.js', array( 'angular' ), null, true );
		wp_enqueue_script('post-ctrl', get_template_directory_uri() . '/js/angular/controllers/post.controller.js', array( 'angular' ), null, true );
		wp_enqueue_script('portfolio-ctrl', get_template_directory_uri() . '/js/angular/controllers/portfolio.controller.js', array( 'angular' ), null, true );
		wp_enqueue_script('gallery-directive', get_template_directory_uri() . '/js/angular/directives/gallery.directive.js', array( 'angular' ), null, true );

		wp_localize_script('app', 'localized',
		array(
			'views' => trailingslashit( get_template_directory_uri() ) . 'views/',
			'site_url' => get_site_url(),
			'get_template_directory_uri' => get_template_directory_uri(),
			'state_plugin_rest_api' => is_plugin_active( 'rest-api/plugin.php' ),
			'state_plugin_acf' => is_plugin_active( 'advanced-custom-fields/acf.php' )
			)
		);

	}
}


// Load styles
function load_styles() {
	global $theme_name;

	wp_register_style('normalize', get_template_directory_uri() . '/css/normalize.min.css', array(), null, 'all');
	wp_enqueue_style('normalize');

	wp_register_style('util', get_template_directory_uri() . '/css/util.css', array(), null, 'all');
	wp_enqueue_style('util');

	wp_register_style('print', get_template_directory_uri() . '/css/print.css', array(), null, 'all');
	wp_enqueue_style('print');

	wp_register_style('animate', get_template_directory_uri() . '/css/animate.css', array(), null, 'all');
	wp_enqueue_style('animate');

	wp_register_style('magnific-popup', get_template_directory_uri() . '/lib/magnific-popup/css/magnific-popup.min.css', array(), null, 'all');
	wp_enqueue_style('magnific-popup');

	wp_register_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css', array(), null, 'all');
	wp_enqueue_style('font-awesome');

	wp_register_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), null, 'all');
	wp_enqueue_style('bootstrap');

	wp_register_style('custom', get_template_directory_uri() . '/css/custom.css', array(), null, 'all');
	wp_enqueue_style('custom');

}

function load_admin_styles() {
	wp_register_style( 'admin_custom', get_template_directory_uri() . '/css/admin.css', false, null );
	wp_enqueue_style( 'admin_custom' );
}

// Remove Admin bar
function remove_admin_bar() {
	return false;
}


/*------------------------------------*\
	Actions + Filters
\*------------------------------------*/

// Add Actions
add_action('init', 'load_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_enqueue_scripts', 'load_styles'); // Add Theme Stylesheet
add_action('admin_enqueue_scripts', 'load_admin_styles' ); // Add Admin Stylesheet
add_action('init', 'create_custom_post_types'); // Add custom Post Type
add_action( 'init', 'remove_support_page' );
add_action( 'admin_head', 'hide_editor' ); // Hide editor on specific pages.
add_action( 'wp_print_styles', 'deregister_cf7_style', 100 ); // Deregister Contact Form 7 CSS files on all pages without a form
add_action( 'wp_print_scripts', 'deregister_cf7_script', 100 ); // Deregister Contact Form 7 JavaScript files on all pages without a form

// Dequeue emoji CSS
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Add Filters
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images
add_filter( 'wp_mail_from_name', 'new_mail_from_name' ); // Change default sender name for emails
remove_filter( 'the_excerpt', 'wpautop' ); // Remove <p> tags from Excerpt altogether


function remove_support_page() {
	remove_post_type_support( 'page', 'thumbnail' );
	remove_post_type_support( 'page', 'editor' );
	remove_post_type_support( 'page', 'page-attributes' );
}

function create_custom_post_types() {

	$taxonomy_args = array(
		'hierarchical'	=> false,
		'show_in_rest'  => true //No necesario, se ha añadido slug spaceship
	);

	create_post_type( 'portfolio', array('portfolio'), 'portfolio', 'Portfolio', 'Portfolios', array( 'title', 'editor', 'thumbnail' ), true );
	register_taxonomy( 'portfolio_category', 'portfolio', $taxonomy_args );
	register_taxonomy_for_object_type( 'portfolio_category', 'portfolio' );

	//Add more custom post type
	//...
}

function create_post_type( $post_type_name, $taxonomies = '', $slug = '', $singular_name = '', $plural_name = '', $supports = '', $show_in_rest = false ) {

	global $theme_name;

	if ( $singular_name == '' )
		$singular_name = $post_type_name;

	if ( $plural_name == '' )
		$plural_name = $post_type_name . 's';

	if ( $slug == '' )
		$slug = $singular_name;

	if ( $supports == '' )
		$supports = array( 'title', 'editor', 'excerpt', 'thumbnail' );

	if ( $show_in_rest == '' )
		$show_in_rest = false;


	$post_type_labels = array(
		'name'					=> __( ucfirst( $plural_name ), $theme_name ),
		'singular_name'			=> __( ucfirst( $singular_name ), $theme_name ),
		'add_new'				=> __( 'Add New', $theme_name ),
		'add_new_item'			=> __( 'Add New ' . $singular_name, $theme_name ),
		'edit'					=> __( 'Edit', $theme_name ),
		'edit_item'				=> __( 'Edit ' . $singular_name, $theme_name ),
		'new_item'				=> __( 'New ' . $singular_name, $theme_name ),
		'view'					=> __( 'View ' . $singular_name, $theme_name ),
		'view_item'				=> __( 'View ' . $singular_name, $theme_name ),
		'search_items'			=> __( 'Search ' . $singular_name, $theme_name ),
		'not_found'				=> __( 'No ' . $plural_name . ' found', $theme_name ),
		'not_found_in_trash'	=> __( 'No ' . $plural_name . ' found in Trash', $theme_name )
	);

	$post_type_options = array(
		'labels'			=> $post_type_labels,
		'public'			=> true,
		'hierarchical'		=> true,
		'has_archive'		=> true,
		'can_export'		=> true,
		'supports'			=> $supports,
		'rewrite'			=> array( 'slug' => $slug ),
		'menu_icon'   		=> 'dashicons-admin-page',
		'show_in_rest'		=> $show_in_rest
	);

	if ( $taxonomies != '' && !empty( $taxonomies ) )
		$post_type_options['taxonomies'] = $taxonomies;

	register_post_type( $post_type_name, $post_type_options );
}


function new_mail_from_name( $old ) {
	return get_bloginfo();
}

function hide_editor() {

	global $pagenow;
	if( !( 'post.php' == $pagenow ) ) return;

	global $post;
  $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
  if( !isset( $post_id ) ) return;

	$hide_selected = array( 'Home', 'page-team.php' );

	foreach ( $hide_selected as $value ) {
		$homepgname = get_the_title($post_id);
		$template_file = get_post_meta($post_id, '_wp_page_template', true);
		if( $homepgname == $value || $template_file == $value ){
			remove_post_type_support('page', 'editor');
		}
	}

}

function deregister_cf7_style() {
	if ( !is_page( 'contact ') ) {
		wp_deregister_style( 'contact-form-7' );
	}
}

function deregister_cf7_script() {
	if ( ! is_page( 'contact' ) ) {
		wp_deregister_script( 'contact-form-7' );
	}
}

function get_logo_url() {
	$logo_url = get_template_directory_uri() . '/img/logo.png';
	return $logo_url;
}

function the_logo_url() {
	echo get_logo_url();
}

function get_favicon_url() {
	$favicon_url = get_template_directory_uri() . '/img/icon/favicon.png';
	return $favicon_url;
}

function the_favicon_url() {
	echo get_favicon_url();
}

function get_apple_touch_url() {
	$apple_touch_url = get_template_directory_uri() . '/img/icon/touch.png';
	return $apple_touch_url;
}

function the_apple_touch_url() {
	echo get_apple_touch_url();
}


if ( is_plugin_active( 'rest-api/plugin.php' ) && is_plugin_active( 'advanced-custom-fields/acf.php' ) ) {

	add_action( 'rest_api_init', 'slug_register_spaceship' );

	function slug_register_spaceship() {

		register_rest_field( 'post',
			'url_thumbnail',
			array(
				'get_callback'    => 'ng_get_thumbnail_url',
				'update_callback' => null,
				'schema'          => null,
			)
    );
		register_rest_field( 'post',
			'url_gallery',
			array(
					'get_callback'    => 'ng_get_post_galleries_images',
					'update_callback' => null,
					'schema'          => null,
			)
		);


		// Return all fields create with ACF created for specified Type Post
		register_api_field( 'portfolio',
			'fields',
			array(
				'get_callback'    => 'ng_get_all_fields_acf',
				'update_callback' => null,
				'schema'          => null,
			)
		);
		register_api_field( 'post',
			'fields',
			array(
				'get_callback'    => 'ng_get_all_fields_acf',
				'update_callback' => null,
				'schema'          => null,
			)
		);
		register_rest_field( 'portfolio',
			'url_thumbnail',
			array(
				'get_callback'    => 'ng_get_thumbnail_url',
				'update_callback' => null,
				'schema'          => null,
			)
		);
		register_rest_field( 'portfolio',
			'url_gallery',
			array(
					'get_callback'    => 'ng_get_post_galleries_images',
					'update_callback' => null,
					'schema'          => null,
			)
		);

		//Post Categories
		register_rest_field( 'post',
				'post_categories',
				array(
						'get_callback'    => 'ng_get_categories_post',
						'update_callback' => null,
						'schema'          => null,
				)
		);
		//Portfolio Categories
		register_rest_field( 'portfolio',
				'post_categories',
				array(
						'get_callback'    => 'ng_get_categories_portfolio',
						'update_callback' => null,
						'schema'          => null,
				)
		);
		//Tags. No usado
		register_rest_field( 'portfolio',
				'post_tags',
				array(
						'get_callback'    => 'ng_get_tags',
						'update_callback' => null,
						'schema'          => null,
				)
		);

	}

	function ng_get_all_fields_acf($data, $field, $request, $type) {
		if ( function_exists( 'get_fields' ) ) {
			return get_fields($data['id']);
		}
		return [];
	}

	function ng_get_thumbnail_url( $post ) {
		// Default images size to Return
		$sizes = ['thumbnail', 'medium' ,'large', 'list_post_large'];

		$imgArray = [];

		if ( has_post_thumbnail( $post['id'] ) ){
			foreach ($sizes as $size) {
				$imgArray[$size] = wp_get_attachment_image_src( get_post_thumbnail_id( $post['id'] ), $size )[0];
			}
			return $imgArray;
		} else {
			return false;
		}
	}

	function ng_get_post_galleries_images() {
		global $post;
		$result = array();
		if ( $galleries = get_post_galleries_images( $post ) ) {
			foreach ( $galleries as $gallery ) {
				foreach ( $gallery as $src ) {
					$result[] = $src;
				}
			}
		}
		return $result;
	}

	function ng_get_categories_post($post){
    $post_categories = array();
    $categories = wp_get_post_terms( $post['id'], 'category', array('fields'=>'all') );

		foreach ($categories as $term) {
	    $term_link = get_term_link($term);
	    if ( is_wp_error( $term_link ) ) {
        continue;
	    }
	    $post_categories[] = array('term_id'=>$term->term_id, 'name'=>$term->name, 'link'=>$term_link);
		}

    return $post_categories;
	}

	function ng_get_categories_portfolio($post){
    $post_categories = array();
    $categories = wp_get_post_terms( $post['id'], 'portfolio_category' );

		foreach ($categories as $term) {
	    $term_link = get_term_link($term);
	    if ( is_wp_error( $term_link ) ) {
        continue;
	    }
	    $post_categories[] = array('term_id'=>$term->term_id, 'name'=>$term->name, 'link'=>$term_link);
		}

    return $post_categories;
	}

	//no usado
	function ng_get_tags($post){
    $post_tags = array();
    $tags = wp_get_post_terms( $post['id'], 'post_tag', array('fields'=>'all') );
    foreach ($tags as $term) {
      $term_link = get_term_link($term);
      if ( is_wp_error( $term_link ) ) {
        continue;
      }
      $post_tags[] = array('term_id'=>$term->term_id, 'name'=>$term->name );
    }
    return $post_tags;
	}

}
