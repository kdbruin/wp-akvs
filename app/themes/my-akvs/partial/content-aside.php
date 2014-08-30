<?php
/**
 * @package My AKV Soesterkwartier
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="index-box">
	
	<header class="entry-header">
	    <?php
	    // Display a thumb tack in the top right hand corner if this post is sticky
	    if (is_sticky()) {
		echo '<i class="fa fa-thumb-tack sticky-post"></i>';
	    }
	    ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
	    <?php the_content(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer continue-reading">
	    <?php if ( 'post' == get_post_type() ) : ?>
	    <div class="entry-meta">
		<?php my_akvs_posted_on(); ?>
		<?php
		if (!post_password_required() && ( comments_open() || '0' != get_comments_number() )) {
		    echo '<span class="comments-link">';
		    comments_popup_link(__('Leave a comment', 'my-akvs'), __('1 Comment', 'my-akvs'), __('% Comments', 'my-akvs'));
		    echo '</span>';
		}
		?>
		<?php edit_post_link( __( 'Edit', 'my-akvs' ), '<span class="edit-link">', '</span>' ); ?>
	    </div><!-- .entry-meta -->
	    <?php endif; ?>
	</footer><!-- .entry-footer -->
    </div><!-- .index-box -->
</article><!-- #post-## -->