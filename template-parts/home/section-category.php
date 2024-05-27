<?php
/**
 * The template part for category section
 *
 * @package nsc-blog
 */
?>
<section id="nsc-home-category" class="nsc-home-category">

  <div class="d-flex align-items-center justify-content-between">
    <?php if (get_theme_mod('nsc_blog_category_heading') != ''){ ?>
      <h2 class="section-main-head">
        <?php echo esc_html(get_theme_mod('nsc_blog_category_heading')); ?>
      </h2>
    <?php } ?>

    <?php if (get_theme_mod('nsc_blog_category_see_more') != ''){ ?>
      <a href="javascript:void(0);" onclick="openCategoryPopup()" class="see-more-cat-btn">
        <?php echo esc_html(get_theme_mod('nsc_blog_category_see_more')); ?>
      </a>
    <?php } ?>
  </div>
  <?php
    $cats_args = array(
        'number'     => get_theme_mod('nsc_blog_category_cat_num'),
        'orderby'    => 'name',
        'order'      => 'asc',
        'hide_empty' => true,
    );

    $categories = get_categories($cats_args); ?>

    <ul class="nav nav-pills" id="nsc-home-tab-container" role="tablist">
      <?php
     foreach ($categories as $key => $category){ ?>
        <li class="nav-item" role="presentation">
        <button
            class="nav-link <?php if($key == 0){ echo "active"; }?>"
            id="<?php echo strtolower(str_replace(" ", "-", $category->name)); ?>-tab"
            data-bs-toggle="tab"
            data-bs-target="#<?php echo strtolower(str_replace(" ", "-", $category->name)); ?>-tab-pane"
            type="button"
            role="tab"
            aria-controls="<?php echo strtolower(str_replace(" ", "-", $category->name)); ?>-tab-pane"
            aria-selected="<?php if($key == 0){ echo "true"; }else { echo "false"; } ?>">
            <a href="#<?php echo strtolower(str_replace(" ", "-", $category->name)); ?>-tab-pane">
                <?php echo esc_html($category->name); ?> 
            </a>
        </button>
        </li>
      <?php } ?>
  </ul>
<div class="tab-content" id="nsc-home-tab-containerContent">
  <?php foreach ($categories as $key => $category){
    $args = array(
      'post_type' => 'post',
      'post_status' => 'publish',
      'posts_per_page' => 6,
      'tax_query' => array(
        array(
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => $category->slug,
        ),
      ),
    );

     $query = new WP_Query($args);
       if ( $query->have_posts() ) { ?>
         <div class="tab-pane fade <?php if($key == 0){ echo "show active"; }?> nsc-blog-post-grid"
              id="<?php echo strtolower(str_replace(" ", "-", $category->name)); ?>-tab-pane"
              role="tabpanel"
              aria-labelledby="<?php echo strtolower(str_replace(" ", "-", $category->name)); ?>-tab"
              tabindex="0">
        <?php
        while ($query->have_posts()) : $query->the_post(); ?>
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
                       <p class="nsc-author-name mb-0 me-2"><?php echo get_the_author(); ?></p>
                     <?php } ?>

                     <p class="nsc-post-date mb-0 d-flex align-items-center gap-1">
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

             <a href="<?php echo get_the_permalink(); ?>" class="read-more-btn">
               <?php echo esc_html__('Read More', 'nsc-blog'); ?>
               <svg width="14" height="10" viewBox="0 0 14 10" fill="none" xmlns="http://www.w3.org/2000/svg" class="ms-1">
               <path fill-rule="evenodd" clip-rule="evenodd" d="M0 4.97008C0 4.68511 0.231012 4.4541 0.515981 4.4541L12.9 4.4541C13.185 4.4541 13.416 4.68511 13.416 4.97008C13.416 5.25505 13.185 5.48606 12.9 5.48606L0.515981 5.48606C0.231012 5.48606 0 5.25505 0 4.97008Z" fill="url(#paint0_linear_240_177)"/>
               <path fill-rule="evenodd" clip-rule="evenodd" d="M9.8175 0.445784C10.0364 0.263348 10.3618 0.29292 10.5442 0.511835L13.8007 4.41946C14.0665 4.73838 14.0665 5.20164 13.8007 5.52056L10.5442 9.42819C10.3618 9.64711 10.0364 9.67668 9.8175 9.49424C9.59858 9.3118 9.56901 8.98644 9.75145 8.76753L12.9162 4.97001L9.75145 1.1725C9.56901 0.953581 9.59858 0.628221 9.8175 0.445784Z" fill="url(#paint1_linear_240_177)"/>
               <defs>
               <linearGradient id="paint0_linear_240_177" x1="0" y1="4.97008" x2="13.416" y2="4.97008" gradientUnits="userSpaceOnUse">
               <stop stop-color="#FFD11A"/>
               <stop offset="1" stop-color="#DE772E"/>
               </linearGradient>
               <linearGradient id="paint1_linear_240_177" x1="9.63184" y1="4.97001" x2="14" y2="4.97001" gradientUnits="userSpaceOnUse">
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
   <?php }else {
     echo "<h4>No posts found.</h4>";
   }
    wp_reset_query(); ?>

  <?php } ?>
</div>
<a id="view-more-btn" href="<?php echo esc_attr( esc_url( get_category_link( $categories[0]->term_id ) ) ); ?>" class="nsc-common-btn mt-4">
  <?php echo esc_html(get_theme_mod('nsc_blog_category_view_more', 'View More')) ?>
</a>

</section>

<script>

document.addEventListener('DOMContentLoaded', function () {
  const viewMoreBtn = document.getElementById('view-more-btn');
  const tabButtons = document.querySelectorAll('#nsc-home-tab-container .nav-link');

  function updateViewMoreHref() {
    const activeTab = document.querySelector('#nsc-home-tab-container .nav-link.active');
  
    if (activeTab) {
      const activeTabIndex = Array.from(tabButtons).indexOf(activeTab); // Get index of active tab
      const categoryLinks = document.querySelectorAll('.nsc-post-cat'); // Assuming category links have this class
      if (categoryLinks[activeTabIndex]) {
        viewMoreBtn.href = categoryLinks[activeTabIndex].getAttribute('href');
      }
    } 
  }

  tabButtons.forEach(button => {
    button.addEventListener('click', updateViewMoreHref);
  });

  // Update on page load
  updateViewMoreHref();
});
</script>
