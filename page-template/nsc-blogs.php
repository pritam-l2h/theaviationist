<?php
/*
* Template Name: NSC Blogs
*
* @package nsc-blog
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

<div id="nsc-blogs" class="mt-5">
	<div class="container">
    	<div class="content_page row pb-5">
				<?php if ( have_posts() ) :
		      $nsc_blog_paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
					$nsc_blog_args = array(
						'paged' => $nsc_blog_paged,
					);
					$nsc_blog_query = new WP_Query( $nsc_blog_args );
					while($nsc_blog_query->have_posts()) :
					   $nsc_blog_query->the_post();
						 ?>
             <div class="col-lg-4 col-md-6 mb-4">
               <div class="nsc-latest-article-container">
								 <?php $image_id = get_post_thumbnail_id();
			             $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
			             $image_title = get_the_title($image_id); ?>

                 	<img src="<?php echo esc_url(get_the_post_thumbnail_url( get_the_ID(), 'medium' )); ?>" alt="<?php echo esc_attr(($image_alt) ? $image_alt : get_the_title() ); ?>" title="<?php echo esc_attr(($image_title) ? $image_title : get_the_title() ); ?>">

                 <div class="px-2 py-3">
                   <?php if (get_theme_mod('nsc_blog_latest_articles_category', true) !='0') {
                    $categories = get_the_category();
                   if ( ! empty( $categories ) ) { ?>
                     <a class="nsc-post-cat" href="<?php echo esc_attr( esc_url( get_category_link( $categories[0]->term_id ) ) ); ?>" title="<?php echo esc_attr( $categories[0]->name );  ?>">
                       <?php echo esc_html( $categories[0]->name );  ?>
                     </a>
                   <?php } } ?>

                   <?php if (get_theme_mod('nsc_blog_latest_articles_title', true) !='0') { ?>
                     <h3 class="nsc-post-title mt-3">
                       <a href="<?php echo get_the_permalink(); ?>" title="<?php echo esc_attr( $categories[0]->name );  ?>">
                         <?php echo get_the_title(); ?>
                       </a>
                     </h3>
                   <?php } ?>

                   <div class="d-flex align-items-center gap-2 nsc-post-meta ">
                     <?php
                     $avatar_html = get_avatar(get_the_author_meta('ID'));
                     $avatar_url = '';

                     if (!empty($avatar_html)) {
                         $dom = new DOMDocument;
                         $dom->loadHTML($avatar_html);

                         $img_tags = $dom->getElementsByTagName('img');

                         if ($img_tags->length > 0) {
                             $avatar_url = $img_tags->item(0)->getAttribute('src');
                         }
                     }

                    if (get_theme_mod('nsc_blog_latest_articles_author_image', true) !='0') {
                       if (!empty($avatar_url)) : ?>
                           <img src="<?php echo esc_url($avatar_url); ?>" alt="<?php echo esc_attr(get_the_author()); ?>" title="<?php echo esc_attr(get_the_author()); ?>">
                       <?php else : ?>
                           <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/default-user.png'); ?>" alt="<?php echo esc_attr(get_the_author()); ?>"  title="<?php echo esc_attr(get_the_author()); ?>">
                       <?php endif;
                     } ?>

                     <div class="">
                       <?php if (get_theme_mod('nsc_blog_latest_articles_author_name', true) !='0') { ?>
                         <p class="nsc-author mb-0"><?php echo get_the_author(); ?></p>
                       <?php } ?>
                       <?php if (get_theme_mod('nsc_blog_latest_articles_post_date', true) !='0') { ?>
                         <p class="nsc-post-date mb-0"><?php echo get_the_date(); ?></p>
                       <?php } ?>
                     </div>
                 </div>
                 </div>
               </div>
             </div>
							<?php endwhile; wp_reset_postdata(); ?>
					</div>
					<div class="nsc-post-navigation">
						<?php
							$big = 999999999;
							echo paginate_links( array(
								'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
								'format' => 'paged=%#%',
								'current' =>  (get_query_var('paged') ? get_query_var('paged') : 1),
								'total' => $nsc_blog_query->max_num_pages
							) );
						?>
					</div>
			<?php else : ?>
				<h3><?php esc_html_e('No posts found','nsc-blog'); ?></h3>
			<?php endif; ?>
	</div>
</div>

<?php get_footer();
