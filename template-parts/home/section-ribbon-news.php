<?php
/**
 * The template part for news scrollbar
 *
 * @package nsc-blog
 */
?>

<div class="nsc-news-bar">
  <?php if (get_theme_mod('nsc_blog_news_ribbon_heading') !=''){ ?>
    <span class="">
      <?php echo esc_html(get_theme_mod('nsc_blog_news_ribbon_heading')); ?>
    </span>
  <?php } ?>

  <?php $args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => get_theme_mod('nsc_blog_news_ribbon_post_num'),
  );
   $query = new WP_Query($args);
   if ( $query->have_posts() ) { ?>
     <marquee>
      <?php while ($query->have_posts()) : $query->the_post(); ?>
        <span>
          <?php echo get_the_title(); ?>
        </span>
        <strong>
          <?php
          $categories = get_the_category();
         if ( ! empty( $categories ) ) { ?>
             <?php echo esc_html( $categories[0]->name );  ?>
         <?php } ?>
        </strong>
     <?php endwhile; ?>
   </marquee>
 <?php } ?>
</div>
