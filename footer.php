<?php
/**
 * The template for displaying the footer.
 *
 * @package nsc- blog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>
	  <footer class="nsc-footer">
	    <div class="custom-container nsc-footer-grid">
				<?php foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
					if ( is_active_sidebar( $sidebar['id'] ) && str_starts_with($sidebar['name'], 'Footer')) { ?>
						<div class="nsc-foot-column">
							<?php dynamic_sidebar($sidebar['id']); ?>
						</div>
					<?php }
				} ?>
	    </div>
			<div class="custom-container nsc-copyright text-center">
				<?php dynamic_sidebar( 'copyright-text' ); ?>
			</div>

	  </footer>
		<?php do_action('nsc_blog_body_bottom');
		wp_footer(); ?>
	</body>
</html>
