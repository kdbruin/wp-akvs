<?php

/**
 * Page template support files.
 *
 * @package AKV Soesterkwartier
 */

/**
 * Return the proper page layout template.
 */
function akvs_get_page_template() {
    $layout = 'content-sidebar';
    if ( is_page_template( 'page-templates/page-no-sidebar.php' ) )
    {
        $layout = 'content-no-sidebar';
    }
    else if ( is_page_template( 'page-templates/page-full-width.php' ) )
    {
        $layout = 'content-full-width';
    }

    return get_template_directory_uri() . '/css/' . $layout . '.css';
}

/**
 * Add the class "front-page" to the static home page
 */
function akvs_add_body_class( $classes )
{
    if (  is_front_page()) $classes[] = 'front-page';

    return $classes;
}
add_filter( 'body_class', 'akvs_add_body_class' );
