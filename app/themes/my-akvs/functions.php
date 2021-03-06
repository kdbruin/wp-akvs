<?php

/**
 * My AKV Soesterkwartier functions and definitions
 *
 * @package My AKV Soesterkwartier
 */
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( !isset( $content_width ) )
{
    $content_width = 640; /* pixels */
}

if ( !function_exists( 'my_akvs_setup' ) ) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function my_akvs_setup()
    {

        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on My AKV Soesterkwartier, use a find and replace
         * to change 'my-akvs' to the name of your theme in all the template files
         */
        load_theme_textdomain( 'my-akvs', get_template_directory() . '/languages' );

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
            'primary' => __( 'Primary Menu', 'my-akvs' ),
            'social'  => __( 'Social Menu', 'my-akvs' ),
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
            'aside', 'image', 'video', 'quote', 'link',
        ) );

        // Setup the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'my_akvs_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );
    }

endif; // my_akvs_setup
add_action( 'after_setup_theme', 'my_akvs_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function my_akvs_widgets_init()
{
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'my-akvs' ),
        'id'            => 'sidebar-1',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer Widgets', 'my-akvs' ),
        'description'   => __( 'Footer widgets area appears in the footer of the site.', 'my-akvs' ),
        'id'            => 'sidebar-2',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
    ) );
}

add_action( 'widgets_init', 'my_akvs_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function my_akvs_scripts()
{
    wp_enqueue_style( 'my-akvs-style', get_stylesheet_uri() );
    if ( is_page_template( 'page-templates/page-nosidebar.php' ) )
    {
        wp_enqueue_style( 'my-akvs-layout-style', get_template_directory_uri() . '/layouts/no-sidebar.css' );
    }
    else
    {
        wp_enqueue_style( 'my-akvs-layout-style', get_template_directory_uri() . '/layouts/content-sidebar.css' );
    }

    wp_enqueue_style( 'my-akvs-google-fonts', 'http://fonts.googleapis.com/css?family=Lato:100,400,700,900,400italic,900italic|PT+Serif:400,700,400italic,700italic' );

    wp_enqueue_style( 'my-akvs-fontawesome', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css' );

    wp_enqueue_script( 'my-akvs-superfish', get_template_directory_uri() . '/js/superfish.min.js', array( 'jquery' ), '20140827', true );
    wp_enqueue_script( 'my-akvs-superfish-settings', get_template_directory_uri() . '/js/superfish-settings.js', array( 'my-akvs-superfish' ), '20140827', true );

    wp_enqueue_script( 'my-akvs-hide-search', get_template_directory_uri() . '/js/hide-search.js', array( 'jquery' ), '20140827', true );

    wp_enqueue_script( 'my-akvs-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

    wp_enqueue_script( 'my-akvs-masonry', get_template_directory_uri() . '/js/masonry-settings.js', array( 'masonry' ), '20140401', true );

    wp_enqueue_script( 'my-akvs-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
    {
        wp_enqueue_script( 'comment-reply' );
    }
}

add_action( 'wp_enqueue_scripts', 'my_akvs_scripts' );

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
