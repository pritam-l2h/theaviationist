<?php
class NSC_Blog_Popular_Posts extends WP_Widget {
	public function __construct() {
    parent::__construct(
			'nsc-blog-popular-posts',
			'NSC Popular Posts'
		);
		add_action( 'widgets_init', function() {
			register_widget( 'NSC_Blog_Popular_Posts' );
		});
	}

  public $args = array(
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
		'before_widget' => '<div class="widget-wrap">',
		'after_widget'  => '</div></div>',
	);

	public function widget( $args, $instance ) {
    echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			
			$before_title = $args['before_title'];
			$title = apply_filters( 'widget_title', $instance['title'] );
			$view_all_cat_url = esc_attr( $instance['view_all_cat_url'] );
			$view_all_cat_text = esc_html( $instance['view_all_cat_text'] );
			$after_title = $args['after_title'];

			printf(
		    __('%1$s %2$s <a href="%3$s" title="%4$s">%4$s </a> %5$s', 'nsc-blog' ),
				$before_title,
		    $title,
				$view_all_cat_url,
				$view_all_cat_text,
				$after_title
			);
		}

		$posts_per_page  = ! empty( $instance['posts_per_page'] ) ? $instance['posts_per_page'] : esc_html__( '5', 'nsc-blog' );


   // the query
   $the_query = new WP_Query( array(
		  'post_type'        => 'post',
      'posts_per_page' => $posts_per_page
   ));

	 if ( $the_query->have_posts() ) :
	   while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		 	<div class="popular-posts-item">
				<div class="">
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
					} ?>

					<div class="popular-post-meta">
						<?php
						if (!empty($avatar_url)) : ?>
								<img class="author-image" src="<?php echo esc_url($avatar_url); ?>" alt="<?php echo esc_attr(get_the_author()); ?>" title="<?php echo esc_attr(get_the_author()); ?>">
						<?php else : ?>
								<img class="author-image" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/default-user.png'); ?>" alt="<?php echo esc_attr(get_the_author()); ?>"  title="<?php echo esc_attr(get_the_author()); ?>">
						<?php endif; ?>

						<div class="">
							<span class="post-author "><?php echo esc_html(get_the_author()); ?></span>
								<span class="post-date"><?php echo esc_html(get_the_date()); ?></span>
						</div>
					</div>


					<h3 class="post-title"><a href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title();  ?>"><?php echo get_the_title(); ?></a></h3>
				</div>
				<?php
	        $image_id = get_post_thumbnail_id();
	        $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
	        $image_title = get_the_title($image_id);
         ?>
				<img class="post-img" src="<?php echo esc_url(get_the_post_thumbnail_url( get_the_ID(), 'full' )); ?>" alt="<?php echo esc_attr(($image_alt) ? $image_alt : get_the_title() ); ?>" title="<?php echo esc_attr(($image_title) ? $image_title : get_the_title() ); ?>">
		 	</div>

		 <?php
	   endwhile;
	   wp_reset_postdata();
	 endif;

	}

	public function form( $instance ) {
    $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'nsc-blog' );

		$view_all_cat_text  = ! empty( $instance['view_all_cat_text'] ) ? $instance['view_all_cat_text'] : esc_html__( '', 'nsc-blog' );
		$view_all_cat_url  = ! empty( $instance['view_all_cat_url'] ) ? $instance['view_all_cat_url'] : esc_html__( '', 'nsc-blog' );
		$posts_per_page  = ! empty( $instance['posts_per_page'] ) ? $instance['posts_per_page'] : esc_html__( '', 'nsc-blog' );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'nsc-blog' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'View All Button' ) ); ?>"><?php echo esc_html__( 'View All Button:', 'nsc-blog' ); ?></label>
			<input class="" id="<?php echo esc_attr( $this->get_field_id( 'view_all_cat_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'view_all_cat_text' ) ); ?>" value="<?php echo esc_attr( $view_all_cat_text ); ?>" type="text">
			<input class="" id="<?php echo esc_attr( $this->get_field_id( 'view_all_cat_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'view_all_cat_url' ) ); ?>" value="<?php echo esc_attr( $view_all_cat_url ); ?>" type="text">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'Number of posts to show:' ) ); ?>"><?php echo esc_html__( 'Number of posts to show:', 'nsc-blog' ); ?></label>
      <input class="" id="<?php echo esc_attr( $this->get_field_id( 'posts_per_page' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'posts_per_page' ) ); ?>" value="<?php echo esc_attr( $posts_per_page ); ?>" type="number">
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
    $instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['view_all_cat_text']  = ( ! empty( $new_instance['view_all_cat_text'] ) ) ? $new_instance['view_all_cat_text'] : '';
		$instance['view_all_cat_url']  = ( ! empty( $new_instance['view_all_cat_url'] ) ) ? $new_instance['view_all_cat_url'] : '';
    $instance['posts_per_page']  = ( ! empty( $new_instance['posts_per_page'] ) ) ? $new_instance['posts_per_page'] : '';
		return $instance;
	}
}
$my_widget = new NSC_Blog_Popular_Posts();
