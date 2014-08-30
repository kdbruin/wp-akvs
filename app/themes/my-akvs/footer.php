<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package My AKV Soesterkwartier
 */
?>

</div><!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo">
    <?php get_sidebar( 'footer' ); ?>
    <div class="site-info">
        <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'my-akvs' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'my-akvs' ), 'WordPress' ); ?></a>
        <span class="sep"> | </span>
        <?php printf( __( 'Theme: %1$s by %2$s.', 'my-akvs' ), 'My AKV Soesterkwartier', '<a href="http://www.halfje-bruin.nl/" rel="designer">Kees de Bruin</a>' ); ?>
    </div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
