<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package AKV Soesterkwartier
 */
if ( !function_exists( 'akvs_paging_nav' ) ) :

    /**
     * Display navigation to next/previous set of posts when applicable.
     */
    function akvs_paging_nav()
    {
        // Don't print empty markup if there's only one page.
        if ( $GLOBALS[ 'wp_query' ]->max_num_pages < 2 )
        {
            return;
        }

        $paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
        $pagenum_link = html_entity_decode( get_pagenum_link() );
        $query_args   = array();
        $url_parts    = explode( '?', $pagenum_link );

        if ( isset( $url_parts[ 1 ] ) )
        {
            wp_parse_str( $url_parts[ 1 ], $query_args );
        }

        $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
        $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

        $format = $GLOBALS[ 'wp_rewrite' ]->using_index_permalinks() && !strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
        $format .= $GLOBALS[ 'wp_rewrite' ]->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

        // Set up paginated links.
        $links = paginate_links( array(
            'base'      => $pagenum_link,
            'format'    => $format,
            'total'     => $GLOBALS[ 'wp_query' ]->max_num_pages,
            'current'   => $paged,
            'mid_size'  => 2,
            'add_args'  => array_map( 'urlencode', $query_args ),
            'prev_text' => __( '&larr; Previous', 'akvs' ),
            'next_text' => __( 'Next &rarr;', 'akvs' ),
            'type'      => 'list',
            ) );

        if ( $links ) :
            ?>
            <nav class="navigation paging-navigation" role="navigation">
                <h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'akvs' ); ?></h1>
                <?php echo $links; ?>
            </nav><!-- .navigation -->
            <?php
        endif;
    }

endif;

if ( !function_exists( 'akvs_post_nav' ) ) :

    /**
     * Display navigation to next/previous post when applicable.
     */
    function akvs_post_nav()
    {
        // Don't print empty markup if there's nowhere to navigate.
        $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
        $next     = get_adjacent_post( false, '', false );

        if ( !$next && !$previous )
        {
            return;
        }
        ?>
        <nav class="navigation post-navigation" role="navigation">
            <div class="post-nav-box clear">
                <h1 class="screen-reader-text"><?php _e( 'Post navigation', 'akvs' ); ?></h1>
                <div class="nav-links">
                    <?php
                    previous_post_link( '<div class="nav-previous"><div class="nav-indicator">' . _x( 'Previous Post:', 'Previous post', 'akvs' ) . '</div><h1>%link</h1></div>', '%title' );
                    next_post_link( '<div class="nav-next"><div class="nav-indicator">' . _x( 'Next Post:', 'Next post', 'akvs' ) . '</div><h1>%link</h1></div>', '%title' );
                    ?>
                </div><!-- .nav-links -->
            </div><!-- .post-nav-box -->
        </nav><!-- .navigation -->
        <?php
    }

endif;

if ( !function_exists( 'akvs_posted_on' ) ) :

    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function akvs_posted_on()
    {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) )
        {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf( $time_string, esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ), esc_attr( get_the_modified_date( 'c' ) ), esc_html( get_the_modified_date() )
        );

        $posted_on = sprintf(
            _x( '%s', 'post date', 'akvs' ), '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
        );

        $byline = sprintf(
            _x( '%s%s', 'post author', 'akvs' ), '<span class="written-by">Written by</span>', '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
        );

        echo '<span class="byline"> ' . $byline . '</span><span class="posted-on">' . $posted_on . '</span>';
    }

endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function akvs_categorized_blog()
{
    if ( false === ( $all_the_cool_cats = get_transient( 'akvs_categories' ) ) )
    {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories( array(
            'fields'     => 'ids',
            'hide_empty' => 1,
            // We only need to know if there is more than one category.
            'number'     => 2,
            ) );

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count( $all_the_cool_cats );

        set_transient( 'akvs_categories', $all_the_cool_cats );
    }

    if ( $all_the_cool_cats > 1 )
    {
        // This blog has more than 1 category so akvs_categorized_blog should return true.
        return true;
    }
    else
    {
        // This blog has only 1 category so akvs_categorized_blog should return false.
        return false;
    }
}

/**
 * Flush out the transients used in akvs_categorized_blog.
 */
function akvs_category_transient_flusher()
{
    // Like, beat it. Dig?
    delete_transient( 'akvs_categories' );
}

add_action( 'edit_category', 'akvs_category_transient_flusher' );
add_action( 'save_post', 'akvs_category_transient_flusher' );

/**
 * Social media icon menu as per http://justintadlock.com/archives/2013/08/14/social-nav-menus-part-2
 */
