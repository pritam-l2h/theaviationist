<?php

/*

*/

class Recent_Post_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'recent_post_widget',
            __('Recent Posts Widget', 'nsc-blog'),
            array( 'description' => __( 'Widget to display recent posts with featured images', 'nsc-blog' ), )
        );
    }

    public function widget( $args, $instance ) {
        // Widget output
        $title = apply_filters( 'widget_title', $instance['title'] );
        $number_of_posts = ! empty( $instance['number_of_posts'] ) ? $instance['number_of_posts'] : 5;
        $show_date = ! empty( $instance['show_date'] ) ? true : false;

        echo $args['before_widget'];
        if ( ! empty( $title ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        $recent_posts = wp_get_recent_posts( array(
            'numberposts' => $number_of_posts,
            'post_status' => 'publish'
        ) );

        foreach( $recent_posts as $post ) {
            setup_postdata( $post );
            ?>
            <div class="recent-post">
                <div class="featured-image">
                    <?php if ( has_post_thumbnail( $post['ID'] ) ) {
                        echo get_the_post_thumbnail( $post['ID'], 'thumbnail' );
                    } ?>
                </div>
                <div class="post-content">
                    <h4><a href="<?php echo get_permalink( $post['ID'] ); ?>"><?php echo $post['post_title']; ?></a></h4>
                    <div class="author-date">
                    <?php if ( $show_date ) { ?>
                        <p class="post-meta-author post-meta"> <span> <i class="fa fa-user-circle" aria-hidden="true"></i> </span> <?php echo get_the_author_meta( 'display_name', $post['post_author'] ); ?></p>
                        <p class="post-meta-date post-meta"> <span> <i class="fa fa-calendar" aria-hidden="true"></i> </span> <?php echo get_the_date( '', $post['ID'] ); ?></p>
                    <?php } ?>
                    </div>
                </div>
            </div>
            <?php
        }
        echo $args['after_widget'];
    }

    public function form( $instance ) {
        // Widget form fields
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Recent Posts', 'nsc-blog' );
        $number_of_posts = ! empty( $instance['number_of_posts'] ) ? $instance['number_of_posts'] : 5;
        $show_date = ! empty( $instance['show_date'] ) ? 'checked' : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'nsc-blog' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'number_of_posts' ); ?>"><?php _e( 'Number of posts to show:', 'nsc-blog' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'number_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'number_of_posts' ); ?>" type="number" value="<?php echo esc_attr( $number_of_posts ); ?>">
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php echo $show_date; ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
            <label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?', 'nsc-blog' ); ?></label>
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        // Save widget options
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['number_of_posts'] = ( ! empty( $new_instance['number_of_posts'] ) ) ? absint( $new_instance['number_of_posts'] ) : 5;
        $instance['show_date'] = isset( $new_instance['show_date'] ) ? true : false;
        return $instance;
    }
}

// Register the widget
function register_recent_post_widget() {
    register_widget( 'Recent_Post_Widget' );
}
add_action( 'widgets_init', 'register_recent_post_widget' );

