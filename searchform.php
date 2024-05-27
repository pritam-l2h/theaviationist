<?php
/**
 * The template for displaying search forms in nsc-blog
 *
 * @package nsc-blog
 */
?>

<form role="search" method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
    <label for="s" class="screen-reader-text"><?php _e('Search for:', 'nsc-blog'); ?></label>
    <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s"  placeholder="<?php echo esc_attr__('Search...', 'nsc-blog'); ?>" autocomplete="off" required />
    <input type="hidden" name="post_type" value="post" />
    <label for="searchsubmit">
      <input type="submit" id="searchsubmit" value="<?php echo esc_attr__('Search', 'nsc-blog'); ?>" class="d-none" />
      <?php /*
      <i class="fas fa-search"></i>
      */ ?>
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#4F4F4F" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
      <path d="M21 21L16.65 16.65" stroke="#4F4F4F" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      <span class="screen-reader-text">
        <?php echo esc_html(get_theme_mod('nsc_blog_search_button',__('Search','nsc-blog')));?>
      </span>
    </label>
</form>
