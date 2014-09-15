<?php
/**
 * @package AKV Soesterkwartier
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if( $wp_query->current_post == 0 && !is_paged() && is_front_page() ) : // Custom template for the first post on the front page
	if (has_post_thumbnail()) { ?>
	    <div class="front-index-thumbnail clear">
		<div class="image-shifter">
		    <a href="<?php echo get_permalink(); ?>" title="<?php echo __( 'Read ', 'akvs' ) . get_the_title(); ?>" rel="bookmark">
			<?php echo the_post_thumbnail('large-thumb'); ?>
		    </a>
		</div>
	    </div>
	<?php } ?>
	<div class="index-box<?php if (has_post_thumbnail()) { echo ' has-thumbnail'; }; ?>">
    <?php else: ?>
	<div class="index-box">
	
	<?php if (has_post_thumbnail()) { ?>
	    <div class="small-index-thumbnail clear">
		<a href="<?php echo get_permalink(); ?>" title="<?php echo __( 'Click to read ', 'akvs' ) . get_the_title(); ?>" rel="bookmark">
		    <?php echo the_post_thumbnail('index-thumb'); ?>
		</a>
	    </div>
	<?php }	?>
    <?php endif; ?>
	
	<header class="entry-header">
	    <?php
	    // Display a thumb tack in the top right hand corner if this post is sticky
	    if (is_sticky()) {
		echo '<i class="fa fa-thumb-tack sticky-post"></i>';
	    }
	    ?>
	    <?php
	    if ( akvs_categorized_blog() && is_front_page() ) {
		/* translators: used between list items, there is a space after the comma */
		$category_list = get_the_category_list( __(', ', 'akvs') );
		echo '<div class="category-list">' . $category_list . '</div>';
	    }
	    ?>
	    <?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

	    <?php if ( 'post' == get_post_type() ) : ?>
	    <div class="entry-meta">
		<?php akvs_posted_on(); ?>
		<?php
		if (!post_password_required() && ( comments_open() || '0' != get_comments_number() )) {
		    echo '<span class="comments-link">';
		    comments_popup_link(__('Leave a comment', 'akvs'), __('1 Comment', 'akvs'), __('% Comments', 'akvs'));
		    echo '</span>';
		}
		?>
		<?php edit_post_link( __( 'Edit', 'akvs' ), '<span class="edit-link">', '</span>' ); ?>
	    </div><!-- .entry-meta -->
	    <?php endif; ?>
	</header><!-- .entry-header -->

	<?php if( $wp_query->current_post == 0 && !is_paged() && is_front_page() ) : ?>
	    <div class="entry-content">
		<?php the_content( __( '', 'akvs' ) ); ?>
	    </div>
	    <footer class="entry-footer continue-reading">
		<a href="<?php echo get_permalink(); ?>" title="<?php echo __('Read ', 'akvs') . get_the_title(); ?>" rel="bookmark">
		    <?php echo __( 'Read the article<i class="fa fa-arrow-circle-o-right"></i>', 'akvs' ); ?>
		</a>
	    </footer><!-- .entry-footer -->
	<?php elseif( in_category( 'uitslagen' ) ) : ?>
	    <div class="entry-content">
		<?php the_content( __( '', 'akvs' ) ); ?>
	    </div>
	    <footer class="entry-footer continue-reading">
		<a href="<?php echo get_permalink(); ?>" title="<?php echo __('Read ', 'akvs') . get_the_title(); ?>" rel="bookmark">
		    <?php echo __( 'Read the article<i class="fa fa-arrow-circle-o-right"></i>', 'akvs' ); ?>
		</a>
	    </footer><!-- .entry-footer -->
	<?php else: ?>
	    <div class="entry-content">
		<?php the_excerpt(); ?>
	    </div><!-- .entry-content -->
	    <footer class="entry-footer continue-reading">
		<a href="<?php echo get_permalink(); ?>" title="<?php echo __('Continue Reading ', 'akvs') . get_the_title(); ?>" rel="bookmark">
		    <?php echo __( 'Continue Reading<i class="fa fa-arrow-circle-o-right"></i>', 'akvs' ); ?>
		</a>
	    </footer><!-- .entry-footer -->
	<?php endif ?>
    </div><!-- .index-box -->
</article><!-- #post-## -->