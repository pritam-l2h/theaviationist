<?php
/*
* Template Name: NSC Post Categories
*
* @package nsc-blog
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
$headh1 = get_theme_mod('nsc_blog_site_title', true);

?>
<main class="nsc-category-list">
  <div class="container">

    <?php
    $cat_args = array(
      'orderby' => 'slug',
      'parent' => 0,
    );
    $categories = get_categories( $cat_args );

     //if(get_theme_mod('nsc_blog_single_post_title', true) != '0'){ ?>
      <?php echo ($headh1 == 0) ? '<h1 class="nsc-cat-head">' : '<h2 class="nsc-cat-head">' ?>

        <?php echo (count($categories) > 1 ) ? esc_html__("Categories", 'nsc-blog') : esc_html__("Category", 'nsc-blog');
        //echo get_the_title(); ?>
      <?php echo ($headh1 == 0) ? '</h1>' : '</h2>' ?>
    <?php //} ?>
    <div class="row">
      <?php
        foreach ($categories as $category) {
          $cat_img_id = get_term_meta($category->term_id, 'category-image-id', true);
          $image_alt = get_post_meta($cat_img_id, '_wp_attachment_image_alt', TRUE);
          $image_title = get_the_title($cat_img_id);
          $dummy_image_url = get_template_directory_uri() . '/assets/images/dummy-cat-image.jpg';
          ?>

          <div class="col-md-4 mb-4">
            <div class="nsc-post-cat-card">
              <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="d-block" title="<?php esc_attr(($image_title) ? $image_title : $category->name) ?>">
                <?php if (empty($cat_img_id)) { ?>
                  <img src="<?php echo esc_url($dummy_image_url); ?>" alt="<?php echo esc_attr(($image_alt) ? $image_alt : $category->name ); ?>" title="<?php esc_attr(($image_title) ? $image_title : $category->name) ?>">
                <?php }else { ?>
                  <img src="<?php echo esc_url( wp_get_attachment_image_url($cat_img_id, 'thumbnail')); ?>" alt="<?php echo esc_attr(($image_alt) ? $image_alt : $category->name ); ?>" title="<?php echo esc_attr(($image_title) ? $image_title : $category->name); ?>">
                <?php } ?>
                <div class="px-2 py-3">
                  <p class="cat-name mb-0"><?php echo esc_html($category->name); ?></p>
                  <span class="nsc-author"><?php echo esc_html($category->category_count) . (($category->category_count > 1) ? ' Posts' : 'Post') ?></span>
                </div>
              </a>
            </div>
          </div>
        <?php } ?>
    </div>
 </div>
</main>
<?php get_footer(); ?>
