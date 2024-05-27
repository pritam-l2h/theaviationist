<?php
/**
 * The template part for slider section
 *
 * @package nsc-blog
 */
?>
<section id="nsc-slider" class="mt-0">
  <div id="nsc-blog-slider-aviationist" class="carousel slide nsc-blog-slider-aviationist" data-bs-ride="carousel">

    <?php $args = array(
      'post_type' => 'post',
      'post_status' => 'publish',
      'posts_per_page' => get_theme_mod('nsc_blog_slider_post_num'),
    );
     $query = new WP_Query($args);
     if ( $query->have_posts() ) { ?>

    <div class="carousel-indicators">
      <?php $i = 1;
        while ($query->have_posts()) : $query->the_post(); ?>
      <button type="button"
              data-bs-target="#nsc-blog-slider-aviationist"
              data-bs-slide-to="<?php echo ($i - 1); ?>"
              class="<?php if ($i == 1 ) { echo "active"; } ?>"
              aria-current="<?php if ($i == 1 ) { echo "true"; } ?>"
              aria-label="Slide <?php echo $i; ?>"></button>
      <?php $i++; endwhile; ?>
    </div>
    <div class="carousel-inner">
      <?php $i = 1;
        while ($query->have_posts()) : $query->the_post();
          $image_id = get_post_thumbnail_id();
          $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
          $image_title = get_the_title($image_id);
         ?>
        <div class="carousel-item <?php if ($i == 1 ) { echo "active"; } ?>">
          <img class="d-block nsc-slider-image"
               src="<?php echo esc_url(get_the_post_thumbnail_url( get_the_ID(), 'full' )); ?>"
               alt="<?php echo esc_attr(($image_alt) ? $image_alt : get_the_title() ); ?>"
               title="<?php echo esc_attr(($image_title) ? $image_title : get_the_title() ); ?>" >

          <div class="carousel-caption">
            <?php
            echo ($i == 1 && $query->current_post == 0 ) ? '<h1 class="slider-nsc-post-title">' : '<h3 class="slider-nsc-post-title">' ?>
              <a href="<?php echo get_the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
                <?php echo esc_html(get_the_title()); ?>
              </a>
           <?php echo ($i == 1 && $query->current_post == 0) ? '</h1>' : '</h3>' ?>

           <ul class="post-metas mb-0">

             <?php if(get_theme_mod('nsc_blog_latest_posts_comments_count', true) != '0'){ ?>
                <li>
                  <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M5.99984 12.3333C2.77809 12.3333 0.166504 9.72171 0.166504 6.49996C0.166504 3.27821 2.77809 0.666626 5.99984 0.666626C9.22159 0.666626 11.8332 3.27821 11.8332 6.49996C11.8332 9.72171 9.22159 12.3333 5.99984 12.3333ZM5.99984 11.1666C7.23751 11.1666 8.4245 10.675 9.29967 9.79979C10.1748 8.92462 10.6665 7.73764 10.6665 6.49996C10.6665 5.26228 10.1748 4.0753 9.29967 3.20013C8.4245 2.32496 7.23751 1.83329 5.99984 1.83329C4.76216 1.83329 3.57518 2.32496 2.70001 3.20013C1.82484 4.0753 1.33317 5.26228 1.33317 6.49996C1.33317 7.73764 1.82484 8.92462 2.70001 9.79979C3.57518 10.675 4.76216 11.1666 5.99984 11.1666ZM6.58317 6.49996H8.9165V7.66663H5.4165V3.58329H6.58317V6.49996Z" fill="#8F90A6"/>
                  </svg>

                  <?php
                  $post_content = get_the_content();
                  $reading_time = nsc_blog_calculate_reading_time($post_content);
                  echo esc_html($reading_time . "Min Read", 'nsc-blog');
                  ?>
                </li>
              <?php } ?>
             <?php if(get_theme_mod('nsc_blog_latest_posts_comments_count', true) != '0'){ ?>
                <li>
                  <svg width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.59625 2.41317C3.68005 1.51482 5.2371 0.5625 7.00023 0.5625C8.76337 0.5625 10.3204 1.51482 11.4042 2.41317C11.9523 2.86749 12.3948 3.3208 12.7004 3.66052C12.8535 3.83067 12.9729 3.97306 13.0547 4.07384C13.0956 4.12425 13.1272 4.16431 13.1489 4.19229C13.1598 4.20628 13.1682 4.21726 13.1741 4.22501L13.1811 4.23418L13.1831 4.2369L13.1838 4.23779C13.1838 4.23779 13.1842 4.23836 12.8336 4.5C13.1842 4.76164 13.184 4.76189 13.184 4.76189L13.1831 4.7631L13.1811 4.76582L13.1741 4.77499C13.1682 4.78274 13.1598 4.79372 13.1489 4.80771C13.1272 4.83569 13.0956 4.87575 13.0547 4.92616C12.9729 5.02694 12.8535 5.16933 12.7004 5.33948C12.3948 5.6792 11.9523 6.13251 11.4042 6.58683C10.3204 7.48518 8.76337 8.4375 7.00023 8.4375C5.2371 8.4375 3.68005 7.48518 2.59625 6.58683C2.04814 6.13251 1.60567 5.6792 1.30006 5.33948C1.147 5.16933 1.0276 5.02694 0.945771 4.92616C0.904841 4.87575 0.873263 4.83569 0.851526 4.80771C0.840656 4.79372 0.832242 4.78274 0.826345 4.77499L0.819394 4.76582L0.817348 4.7631L0.816684 4.76221C0.816684 4.76221 0.816262 4.76164 1.1669 4.5C0.816262 4.23836 0.816443 4.23811 0.816443 4.23811L0.817348 4.2369L0.819394 4.23418L0.826345 4.22501C0.832242 4.21726 0.840656 4.20628 0.851526 4.19229C0.873263 4.16431 0.904841 4.12425 0.945771 4.07384C1.0276 3.97306 1.147 3.83067 1.30006 3.66052C1.60567 3.3208 2.04814 2.86749 2.59625 2.41317ZM1.1669 4.5L0.816443 4.23811C0.70063 4.39332 0.700448 4.60644 0.816262 4.76164L1.1669 4.5ZM1.72888 4.5C1.79036 4.5729 1.86455 4.65865 1.95057 4.75427C2.23532 5.0708 2.64712 5.49249 3.15464 5.91317C4.1821 6.76482 5.54171 7.5625 7.00023 7.5625C8.45876 7.5625 9.81837 6.76482 10.8458 5.91317C11.3533 5.49249 11.7651 5.0708 12.0499 4.75427C12.1359 4.65865 12.2101 4.5729 12.2716 4.5C12.2101 4.4271 12.1359 4.34135 12.0499 4.24573C11.7651 3.9292 11.3533 3.50751 10.8458 3.08683C9.81837 2.23518 8.45876 1.4375 7.00023 1.4375C5.54171 1.4375 4.1821 2.23518 3.15464 3.08683C2.64712 3.50751 2.23532 3.9292 1.95057 4.24573C1.86455 4.34135 1.79036 4.4271 1.72888 4.5ZM12.8336 4.5L13.184 4.76189C13.2998 4.60668 13.3 4.39356 13.1842 4.23836L12.8336 4.5Z" fill="#8F90A6"/>
                  <path d="M5.1044 4.5C5.1044 3.45297 5.9532 2.60417 7.00023 2.60417C8.04727 2.60417 8.89607 3.45297 8.89607 4.5C8.89607 5.54703 8.04727 6.39583 7.00023 6.39583C5.9532 6.39583 5.1044 5.54703 5.1044 4.5ZM7.00023 3.47917C6.43645 3.47917 5.9794 3.93622 5.9794 4.5C5.9794 5.06378 6.43645 5.52083 7.00023 5.52083C7.56402 5.52083 8.02107 5.06378 8.02107 4.5C8.02107 3.93622 7.56402 3.47917 7.00023 3.47917Z" fill="#8F90A6"/>
                  </svg>
                  <?php echo nsc_blog_get_reading_count(get_the_ID()); ?>
                </li>
              <?php } ?>
             <?php if(get_theme_mod('nsc_blog_latest_posts_comments_count', true) != '0'){ ?>
                <li>
                  <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M4.6665 8.37467H9.33317M4.6665 5.45801H6.99984" stroke="#8F90A6" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M3.55748 11.583C2.79908 11.5084 2.23094 11.2806 1.84992 10.8996C1.1665 10.2162 1.1665 9.11621 1.1665 6.91634V6.62467C1.1665 4.42478 1.1665 3.32485 1.84992 2.64142C2.53334 1.95801 3.63328 1.95801 5.83317 1.95801H8.1665C10.3664 1.95801 11.4664 1.95801 12.1497 2.64142C12.8332 3.32485 12.8332 4.42478 12.8332 6.62467V6.91634C12.8332 9.11621 12.8332 10.2162 12.1497 10.8996C11.4664 11.583 10.3664 11.583 8.1665 11.583C7.83955 11.5903 7.57915 11.6151 7.32335 11.6734C6.62429 11.8344 5.97696 12.1921 5.33726 12.504C4.42576 12.9485 3.97 13.1707 3.68399 12.9626C3.13682 12.5551 3.67165 11.2924 3.7915 10.708" stroke="#8F90A6" stroke-linecap="round"/>
                  </svg>
                  <?php $comments_count = wp_count_comments( $post->ID );
                  echo esc_html($comments_count->approved, 'nsc-blog');
                  ?>
                </li>
              <?php } ?>
           </ul>
          </div>
        </div>
      <?php $i++; endwhile; ?>
     </div>
  <?php
  }else { ?>
   <h4> <?php echo esc_html_e('Please add the post to see this section', 'nsc-blog'); ?> </h4>
  <?php }
  wp_reset_query(); ?>
  </div>
</section>
