<?php
/**
 * @package AKV Soesterkwartier
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="index-box">
	<header class="entry-header">
            <?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

            <?php if ( 'post' == get_post_type() ) : ?>
            <div class="entry-meta">
                <?php akvs_posted_on(); ?>
                <?php 
                if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) { 
                    echo '<span class="comments-link">';
                    comments_popup_link( __( 'Leave a comment', 'akvs' ), __( '1 Comment', 'akvs' ), __( '% Comments', 'akvs' ) );
                    echo '</span>';
                }
                ?>
                <?php edit_post_link( __( 'Edit', 'akvs' ), '<span class="edit-link">', '</span>' ); ?>
            </div><!-- .entry-meta -->
            <?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
            <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'akvs' ) ); ?>
            <?php
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . __( 'Pages:', 'akvs' ),
                    'after'  => '</div>',
                ) );
            ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">

        </footer><!-- .entry-footer -->
    </div><!-- .index-box -->
</article><!-- #post-## -->