function akvs_social_menu()
{
    if ( has_nav_menu( 'social' ) )
    {
        wp_nav_menu(
            array(
                'theme_location'  => 'social',
                'container'       => 'div',
                'container_id'    => 'menu-social',
                'container_class' => 'menu-social',
                'menu_id'         => 'menu-social-items',
                'menu_class'      => 'menu-items',
                'depth'           => 1,
                'link_before'     => '<span class="screen-reader-text">',
                'link_after'      => '</span>',
                'fallback_cb'     => '',
            )
        );
    }
}

/**
 * Show the featured posts as aslideshow and return a list of the displayed post IDs.
 */
function akvs_show_featured_posts()
{
    $q_args     = array(
        'post_type'           => 'post',
        'post_status'         => 'publish',
        'posts_per_page'      => 5,
        'ignore_sticky_posts' => 1,
        'category_name'       => 'featured',
        'order'               => 'DESC',
        'orderby'             => 'date'
    );
    $feat_query = new WP_Query( $q_args );
    $feat_posts = array();

    if ( $feat_query->have_posts() )
    {
        // Enqueue the necessary stuff
        wp_enqueue_style( 'akvs-lightSlider-style', get_template_directory_uri() . '/lightSlider/css/lightSlider.css' );
        wp_enqueue_script( 'akvs-lightSlider-script', get_template_directory_uri() . '/lightSlider/js/jquery.lightSlider.min.js', array( 'jquery' ), '20140907', true );
        wp_enqueue_script( 'akvs-lightSlider-settings', get_template_directory_uri() . '/js/lightSlider-settings.js', array( 'akvs-lightSlider-script' ), '20140907', true );

        global $post;
        $html = '<div class="featured-posts-slider-box">';
        $html .= '<div id="lightSlider" class="featured-posts-slider">';

        $feat_count = 0;
        while ( $feat_query->have_posts() ) :
            $feat_query->the_post();
            $feat_count++;
            $feat_posts[] = get_the_ID();

            $html .= '<div class="featured-post-slide">';
            $html .= '<div class="slide-title">';
            $html .= '<h3 id="post-' . get_the_ID() . '"><a href="' . get_the_permalink() . '" rel="bookmark">' . get_the_title() . '</a></h3>';
            $html .= '</div>';
            $html .= '<div class="slide-content">';
            $html .= get_the_excerpt();
            $html .= '</div>';
            $html .= '</div>';

        endwhile;

        $html .= '</div>';
        $html .= '</div>';
        echo $html;
    }
    else
    {
        echo 'No featured posts!';
    }

    wp_reset_query();
    wp_reset_postdata();

    return $feat_posts;
}

/**
 * Show the latest posts.
 */
function akvs_latest_posts( $feat_posts )
{
    // Get all posts that are not featured in the slideshow or are result posts.
    $q_args        = array(
        'post_type'           => 'post',
        'post_status'         => 'publish',
        'posts_per_page'      => 5,
        'ignore_sticky_posts' => 1,
        'category__not_in'    => array( get_category_id( 'uitslagen' ) ),
        'post__not_in'        => $feat_posts,
        'order'               => 'DESC',
        'orderby'             => 'date'
    );
    $seizoen_start = get_post_meta( get_the_ID(), 'seizoen-start', true );
    if ( !empty( $seizoen_start ) )
    {
        preg_match( '/(\d\d\d\d)-(\d\d)-(\d\d)/', $seizoen_start, $d );
        $q_date = array(
            'date_query' => array(
                array(
                    'after'     => array(
                        'year'  => $d[ 1 ],
                        'month' => $d[ 2 ],
                        'day'   => $d[ 3 ]
                    ),
                    'inclusive' => true,
                )
            )
        );
        $q_args = array_merge( $q_args, $q_date );
    }
    $news_query = new WP_Query( $q_args );

    $html = '';
    if ( $news_query->have_posts() )
    {
        $html .= '<ul class="latest-news">';

        while ( $news_query->have_posts() )
        {
            $news_query->the_post();
            $html .= '<li class="latest-news-item">';
            $title = sprintf( esc_attr__( 'Permalink to %s', 'skeleton' ), the_title_attribute( 'echo=0' ) );
            $html .= '<a href="' . get_the_permalink() . '" title="' . $title . '" rel="bookmark">';
            $html .= get_the_title();
            $html .= '</a>';
            $html .= '<span class="date">(' . get_the_time( 'j M. Y' ) . ')</span>';
            $html .= '</li>';
        }

        $nieuws_page = get_page_by_title( 'Nieuws' );
        if ( isset( $nieuws_page ) )
        {
            $html .= '<li class="latest-news-item">';
            $title = sprintf( esc_attr__( 'Permalink to %s', 'skeleton' ), 'Meer nieuws...' );
            $html .= '<a href="' . get_the_permalink() . '" title="' . $title . '" rel="bookmark">Meer nieuws...</a>';
            $html .= '</li>';
        }
    }
    else
    {
        $html = 'Geen nieuws!';
    }

    echo $html;

    wp_reset_query();
    wp_reset_postdata();
}

