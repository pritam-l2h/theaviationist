<?php
/*
* Template Name: NSC Special Report
*
*
* @package nsc-blog
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header(); ?>
  <main>
    <div class="custom-container">
			<?php get_template_part('template-parts/home/section-ribbon-news'); ?>
      <div class="row">
        <div class="col-md-8">
          <p class="special-reports-desc">
						In this page you can find the link to some special reports/stories posted on The Aviationist and magazines all around the world.
					</p>
          <?php
          $special_report_cats = get_terms( array(
            'taxonomy'   => 'special_report',
            'hide_empty' => false,
          ) );

          if ( ! empty( $special_report_cats ) && ! is_wp_error( $special_report_cats ) ) {
            foreach ( $special_report_cats as $category ) { ?>
							<div class="nsc-special_report-container">
            		<?php echo "<p class='special-report-cat'>" . $category->name . "</p>";
	              $args = array(
	                  'post_type' => 'special_report',
	                  'post_status' => 'publish',
	                  'posts_per_page' => -1,
	                  'tax_query' => array(
	                    array(
	                        'taxonomy' => 'special_report',
	                        'field'    => 'slug',
	                        'terms'    => $category->slug,
	                    ),
	                  ),
	                );
                 $query = new WP_Query($args);
                   if ( $query->have_posts() ) { ?>

                       <?php while ($query->have_posts()) : $query->the_post(); ?>
                       <div class="d-flex">
                         <div class="svg-wrap">
													 <svg class="me-2" width="27" height="24" viewBox="0 0 27 24" fill="none" xmlns="http://www.w3.org/2000/svg">
	                           <path d="M13.1111 0L0 20.4444L3.33333 24L6.22778 19.7833L8.66667 22.2222L11.4722 19.4167L13.1111 23.1111L14.75 19.4167L17.5556 22.2222L19.9944 19.7833L22.8889 24L26.2222 20.4444L13.1111 0ZM12.6111 2.61111V6.94444L10.4444 6.22222L12.6111 2.61111ZM13.6111 2.61111L15.7778 6.22222L13.6111 6.94444V2.61111Z" fill="url(#paint0_linear_652_9240)"/>
	                           <defs>
	                             <linearGradient id="paint0_linear_652_9240" x1="0" y1="12" x2="26.2222" y2="12" gradientUnits="userSpaceOnUse">
	                               <stop stop-color="#FFD11A"/>
	                               <stop offset="1" stop-color="#DE772E"/>
	                            </linearGradient>
	                           </defs>
	                         </svg>
												 </div>
                         <div class="ms-1">
                           <a href="#"><strong><?php echo get_the_title(); ?></strong></a>
                           <span> : <?php echo get_the_content(); ?></span>
                         </div>

                       </div>
										 	<?php endwhile; ?>

              <?php } ?>
							</div>
							<?php
            }
          } else {
            echo 'No custom categories found.';
          }
          ?>
        </div>
        <div class="col-md-4 special-sidebar">
					<aside class="nsc-home-sidebar">
						<?php dynamic_sidebar('home-page');?>
					</aside>
        </div>
      </div>
       	 <?php get_template_part('template-parts/home/section-comment-policy'); ?>
  	 <?php get_template_part('template-parts/home/section-aviationist-carousel'); ?>
    </div>
  </main>
<?php
get_footer();
