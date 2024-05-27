<?php
/*
* Template Name: NSC Post Tags
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
    $tag_args = get_tags(array(
      'hide_empty' => false,
			// 'number' => $tag_num
    ));
    $tags = get_tags( $tag_args );

     //if(get_theme_mod('nsc_blog_single_post_title', true) != '0'){ ?>
      <?php echo ($headh1 == 0) ? '<h1 class="nsc-cat-head">' : '<h2 class="nsc-cat-head">' ?>
        <?php echo (count($tags) > 1 ) ? esc_html__("Tags", 'nsc-blog') : esc_html__("Tag", 'nsc-blog');
        //echo get_the_title(); ?>
      <?php echo ($headh1 == 0) ? '</h1>' : '</h2>' ?>
    <?php //} ?>
    <div class="row">
      <?php foreach ( $tags as $tag ) { ?>
          <div class="col-md-3 mb-4">
            <div class="nsc-post-cat-card">
              <a href="<?php echo esc_url(get_category_link($tag->term_id)); ?>" class="d-block" title="<?php echo esc_attr($tag->name); ?>">
                <div class="px-2 py-3">
                  <p class="cat-name mb-0"><?php echo esc_html($tag->name); ?></p>
                  <span class="nsc-author"><?php echo esc_html($tag->count) . (($tag->count > 1) ? ' Posts' : 'Post') ?></span>
                </div>
              </a>
            </div>
          </div>
        <?php } ?>
    </div>
 </div>
</main>
<?php get_footer(); ?>
