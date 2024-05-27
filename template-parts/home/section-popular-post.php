<?php
/**
 * The template part for popular post section
 *
 * @package nsc-blog
 */
?>
<section id="nsc-popular-post" class="nsc-popular-post">
    <div class="section-title-wrap">
      <h2 class="section-main-head">POPULAR POST</h2>

      <a href="javascript:void(0);" onclick="openCategoryPopup()" class="see-more-cat-btn">
        <?php echo esc_html(get_theme_mod('nsc_blog_category_see_more')); ?>
      </a>
    </div>
    <?php $args = array(
      'post_type' => 'post',
      'post_status' => 'publish',
      'posts_per_page' => 5,
      'meta_query' => array(
          array(
             'key' => 'reading_count',
         ),
       ),
       'orderby'  => 'meta_value_num',
       // 'meta_key' => 'reading_count',
       'order'    => 'DESC',
    );
     $query = new WP_Query($args);
     if ( $query->have_posts() ) { ?>
        <div class="nsc-blog-grid-5">
         <?php while ($query->have_posts()) : $query->the_post();
         $image_id = get_post_thumbnail_id();
         $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
         $image_title = get_the_title($image_id);
          ?>

          <div class="post-container">
            <img class="pop-thumb"
            src="<?php echo esc_url(get_the_post_thumbnail_url( get_the_ID(), 'full' )); ?>"
            alt="<?php echo esc_attr(($image_alt) ? $image_alt : get_the_title() ); ?>"
            title="<?php echo esc_attr(($image_title) ? $image_title : get_the_title() ); ?>" >

            <div class="">
                <?php
                $categories = get_the_category();
               if ( ! empty( $categories ) ) { ?>
                 <a class="nsc-post-cat" href="<?php echo esc_attr( esc_url( get_category_link( $categories[0]->term_id ) ) ); ?>" title="<?php echo esc_attr( $categories[0]->name );  ?>">
                   <?php echo esc_html( $categories[0]->name );  ?>
                 </a>
               <?php } ?>

               <h3 class="nsc-post-title mb-0">
                 <a href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
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

                       <p class="nsc-post-date mb-0">
                      <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                         <path d="M11.0003 3.74072H4.00033C2.95329 3.74072 2.10449 4.58952 2.10449 5.63656V11.4699C2.10449 12.5169 2.95329 13.3657 4.00033 13.3657H11.0003C12.0474 13.3657 12.8962 12.5169 12.8962 11.4699V5.63656C12.8962 4.58952 12.0474 3.74072 11.0003 3.74072Z" stroke="#8F90A6"/>
                         <path d="M4.4375 2.57373V4.6154" stroke="#8F90A6" stroke-linecap="round"/>
                         <path d="M2.6875 6.36572H12.3125" stroke="#8F90A6" stroke-linecap="round"/>
                         <path d="M10.8545 2.57373V4.6154" stroke="#8F90A6" stroke-linecap="round"/>
                         <path d="M5.3125 9.13623C5.55412 9.13623 5.75 8.94036 5.75 8.69873C5.75 8.45711 5.55412 8.26123 5.3125 8.26123C5.07088 8.26123 4.875 8.45711 4.875 8.69873C4.875 8.94036 5.07088 9.13623 5.3125 9.13623Z" fill="#8F90A6"/>
                         <path d="M7.64551 9.13623C7.88713 9.13623 8.08301 8.94036 8.08301 8.69873C8.08301 8.45711 7.88713 8.26123 7.64551 8.26123C7.40388 8.26123 7.20801 8.45711 7.20801 8.69873C7.20801 8.94036 7.40388 9.13623 7.64551 9.13623Z" fill="#8F90A6"/>
                         <path d="M9.97949 9.13623C10.2211 9.13623 10.417 8.94036 10.417 8.69873C10.417 8.45711 10.2211 8.26123 9.97949 8.26123C9.73787 8.26123 9.54199 8.45711 9.54199 8.69873C9.54199 8.94036 9.73787 9.13623 9.97949 9.13623Z" fill="#8F90A6"/>
                         <path d="M5.3125 11.4697C5.55412 11.4697 5.75 11.2739 5.75 11.0322C5.75 10.7906 5.55412 10.5947 5.3125 10.5947C5.07088 10.5947 4.875 10.7906 4.875 11.0322C4.875 11.2739 5.07088 11.4697 5.3125 11.4697Z" fill="#8F90A6"/>
                         <path d="M7.64551 11.4697C7.88713 11.4697 8.08301 11.2739 8.08301 11.0322C8.08301 10.7906 7.88713 10.5947 7.64551 10.5947C7.40388 10.5947 7.20801 10.7906 7.20801 11.0322C7.20801 11.2739 7.40388 11.4697 7.64551 11.4697Z" fill="#8F90A6"/>
                         <path d="M9.97949 11.4697C10.2211 11.4697 10.417 11.2739 10.417 11.0322C10.417 10.7906 10.2211 10.5947 9.97949 10.5947C9.73787 10.5947 9.54199 10.7906 9.54199 11.0322C9.54199 11.2739 9.73787 11.4697 9.97949 11.4697Z" fill="#8F90A6"/>
                       </svg>
                           <span>
                               <?php echo get_the_date(); ?>
                           </span>
                           </p>
                   </div>
               </div>

               <a href="<?php echo get_the_permalink(); ?>" class="read-more-btn" title="<?php echo esc_attr(get_the_title()); ?>">
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
       <?php endwhile; ?>
       </div>
    <?php  }else { ?>
      <h4> <?php echo esc_html_e('Please add the post to see this section', 'nsc-blog'); ?> </h4>
     <?php }
     wp_reset_query(); ?>

</section>