/**
 * Show the latest games.
 */
function akvs_latest_games()
{
    $xml_file   = akvs_get_xml_meta( get_the_ID(), 'xml' );
    $competitie = new AKVS_Competitie( $xml_file );
    $vandaag    = date( 'Y-m-d' );
    list($vanaf, $tot) = akvs_week_range( $vandaag );
    $schema     = $competitie->getTotaalSchema( $vanaf );

    $html = '';
    if ( count( $schema ) )
    {
        $html .= akvs_table( 'akvs-wedstrijden' );
        $html .= akvs_thead( array( 'datum', 'aanvang', 'wedstrijd@3', 'wsnum' ) );
        $html .= akvs_tbody();
        $count = 0;

        foreach ( $schema as $datum => $wedstrijden )
        {
            if ( $datum < $vandaag )
                continue;
            if ( $datum > $tot )
                break;

            foreach ( $wedstrijden as $wedstrijd )
            {
                $count++;
                $html .= akvs_tr( $count );
                $status = $wedstrijd->status();
                $html .= akvs_td( akvs_format_ddm( $datum ), akvs_afgelast_class( $status, 'datum' ) );
                $html .= akvs_td( $wedstrijd->atijd(), akvs_afgelast_class( $status, 'tijd' ) );
                $html .= akvs_td( akvs_get_team_url( $wedstrijd->thuis() ), akvs_afgelast_class( $status, 'ploeg-thuis' ) );
                $html .= akvs_td( '-', 'dash' );
                $html .= akvs_td( akvs_get_team_url( $wedstrijd->uit() ), akvs_afgelast_class( $status, 'ploeg-uit' ) );
                $html .= akvs_td( $wedstrijd->wsnum(), akvs_afgelast_class( $status, 'wsnum' ) );
                $html .= '</tr>';
            }
        }
        $html .= '</tbody></table>';
    }
    else
    {
        $html .= '<p>Er zijn deze week geen wedstrijden.</p>';
    }

    echo $html;
}

/**
 * Show the latest scores.
 */
function akvs_latest_scores()
{
    $xml_file   = akvs_get_xml_meta( get_the_ID(), 'xml' );
    $competitie = new AKVS_Competitie( $xml_file );
    $vandaag    = date( 'Y-m-d' );
    list($vanaf, $tot) = akvs_week_range( $vandaag );
    $schema     = $competitie->getTotaalSchema( $vanaf );

    $html = '';
    if ( count( $schema ) )
    {
        $html .= akvs_table( 'akvs-wedstrijden' );
        $html .= akvs_thead( array( 'datum', 'aanvang', 'wedstrijd@3', 'wsnum' ) );
        $html .= akvs_tbody();
        $count = 0;

        foreach ( $schema as $datum => $wedstrijden )
        {
            if ( $datum < $vandaag )
                continue;
            if ( $datum > $tot )
                break;

            foreach ( $wedstrijden as $wedstrijd )
            {
                $count++;
                $html .= akvs_tr( $count );
                $status = $wedstrijd->status();
                $html .= akvs_td( akvs_format_ddm( $datum ), akvs_afgelast_class( $status, 'datum' ) );
                $html .= akvs_td( $wedstrijd->atijd(), akvs_afgelast_class( $status, 'tijd' ) );
                $html .= akvs_td( akvs_get_team_url( $wedstrijd->thuis() ), akvs_afgelast_class( $status, 'ploeg-thuis' ) );
                $html .= akvs_td( '-', 'dash' );
                $html .= akvs_td( akvs_get_team_url( $wedstrijd->uit() ), akvs_afgelast_class( $status, 'ploeg-uit' ) );
                $html .= akvs_td( $wedstrijd->wsnum(), akvs_afgelast_class( $status, 'wsnum' ) );
                $html .= '</tr>';
            }
        }
        $html .= '</tbody></table>';
    }
    else
    {
        $html .= '<p>Er zijn deze week geen wedstrijden.</p>';
    }

    echo $html;
}
