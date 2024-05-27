<?php
/**
 * The template part for menu
 *
 * @package nsc-blog
 */
?>

<div class="custom-container nsc-menu-header">
  <nav class="navbar navbar-expand-lg">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nsc-blog-navbar" aria-controls="nsc-blog-navbar" aria-expanded="false" aria-label="Toggle navigation">
      <svg width="26" height="18" viewBox="0 0 26 18" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" clip-rule="evenodd" d="M0.25 1.5625C0.25 0.975697 0.725697 0.5 1.3125 0.5H24.6875C25.2743 0.5 25.75 0.975697 25.75 1.5625C25.75 2.1493 25.2743 2.625 24.6875 2.625H1.3125C0.725697 2.625 0.25 2.1493 0.25 1.5625ZM0.25 9C0.25 8.4132 0.725697 7.9375 1.3125 7.9375H24.6875C25.2743 7.9375 25.75 8.4132 25.75 9C25.75 9.5868 25.2743 10.0625 24.6875 10.0625H1.3125C0.725697 10.0625 0.25 9.5868 0.25 9ZM11.9375 16.4375C11.9375 15.8507 12.4132 15.375 13 15.375H24.6875C25.2743 15.375 25.75 15.8507 25.75 16.4375C25.75 17.0243 25.2743 17.5 24.6875 17.5H13C12.4132 17.5 11.9375 17.0243 11.9375 16.4375Z" fill="white"/>
      </svg>
      <span class="screen-reader-text">
        <?php echo esc_html(get_theme_mod('nsc_blog_menu_close',__('menu open','nsc-blog')));?>
      </span>
    </button>
    <div class="collapse navbar-collapse" id="nsc-blog-navbar">
      <button class="navbar-close" type="button">
        <i class="fa-solid fa-xmark"></i>
        <span class="screen-reader-text">
          <?php echo esc_html(get_theme_mod('nsc_blog_menu_close',__('menu close','nsc-blog')));?>
        </span>
      </button>
      <?php
        wp_nav_menu( array(
          'theme_location' => 'primary',
          'container_class' => 'clearfix' ,
          'menu_class' => 'main-menu clearfix',
          'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
          'fallback_cb' => 'wp_page_menu',
        ) );
      ?>
    </div>
  </nav
</div>
