<?php
/**
 * The template part for display comment policy
 *
 * @package nsc-blog
 */

 $bgimage = get_theme_mod('nsc_blog_comments_policy_bgimage', get_template_directory_uri(). '/assets/images/comment-policy.png');
?>
<section class="nsc-comments-policy" style="background-image: url(<?php echo $bgimage ?>)">
  <div class="container">
    <div class="row">
      <div class="col-md-12 d-flex justify-content-start">
        <div class="">
          <?php if (get_theme_mod('nsc_blog_comment_policy_heading') !='') { ?>
              <h2 class="section-heading"><?php echo esc_html(get_theme_mod('nsc_blog_comment_policy_heading')); ?></h2>
          <?php } ?>

          <?php if (get_theme_mod('nsc_blog_comment_policy_para') !='') { ?>
              <p><?php echo esc_html(get_theme_mod('nsc_blog_comment_policy_para')); ?> </p>
          <?php } ?>

          <?php if (get_theme_mod('nsc_blog_comment_policy_btn') !='') { ?>
            <a href="<?php echo esc_html(get_theme_mod('nsc_blog_comment_policy_btn_url')); ?>" class="got-it-btn">
              <?php echo esc_html(get_theme_mod('nsc_blog_comment_policy_btn')); ?>
            </a>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>
