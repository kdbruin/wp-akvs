<?php

/**
 * AKV Soesterkwartier functions and definitions
 *
 * @package AKV Soesterkwartier
 */
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( !isset( $content_width ) ) {
    $content_width = 640; /* pixels */
}

if ( !function_exists( 'akvs_setup' ) ) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function akvs_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on AKV Soesterkwartier, use a find and replace
	 * to change 'akvs' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'akvs', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'large-thumb', 1060, 650, true );
	add_image_size( 'index-thumb', 780, 250, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
	    'primary'	 => __( 'Primary Menu', 'akvs' ),
	    'social'	 => __( 'Social Menu', 'akvs' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
	    'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
	    'aside'
	) );

	// Setup the WordPress core custom background feature.
//	add_theme_support( 'custom-background', apply_filters( 'akvs_custom_background_args', array(
//	    'default-color'	 => 'ffffff',
//	    'default-image'	 => '',
//	) ) );
    }

endif; // akvs_setup
add_action( 'after_setup_theme', 'akvs_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function akvs_widgets_init() {
    register_sidebar( array(
	'name'		 => __( 'Sidebar', 'akvs' ),
	'id'		 => 'sidebar-1',
	'description'	 => '',
	'before_widget'	 => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'	 => '</aside>',
	'before_title'	 => '<h1 class="widget-title">',
	'after_title'	 => '</h1>',
    ) );

    register_sidebar( array(
	'name'		 => __( 'Footer Widgets', 'akvs' ),
	'description'	 => __( 'Footer widgets area appears in the footer of the site.', 'akvs' ),
	'id'		 => 'sidebar-2',
	'before_widget'	 => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'	 => '</aside>',
	'before_title'	 => '<h1 class="widget-title">',
	'after_title'	 => '</h1>',
    ) );
}

add_action( 'widgets_init', 'akvs_widgets_init' );

/**
 * Page template support functions.
 */
require get_template_directory() . '/inc/page-templates.php';

/**
 * Enqueue scripts and styles.
 */
function akvs_scripts() {
    /* Enqueue our own generated stylesheet as the main style.css is only to identify this theme. */
    wp_enqueue_style( 'akvs-style', get_template_directory_uri() . '/css/style.css' );
    wp_enqueue_style( 'akvs-layout-style', akvs_get_page_template() );

    /* Webfonts */
    wp_enqueue_style( 'akvs-google-fonts', 'http://fonts.googleapis.com/css?family=Lato:100,400,700,900,400italic,900italic|PT+Serif:400,700,400italic,700italic' );
    wp_enqueue_style( 'akvs-fontawesome', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' );

    /* Menu */
    wp_enqueue_script( 'akvs-superfish', get_template_directory_uri() . '/libs/superfish/superfish.min.js', array( 'jquery' ), '20140328', true );
    wp_enqueue_script( 'akvs-superfish-settings', get_template_directory_uri() . '/js/superfish-settings.js', array( 'akvs-superfish' ), '20140328', true );
    wp_enqueue_script( 'akvs-hide-search', get_template_directory_uri() . '/js/hide-search.js', array(), '20140903', true );

    /* General scripts */
    wp_enqueue_script( 'akvs-enquire', get_template_directory_uri() . '/libs/enquire/enquire.min.js', false, '20140429', true );
    wp_enqueue_script( 'akvs-masonry', get_template_directory_uri() . '/js/masonry-settings.js', array( 'masonry' ), '20140903', true );

    /* Navigation */
    wp_enqueue_script( 'akvs-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

    wp_enqueue_script( 'akvs-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
    }
}

add_action( 'wp_enqueue_scripts', 'akvs_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
