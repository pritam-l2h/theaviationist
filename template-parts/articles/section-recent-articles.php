<?php
/**
 * The template part for display all article section
 *
 * @package nsc-blog
 */
?>
<style>
/* Base styles for the posts grid */
#nsc-recent-articles .nsc-blog-post-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

.post-container {
    background: #fff;
    border: 1px solid #e0e0e0;
    padding: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

/* Make the grid responsive */
@media (max-width: 1024px) {
    #nsc-recent-articles .nsc-blog-post-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    #nsc-recent-articles .nsc-blog-post-grid {
        grid-template-columns: 1fr;
    }
}

.post-container img {
    max-width: 100%;
    height: auto;
    display: block;
}
.nsc-post-cat,
.nsc-post-title,
.nsc-post-para,
.nsc-author-image,
.nsc-author-name,
.nsc-post-date,
.read-more-btn {
    margin-top: 10px;
}
.nsc-author-image {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}
.nsc-common-btn {
    background-color: #000;
    color: #fff;
    padding: 10px 20px;
    text-align: center;
    border: none;
    cursor: pointer;
    display: inline-block;
}

.dark-mode .nsc-common-btn{
  background-color: #fff;
  color: #000;
}
#nsc-recent-articles .nsc-blog-post-grid img.post-thumbnail {
    min-height: 99px;
    height: 100%;
    object-fit: cover;
}
.page-template-nsc-articles .nsc-post-page-grid .sidebar aside#search-3, .page-template-nsc-articles .nsc-post-page-grid .sidebar aside#nsc_tabbed_widget-2 {
    display: none;
}
.page-template-nsc-articles .nsc-post-page-grid .sidebar {
    margin-top: 70px;
}
</style>



<section id="nsc-recent-articles" class="nsc-all-articles">
    <h2 class="section-main-head">RECENT ARTICLES</h2>

    <?php
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 9,
        'paged' => 1,
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) { ?>
        <div class="nsc-blog-post-grid">
            <?php while ($query->have_posts()) : $query->the_post();
                get_template_part('template-parts/content', get_post_format());
            endwhile; ?>
        </div>
    <?php } else { ?>
        <h4><?php echo esc_html_e('Please add the post to see this section', 'nsc-blog'); ?></h4>
    <?php }
    wp_reset_postdata(); ?>
    <div class="nsc-common-btn-wrap text-center" >
      <button class="nsc-common-btn mt-4">
          <?php echo esc_html__('Load More', 'nsc-blog'); ?>
      </button>
    </div>
</section>
