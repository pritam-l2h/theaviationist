<?php
/**
 * The Template for displaying all single posts.
 *
 * @package nsc-blog
 */

 get_header();

 $sidebar = get_theme_mod('nsc_blog_category_sidebar', true);

 if ($sidebar == 0){
   $col8 = 'col-md-12';
 }else {
   $col8 = 'col-md-8';
 }

 $headh1 = get_theme_mod('nsc_blog_site_title', true);
 ?>

<main id="nsc-archieve" class="nsc-archieve">

  <?php
   if(get_theme_mod('nsc_blog_category_page_banner', true) != '0'){ ?>
    <div class="nsc-cat-image position-relative">
       <?php
        if (is_date()) {
          $date_query_args = array(
              'year' => get_query_var('year'),
              'monthnum' => get_query_var('monthnum'),
              'day' => get_query_var('day'),
          );
          $date_query = new WP_Query($date_query_args);
          $image_alt = $date_query->query['year'] . " Year category image";
          $image_title = $date_query->query['year'] . " Year category image";
          $post_count = $date_query->found_posts;
        }else {
          $category = get_queried_object();
          $cat_img_id = get_term_meta( $category->term_id, 'category-image-id', true );
          $image_alt = get_post_meta($cat_img_id, '_wp_attachment_image_alt', TRUE);
          $image_title = get_the_title($cat_img_id);
        }

          if ( ! empty( $cat_img_id ) && (!is_date()) ) {
            $cat_img_url = wp_get_attachment_image_url( $cat_img_id, 'full' );
            echo '<img src="' . esc_url( $cat_img_url ) . '" alt="'. (($image_alt) ? $image_alt : $category->name) .'" title="'.(($image_title) ? $image_title : $category->name).'">';
          }else {
            $cat_img_url = get_template_directory_uri(). '/assets/images/category-image.webp';
            echo '<img src="' . esc_url( $cat_img_url ) . '" alt="'. (($image_alt) ? $image_alt : $category->name) .'" title="'.(($image_title) ? $image_title : $category->name).'">';
          } ?>

      <div class="position-absolute top-50 start-50 translate-middle text-center">
        <?php
         if(get_theme_mod('nsc_blog_category_name', true) != '0'){
         echo ($headh1 == 0) ? '<h1 class="nsc-cat-head">' : '<h2 class="nsc-cat-head">';
            if (!is_date()) {
              echo esc_html($category->name, 'nsc-blog');
            }else {
              echo esc_html(get_the_date('Y'));
            }
          echo ($headh1 == 0) ? '</h1>' : '</h2>';
        }
         ?>

        <?php
          if(get_theme_mod('nsc_blog_category_post_count', true) != '0'){ ?>
            <p class="nsc-cat-count">
              <?php if (!is_date()) {
                echo esc_html($category->count . " Articles", 'nsc-blog');
              }else {
                 echo esc_html($post_count . " Articles", 'nsc-blog');
              } ?>
            </p>
        <?php } ?>

      </div>
    </div>
  <?php } ?>

  <div class="container">
    <div class="row">
      <div class="<?php echo esc_attr($col8); ?> nsc-all-articles">
        <div class="nsc-blog-post-grid">
        <?php if ( have_posts() ) :
          while ( have_posts() ) : the_post(); ?>
          <div class="post-container">
            <?php
            $image_id = get_post_thumbnail_id();
            $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
            $image_title = get_the_title($image_id); ?>

            <img src="<?php echo esc_url(get_the_post_thumbnail_url( get_the_ID(), 'medium' )); ?>" alt="<?php echo esc_attr(($image_alt) ? $image_alt : get_the_title() ); ?>" title="<?php echo esc_attr(($image_title) ? $image_title : get_the_title() ); ?>">
            <div class="">
                <?php
                $categories = get_the_category();
               if ( ! empty( $categories ) ) { ?>
                 <a class="nsc-post-cat" href="<?php echo esc_attr( esc_url( get_category_link( $categories[0]->term_id ) ) ); ?>" title="<?php echo esc_attr( $categories[0]->name );  ?>">
                   <?php echo esc_html( $categories[0]->name );  ?>
                 </a>
               <?php } ?>

               <h3 class="nsc-post-title mb-0">
                 <a href="<?php echo get_the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
                   <?php echo get_the_title(); ?>
                 </a>
               </h3>
               <div class="nsc-post-para">
                 <?php echo get_the_content(); ?>
               </div>

               <div class="d-flex align-items-center gap-2">
                   <div class="d-flex align-items-center gap-2">
                   <?php $avatar_html = get_avatar(get_the_author_meta('ID'));
                       $avatar_url = '';
                       if (!empty($avatar_html)) {
                         $dom = new DOMDocument;
                         $dom->loadHTML($avatar_html);

                         $img_tags = $dom->getElementsByTagName('img');

                         if ($img_tags->length > 0) {
                           $avatar_url = $img_tags->item(0)->getAttribute('src');
                         }
                       } ?>

                     <?php
                     if(get_theme_mod('nsc_blog_single_post_author_image', true) != '0'){
                        if (!empty($avatar_url)) : ?>
                         <img src="<?php echo esc_url($avatar_url); ?>" alt="<?php echo get_the_author(); ?>" class="nsc-author-image" title="<?php echo get_the_author(); ?>">
                       <?php else : ?>
                         <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/default-user.png'); ?>" alt="<?php echo get_the_author(); ?>" class="nsc-author-image"  title="<?php echo get_the_author(); ?>">
                       <?php endif;
                     } ?>

                       <?php if(get_theme_mod('nsc_blog_single_post_author_name', true) != '0'){ ?>
                         <p class="nsc-author-name mb-0"><?php echo get_the_author(); ?></p>
                       <?php } ?>

                       <p class="nsc-post-date mb-0"><?php echo get_the_date(); ?></p>
                   </div>
               </div>

               <a href="<?php echo get_the_permalink(); ?>" class="read-more-btn">
                 <?php echo esc_html__('Read More', 'nsc-blog'); ?>
                 <svg width="15" height="10" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                 <path fill-rule="evenodd" clip-rule="evenodd" d="M0.5 5.05089C0.5 4.76592 0.731012 4.53491 1.01598 4.53491L13.4 4.53491C13.685 4.53491 13.916 4.76592 13.916 5.05089C13.916 5.33586 13.685 5.56687 13.4 5.56687L1.01598 5.56687C0.731012 5.56687 0.5 5.33586 0.5 5.05089Z" fill="url(#paint0_linear_268_2268)"/>
                 <path fill-rule="evenodd" clip-rule="evenodd" d="M10.3175 0.526839C10.5364 0.344403 10.8618 0.373975 11.0442 0.59289L14.3007 4.50052C14.5665 4.81944 14.5665 5.2827 14.3007 5.60162L11.0442 9.50924C10.8618 9.72816 10.5364 9.75773 10.3175 9.5753C10.0986 9.39286 10.069 9.0675 10.2514 8.84858L13.4162 5.05107L10.2514 1.25355C10.069 1.03464 10.0986 0.709276 10.3175 0.526839Z" fill="url(#paint1_linear_268_2268)"/>
                 <defs>
                 <linearGradient id="paint0_linear_268_2268" x1="0.5" y1="5.05089" x2="13.916" y2="5.05089" gradientUnits="userSpaceOnUse">
                 <stop stop-color="#FFD11A"/>
                 <stop offset="1" stop-color="#DE772E"/>
                 </linearGradient>
                 <linearGradient id="paint1_linear_268_2268" x1="10.1318" y1="5.05107" x2="14.5" y2="5.05107" gradientUnits="userSpaceOnUse">
                 <stop stop-color="#FFD11A"/>
                 <stop offset="1" stop-color="#DE772E"/>
                 </linearGradient>
                 </defs>
                 </svg>

               </a>

              </div>
          </div>
          <?php endwhile;
          else :
            get_template_part( 'no-results' );
          endif; ?>
          </div>

          <?php
           $big = 999999999;
           echo '<div class="nsc-post-navigation">';
           echo paginate_links(array(
               'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
               'format' => '?paged=%#%',
               'current' => max(1, get_query_var('paged')),
               'total' => $wp_query->max_num_pages,
           ));
           echo '</div>';
           ?>

      </div>

      <?php if(get_theme_mod('nsc_blog_category_sidebar', true) != '0'){ ?>
        <aside class="col-md-4 nsc-sidebar">
          <?php dynamic_sidebar('home-page');?>
        </aside>
      <?php } ?>

    </div>
  </div>
</main>


<?php get_footer(); ?>
