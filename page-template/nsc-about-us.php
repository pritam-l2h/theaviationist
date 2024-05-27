<?php
/*
* Template Name: NSC About Us
*
*
* @package nsc-blog
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();

$about_bgimage = get_theme_mod('nsc_blog_comments_policy_bgimage', get_template_directory_uri(). '/assets/images/About.png');
 ?>

<div class="ribbon-about custom-container">
  <div class="nsc-news-bar">
    <?php if (get_theme_mod('nsc_blog_news_ribbon_heading') != '') { ?>
      <span class="">
        <?php echo esc_html(get_theme_mod('nsc_blog_news_ribbon_heading')); ?>
      </span>
    <?php } ?>

    <?php 
    $args = array(
      'post_type' => 'post',
      'post_status' => 'publish',
      'posts_per_page' => get_theme_mod('nsc_blog_news_ribbon_post_num', 5), // Provide a default value
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) { ?>
      <div class="marquee-container"> <!-- Replace <marquee> with a container -->
        <div class="marquee">
          <?php while ($query->have_posts()) : $query->the_post(); ?>
            <span>
              <?php echo get_the_title(); ?>
            </span>
            <strong>
              <?php
              $categories = get_the_category();
              if (!empty($categories)) { ?>
                <?php echo esc_html($categories[0]->name); ?>
              <?php } ?>
            </strong>
          <?php endwhile; ?>
        </div>
      </div>
      <?php wp_reset_postdata(); // Reset post data ?>
    <?php } ?>
  </div>
</div>


 <main>
     <div class="custom-container">
         <?php echo nsc_blog_breadcrumb(); ?>
     </div>
     <div class="container-fluid">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/About.png" alt="About Image" class="about-banner" />
     </div>
   <div class="custom-container">
       
     <div class="row">
       <div class="col-md-8 test">
          
          <?php echo get_the_content(); ?>
       </div>
       <div class="col-md-4">
				 <?php dynamic_sidebar('home-page');?>
       </div>
     </div>
     <?php get_template_part('template-parts/nsc-user'); ?>
	 <?php get_template_part('template-parts/articles/section-video-interview'); ?>
 	 <?php get_template_part('template-parts/home/section-comment-policy'); ?>
  	 <?php get_template_part('template-parts/home/section-aviationist-carousel'); ?>
	 
   </div>
 </main>
<?php get_footer(); ?>
