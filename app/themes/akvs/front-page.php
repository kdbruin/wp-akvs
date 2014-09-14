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
		<article id="front-page-featured-slider">
			<div class="entry-content">

			<?php $feat_posts = akvs_show_featured_posts(); ?>

			</div><!-- .entry-content -->
		</article><!-- #front-page-featured-slider -->

		<article id="front-page-latest-posts">
			<div class="entry-header">
				<h1 class="entry-title">Laatste nieuws</h1>
			</div>
			<div class="entry-content">

			<?php akvs_latest_posts( $feat_posts ); ?>

			</div><!-- .entry-content -->
		</article><!-- #front-page-latest-posts -->

		<article id="front-page-latest-games">
			<div class="entry-header">
				<h1 class="entry-title">Wedstrijden deze week</h1>
			</div>
			<div class="entry-content">

			<?php akvs_latest_games(); ?>

			</div><!-- .entry-content -->
		</article><!-- #front-page-latest-games -->

        <article id="front-page-latest-scores">

		    <?php akvs_latest_scores(); ?>

		</article><!-- #front-page-latest-scores -->
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar( 'front-page' ); ?>
<?php get_footer(); ?>
