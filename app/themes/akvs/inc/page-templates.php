<?php

/**
 * Page template support files.
 *
 * @package AKV Soesterkwartier
 */
if ( !function_exists( 'akvs_get_page_template' ) ) :

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

endif;
