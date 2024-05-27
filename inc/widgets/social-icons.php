<?php
/**
 * Custom Social Widget
 */

class NSC_Blog_Social_Icons extends WP_Widget {

	function __construct() {
		parent::__construct(
			'NSC_Blog_Social_Icons',
			__('NSC Social Icon', 'nsc-blog'),
			array( 'description' => __( 'Widget for Social icons section', 'nsc-blog' ), )
		);
	}

	public function widget( $nsc_blog_args, $nsc_blog_instance ) { ?>
		<div class="widget12">
			<?php
			$nsc_blog_title = isset( $nsc_blog_instance['title'] ) ? $nsc_blog_instance['title'] : '';
			$nsc_blog_facebook = isset( $nsc_blog_instance['facebook'] ) ? $nsc_blog_instance['facebook'] : '';
			$nsc_blog_instagram = isset( $nsc_blog_instance['instagram'] ) ? $nsc_blog_instance['instagram'] : '';
			$nsc_blog_twitter = isset( $nsc_blog_instance['twitter'] ) ? $nsc_blog_instance['twitter'] : '';
			$nsc_blog_linkedin = isset( $nsc_blog_instance['linkedin'] ) ? $nsc_blog_instance['linkedin'] : '';
			$nsc_blog_pinterest = isset( $nsc_blog_instance['pinterest'] ) ? $nsc_blog_instance['pinterest'] : '';
			$nsc_blog_tumblr = isset( $nsc_blog_instance['tumblr'] ) ? $nsc_blog_instance['tumblr'] : '';
			$nsc_blog_youtube = isset( $nsc_blog_instance['youtube'] ) ? $nsc_blog_instance['youtube'] : '';

			echo '<div class="nsc-custom-social-icons">';
			if(!empty($nsc_blog_title) ){ ?><h3 class="section-main-head"><?php echo esc_html($nsc_blog_title); ?></h3><?php }
					if(!empty($nsc_blog_facebook) ){ ?>
						<a class="custom_facebook" href="<?php echo esc_url($nsc_blog_facebook); ?>" title="<?php echo esc_attr( 'Facebook','nsc-blog' );?>">
							<i class="fa-brands fa-facebook-f"></i>
						</a>
					<?php }
					if(!empty($nsc_blog_twitter) ){ ?>
						<a class="custom_twitter" href="<?php echo esc_url($nsc_blog_twitter); ?>" title="<?php echo esc_attr( 'Twitter','nsc-blog' );?>">
							<i class="fab fa-twitter"></i>
						</a>
					<?php }
	        if(!empty($nsc_blog_linkedin) ){ ?>
						<a class="custom_linkedin" href="<?php echo esc_url($nsc_blog_linkedin); ?>" title="<?php echo esc_attr( 'Linkedin','nsc-blog' );?>">
							<i class="fab fa-linkedin-in"></i>
						</a>
					<?php }
	        if(!empty($nsc_blog_pinterest) ){ ?>
						<a class="custom_pinterest" href="<?php echo esc_url($nsc_blog_pinterest); ?>" title="<?php echo esc_attr( 'Pinterest','nsc-blog' );?>">
							<i class="fab fa-pinterest-p"></i>
						</a>
					<?php }
	        if(!empty($nsc_blog_tumblr) ){ ?>
						<a class="custom_tumblr" href="<?php echo esc_url($nsc_blog_tumblr); ?>"  title="<?php echo esc_attr( 'Tumblr','nsc-blog' );?>">
							<i class="fab fa-tumblr"></i>
						</a>
					<?php }
	        if(!empty($nsc_blog_instagram) ){ ?>
						<a class="custom_instagram" href="<?php echo esc_url($nsc_blog_instagram); ?>" title="<?php echo esc_attr( 'Instagram','nsc-blog' );?>">
							<i class="fab fa-instagram"></i>
						</a>
					<?php }
	        if(!empty($nsc_blog_youtube) ){ ?>
						<a class="custom_youtube" href="<?php echo esc_url($nsc_blog_youtube); ?>" title="<?php echo esc_attr( 'Youtube','nsc-blog' );?>">
							<i class="fab fa-youtube"></i>
						</a>
					<?php }
	        echo '</div>';
			?>
		</div>
		<?php
	}

