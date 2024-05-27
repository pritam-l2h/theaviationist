<?php
/**
 * The Template for displaying search results.
 *
 * @package nsc-blog
 */
get_header();
get_template_part('template-parts/breadcrumb'); ?>

<section class="nsc-result-page" style="color: #fff">
	<div class="container">

		<?php if ( have_posts() ) :
      echo "<h2 class='search-head mt-3'>" . esc_html__('Posts', 'nsc-blog') . "</h2>";
			while ( have_posts() ) : the_post(); ?>
        <div class="search-post">
          <h3 class="nsc-post-title mt-2">
            <i class="fa-regular fa-clock me-2"></i>
            <a href="<?php echo get_the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
              <?php echo get_the_title(); ?>
            </a>
          </h3>
        </div>
      <?php endwhile; ?>
			<div class="nsc-post-navigation">
				<?php
				  the_posts_pagination( array(
					  'prev_text'          => __( 'Previous page', 'nsc-blog' ),
					  'next_text'          => __( 'Next page', 'nsc-blog' ),
					  'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'nsc-blog' ) . ' </span>',
				  )); ?>
			</div>
		<?php else : ?>
			<?php get_template_part( 'no-results', 'search' ); ?>
		<?php endif; ?>

    <?php
    $category_args = array(
        'taxonomy' => 'category',
        'name__like' => sanitize_text_field($_GET['s']),
    );
    $category_suggestions = get_categories($category_args);
    if (!empty($category_suggestions)) {
			echo "<h2 class='search-head mt-3'>" . esc_html__('Categories', 'nsc-blog') . "</h2>";
			foreach ($category_suggestions as $category) {
				echo '<h3 class="nsc-post-title mt-2"><i class="fa-solid fa-hashtag me-2"></i>
							<a href="' . esc_url(get_category_link($category->term_id)) . '" title="' . esc_url(get_category_link($category->term_id)) . '">'
								. esc_html($category->name) .
							'</a></h3>';
			}
		}
     ?>
    <div class="clearfix"></div>
  </div>
</section>
<?php get_footer(); ?>
