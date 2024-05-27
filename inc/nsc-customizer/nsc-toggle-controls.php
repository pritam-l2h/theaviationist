<?php
/**
 * NSC Blog Custom Control
 *
 */

if ( class_exists( 'WP_Customize_Control' ) ) {
	class NSC_BLOG_TOGGLE_SWITCH_CUSTOM_CONTROL extends WP_Customize_Control {
		public $type = 'nsc_blog_toogle_switch';
		public function enqueue(){
			wp_enqueue_style( 'nsc_blog_custom_controls_css', trailingslashit( get_template_directory_uri() ) . 'inc/nsc-customizer/assets/nsc-customizer.css', array(), '1.0', 'all' );
		}
		public function render_content(){
		?>
			<div class="nsc-customizer-toggle">
				<input type="checkbox" id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?>>

				<label class="nsc-toggle-btn" for="<?php echo esc_attr( $this->id ); ?>">
					<span class="onoff"><?php echo esc_html('OFF'); ?></span>
					<span class="onoff"><?php echo esc_html('ON'); ?></span>
					<span class="nsc-circle"></span>
				</label>
				<span class="nsc-customizer-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="nsc-customizer-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
			</div>
		<?php
		}
	}
}

//separator
if ( class_exists( 'WP_Customize_Control' ) ) {
	class NSC_BLOG_SEPARATOR extends WP_Customize_Control {
		public function render_content(){
		?>
			<div class="nsc-blog-custom-separator">
				<?php echo esc_html( $this->label ); ?>
			</div>
		<?php
		}
	}
}
