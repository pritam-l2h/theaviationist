<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package nsc-blog
 */

get_header(); ?>

<?php do_action( 'nsc_blog_page_post_top' ); ?>

<main class="pt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <?php while ( have_posts() ) : the_post();
              get_template_part( 'template-parts/content-page');
          endwhile; ?>
        </div>
        <div class="col-md-4">
            <?php dynamic_sidebar('home-page');?>
        </div>
      </div>

    </div>
</main>

<?php do_action( 'nsc_blog_page_post_bottom' ); ?>

<?php get_footer(); ?>
