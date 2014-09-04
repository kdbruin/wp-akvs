<?php
/**
 * @package AKV Soesterkwartier
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="entry-header">
        <?php
        /* translators: used between list items, there is a space after the comma */
        $category_list = get_the_category_list( __( ', ', 'akvs' ) );

        if ( akvs_categorized_blog() ) {
            echo '<div class="category-list">' . $category_list . '</div>';
        }
        ?>

        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

        <div class="entry-meta">
            <?php akvs_posted_on(); ?>
            <?php 
            if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) { 
                echo '<span class="comments-link">';
                comments_popup_link( __( 'Leave a comment', 'akvs' ), __( '1 Comment', 'akvs' ), __( '% Comments', 'akvs' ) );
                echo '</span>';
            }
            ?>
        </div><!-- .entry-meta -->
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php the_content(); ?>
        <?php
            wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'akvs' ),
                'after'  => '</div>',
            ) );
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php echo get_the_tag_list( '<ul><li><i class="fa fa-tag"></i>', '</li><li><i class="fa fa-tag"></i>', '</li></ul>' ); ?>

        <?php edit_post_link( __( 'Edit', 'akvs' ), '<span class="edit-link">', '</span>' ); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->
