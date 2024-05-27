<?php
/*
* Template parts to display logo
*
* @package nsc-blog
*/

$show_aside = get_theme_mod('nsc_blog_site_content_aside', false);
if($show_aside == 1) {
  $flex = 'd-flex align-items-center gap-2';
}else {
  $flex = '';
} ?>

  <div class="nsc-logo-header">

 <div class="custom-container">
     <div class="">
     <?php if (has_custom_logo() && get_theme_mod('nsc_blog_site_logo', true) != 0) { ?>
       <div class="nsc-logo <?php echo esc_attr($flex); ?>">
         <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr(get_bloginfo( 'name' )); ?>">
           <?php
           $image_alt = get_bloginfo( 'name' );
           $custom_logo_id = get_theme_mod( 'custom_logo' );
           $logo_url = wp_get_attachment_image_src( $custom_logo_id , 'full' ); ?>
           <img src="<?php echo esc_url($logo_url[0]); ?>" alt="<?php echo esc_attr(($image_alt) ? $image_alt : get_the_title() ); ?>" title="<?php echo esc_attr(($image_alt) ? $image_alt : get_the_title() ); ?>" >
         </a>

         <div class="">
           <?php if (get_theme_mod('nsc_blog_site_title', false) != 0){ ?>
             <h1 class="mb-0">
               <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr(get_bloginfo( 'name' )); ?>">
                 <?php $site_title = get_bloginfo( 'name' );
                 echo $site_title; ?>
               </a>
             </h1>
           <?php } ?>

           <?php if (get_theme_mod('nsc_blog_site_description', false) != 0){ ?>
             <p class="mb-0">
                 <?php $site_desc = get_bloginfo( 'description' );
                 echo $site_desc;
                 ?>
             </p>
           <?php } ?>
         </div>
       </div>
     <?php }else { ?>
       <?php if (get_theme_mod('nsc_blog_site_title', true) != 0 ){ ?>
         <h1 class="mb-0">
           <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr(get_bloginfo( 'name' )); ?>">
             <?php $site_title = get_bloginfo( 'name' );
             echo $site_title;
             ?>
           </a>
         </h1>
       <?php } ?>

       <?php if (get_theme_mod('nsc_blog_site_description', true) != 0 ){ ?>
         <p class="mb-0">
             <?php $site_desc = get_bloginfo( 'description' );
             echo $site_desc;
             ?>
         </p>
       <?php } } ?>
   </div>


   <label for="nsc-theme-modes" class="d-flex align-items-center gap-2">
     <input type="checkbox" name="nsc-theme-mod" value="" id="nsc-theme-modes">
     <span class="nsc-circle"></span>
     <span class="light">Light Mode</span>
     <span class="dark">Dark Mode</span>
   </label>
   
<!-- Search Icon -->
<div class="search-icon-container-1">

  <button type="button" id="search-icon">
    <svg id="search-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
    <circle cx="11" cy="11" r="8"></circle>
    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
  </svg>
  </button>  
  <button type="button" id="close-search-form" class="close-btn" style="display: none;">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
  </button>
  <form id="search-form" role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label>
      <input type="search" class="search-field" placeholder="Search …" value="" name="s" title="Search for:">
    </label>
    <button type="submit" class="search-submit">
      <svg id="search-submit-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
        <circle cx="11" cy="11" r="8"></circle>
        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
      </svg>
    </button>
  </form>
</div>


   
 </div>
 </div>
 
 <script>
const searchForm = document.getElementById('search-form');
const searchField = document.querySelector('#search-form .search-field');
const searchIcon = document.getElementById('search-icon');
const closeBtn = document.getElementById('close-search-form');

searchIcon.addEventListener('click', () => {
  searchField.style.width = '200px'; // Set the desired width
  searchField.style.border = '1px solid #ffcc00';
  searchIcon.style.display = 'none';
  closeBtn.style.display = 'block';
});

closeBtn.addEventListener('click', () => {
  searchField.style.width = '0';
  searchField.style.border = '1px solid transparent';
  searchIcon.style.display = 'block';
  closeBtn.style.display = 'none';
});




 </script>
