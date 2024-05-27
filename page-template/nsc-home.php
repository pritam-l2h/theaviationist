<?php
/*
* Template Name: NSC Homepage
*
*
* @package nsc-blog
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>
	<main id="nsc-primary">
		<div class="custom-container">
			<?php get_template_part('template-parts/home/section-ribbon-news'); ?>

			<div class="nsc-post-page-grid">
				<div class="">
					<?php get_template_part('template-parts/home/section-slider'); ?>
					<?php get_template_part('template-parts/home/section-category'); ?>
					<?php get_template_part('template-parts/home/section-other-articles'); ?>
					<?php get_template_part('template-parts/home/section-popular-post'); ?>
					<?php get_template_part('template-parts/home/section-all-articles'); ?>
				</div>

				<aside class="nsc-home-sidebar">
					<?php dynamic_sidebar('home-page');?>
				</aside>
			</div>
		</div>
			<?php get_template_part('template-parts/home/section-comment-policy'); ?>
		<div class="custom-container">
			<?php get_template_part('template-parts/home/section-aviationist-carousel'); ?>
		</div>
	</main>

<?php
get_footer();
