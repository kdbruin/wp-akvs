<?php
/**
 * @package AKV Soesterkwartier
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="index-box">
	<header class="entry-header">
	    <?php if ( is_sticky() ) : ?>
		<i class="fa fa-thumb-tack sticky-post"></i>
	    <?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
	    <?php the_content(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer continue-reading">
    	    <div class="entry-meta">
		<?php akvs_posted_on(); ?>
		<?php edit_post_link( __( 'Edit', 'akvs' ), '<span class="edit-link">', '</span>' ); ?>
    	    </div><!-- .entry-meta -->
	</footer><!-- .entry-footer -->
    </div><!-- .index-box -->
</article><!-- #post-## -->