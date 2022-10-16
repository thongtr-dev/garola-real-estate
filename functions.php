<?php

/**
 * Garola Real Estate functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Garola_Real_Estate
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

if (!function_exists('garola_real_estate_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function garola_real_estate_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Garola Real Estate, use a find and replace
		 * to change 'garola-real-estate' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('garola-real-estate', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts, pages, properties and agents
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails', array(
			'post',
			'page',
			'property',
			'agent'
		));

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'main-menu' => esc_html__('Primary', 'garola-real-estate')
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'garola_real_estate_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add custom image sizes
		add_image_size('propertySquare', 400, 400, true);

		add_image_size('propertyLandscapeMedium', 800, 500, true);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action('after_setup_theme', 'garola_real_estate_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function garola_real_estate_content_width()
{
	$GLOBALS['content_width'] = apply_filters('garola_real_estate_content_width', 640);
}
add_action('after_setup_theme', 'garola_real_estate_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function garola_real_estate_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'garola-real-estate'),
			'id'            => 'primary-sidebar',
			'description'   => esc_html__('Add widgets here.', 'garola-real-estate'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'garola_real_estate_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function garola_real_estate_scripts()
{

	wp_enqueue_style('garola-real-estate-style', get_stylesheet_uri(), array(), _S_VERSION);

	// wp_style_add_data('garola-real-estate-style', 'rtl', 'replace');

	// wp_enqueue_script('garola-real-estate-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	// Bootstrap 5.1.0
	wp_enqueue_style('bootstrap', '//cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css');
	wp_enqueue_script('bootstrap-js', '//cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js');

	// Fontawesome 5.15.4
	wp_enqueue_style('font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');

	// WordPress/@Scripts Built main style
	wp_enqueue_style('garola_main_styles', get_template_directory_uri() . '/build/index.css');

	// WordPress/@Scripts Built index.js
	wp_enqueue_script('main-garola-js', get_template_directory_uri() . '/build/index.js', array(), '1.0', true);

	// Owl carousel
	wp_enqueue_style('owl-carousel-min', get_template_directory_uri() . '/css/owlcarousel/owl.carousel.min.css');
	wp_enqueue_style('owl-theme-default-min', get_template_directory_uri() . '/css/owlcarousel/owl.theme.default.min.css');
	wp_enqueue_script('owl-carousel-js', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), null, true);
	wp_enqueue_script('owl-carousel-init', get_template_directory_uri() . '/js/owlcarousel.js', array('jquery'), null, true);

	wp_localize_script('main-garola-js', 'garolaData', array(
		'root_url' => get_site_url()
	));
}
add_action('wp_enqueue_scripts', 'garola_real_estate_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Custom column for property post type.
 */
include_once(ABSPATH . 'wp-admin/includes/plugin.php');
if (is_plugin_active('garola-post-types/garola-post-types.php')) {
	require get_template_directory() . '/inc/featured-property.php';
}
