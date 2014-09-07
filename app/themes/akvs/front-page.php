<?php
/**
 * The template for displaying the static front page.
 *
 * @package AKV Soesterkwartier
 */
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	    <div class="entry-content">

	    <?php
	    $feat_posts = akvs_show_featured_posts();
	    ?>

	    </div><!-- .entry-content -->
	</article><!-- #post-## -->
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar( 'front-page' ); ?>
<?php get_footer(); ?>