	// Widget Backend
	public function form( $nsc_blog_instance ) {

		$nsc_blog_title= ''; $nsc_blog_facebook = ''; $nsc_blog_twitter = ''; $nsc_blog_linkedin = '';  $nsc_blog_pinterest = '';$nsc_blog_tumblr = ''; $nsc_blog_instagram = ''; $nsc_blog_youtube = '';
		$nsc_blog_title = isset( $nsc_blog_instance['title'] ) ? $nsc_blog_instance['title'] : '';
		$nsc_blog_facebook = isset( $nsc_blog_instance['facebook'] ) ? $nsc_blog_instance['facebook'] : '';
		$nsc_blog_instagram = isset( $nsc_blog_instance['instagram'] ) ? $nsc_blog_instance['instagram'] : '';
		$nsc_blog_twitter = isset( $nsc_blog_instance['twitter'] ) ? $nsc_blog_instance['twitter'] : '';
		$nsc_blog_linkedin = isset( $nsc_blog_instance['linkedin'] ) ? $nsc_blog_instance['linkedin'] : '';
		$nsc_blog_pinterest = isset( $nsc_blog_instance['pinterest'] ) ? $nsc_blog_instance['pinterest'] : '';
		$nsc_blog_tumblr = isset( $nsc_blog_instance['tumblr'] ) ? $nsc_blog_instance['tumblr'] : '';
		$nsc_blog_youtube = isset( $nsc_blog_instance['youtube'] ) ? $nsc_blog_instance['youtube'] : '';
		?>
		<p>
        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
					<?php esc_html_e('Title:','nsc-blog'); ?>
				</label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($nsc_blog_title); ?>">
    	</p>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id('facebook')); ?>">
			<?php esc_html_e('Facebook:','nsc-blog'); ?>
		</label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('facebook')); ?>" name="<?php echo esc_attr($this->get_field_name('facebook')); ?>" type="text" value="<?php echo esc_attr($nsc_blog_facebook); ?>">
		</p>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id('twitter')); ?>">
			<?php esc_html_e('Twitter:','nsc-blog'); ?>
		</label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('twitter')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter')); ?>" type="text" value="<?php echo esc_attr($nsc_blog_twitter); ?>">
		</p>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id('linkedin')); ?>">
			<?php esc_html_e('Linkedin:','nsc-blog'); ?>
		</label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('linkedin')); ?>" name="<?php echo esc_attr($this->get_field_name('linkedin')); ?>" type="text" value="<?php echo esc_attr($nsc_blog_linkedin); ?>">
		</p>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id('instagram')); ?>">
			<?php esc_html_e('Instagram:','nsc-blog'); ?>
		</label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('instagram')); ?>" name="<?php echo esc_attr($this->get_field_name('instagram')); ?>" type="text" value="<?php echo esc_attr($nsc_blog_instagram); ?>">
		</p>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id('pinterest')); ?>">
			<?php esc_html_e('Pinterest:','nsc-blog'); ?>
		</label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('pinterest')); ?>" name="<?php echo esc_attr($this->get_field_name('pinterest')); ?>" type="text" value="<?php echo esc_attr($nsc_blog_pinterest); ?>">
		</p>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id('tumblr')); ?>">
			<?php esc_html_e('Tumblr:','nsc-blog'); ?>
		</label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('tumblr')); ?>" name="<?php echo esc_attr($this->get_field_name('tumblr')); ?>" type="text" value="<?php echo esc_attr($nsc_blog_tumblr); ?>">
		</p>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id('youtube')); ?>"><?php esc_html_e('Youtube:','nsc-blog'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('youtube')); ?>" name="<?php echo esc_attr($this->get_field_name('youtube')); ?>" type="text" value="<?php echo esc_attr($nsc_blog_youtube); ?>">
		</p>
		<?php
	}

	public function update( $nsc_blog_new_instance, $nsc_blog_old_instance ) {
		$nsc_blog_instance = array();
		$nsc_blog_instance['title'] = (!empty($nsc_blog_new_instance['title']) ) ? strip_tags($nsc_blog_new_instance['title']) : '';
        $nsc_blog_instance['facebook'] = (!empty($nsc_blog_new_instance['facebook']) ) ? esc_url_raw($nsc_blog_new_instance['facebook']) : '';
        $nsc_blog_instance['twitter'] = (!empty($nsc_blog_new_instance['twitter']) ) ? esc_url_raw($nsc_blog_new_instance['twitter']) : '';
        $nsc_blog_instance['instagram'] = (!empty($nsc_blog_new_instance['instagram']) ) ? esc_url_raw($nsc_blog_new_instance['instagram']) : '';
        $nsc_blog_instance['linkedin'] = (!empty($nsc_blog_new_instance['linkedin']) ) ? esc_url_raw($nsc_blog_new_instance['linkedin']) : '';
        $nsc_blog_instance['pinterest'] = (!empty($nsc_blog_new_instance['pinterest']) ) ? esc_url_raw($nsc_blog_new_instance['pinterest']) : '';
        $nsc_blog_instance['tumblr'] = (!empty($nsc_blog_new_instance['tumblr']) ) ? esc_url_raw($nsc_blog_new_instance['tumblr']) : '';
     	$nsc_blog_instance['youtube'] = (!empty($nsc_blog_new_instance['youtube']) ) ? esc_url_raw($nsc_blog_new_instance['youtube']) : '';

		return $nsc_blog_instance;
	}
}

function nsc_blog_custom_load_widget() {
	register_widget( 'NSC_Blog_Social_Icons' );
}
add_action( 'widgets_init', 'nsc_blog_custom_load_widget' );
