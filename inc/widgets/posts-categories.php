<?php
class NSC_Blog_Post_Category extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'nsc-blog-posts-cats',
            'NSC Posts Category'
        );
    }

    public $args = array(
        'before_title'  => '<h3 class="section-main-head">',
        'after_title'   => '</h3>',
        'before_widget' => '<div class="widget-wrap">',
        'after_widget'  => '</div></div>',
    );

    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {

            $before_title = $args['before_title'];
            $title = apply_filters( 'widget_title', $instance['title'] );
            $after_title = $args['after_title'];

            printf(
                __('%1$s %2$s %3$s', 'nsc-blog' ),
                $before_title,
                $title,
                $after_title
            );
        }
        $cats_num  = ! empty( $instance['cats_num'] ) ? $instance['cats_num'] : esc_html__( '6', 'nsc-blog' );
        $cat_args = array(
            'orderby' => 'slug',
            'parent' => 0,
            'number' => $cats_num
        );
        echo '<ul class="nsc-posts-cats">';
        $categories = get_categories( $cat_args );
        foreach ($categories as $category) {
                echo '<li class="nsc-posts-cat-item">
                                <a href="' . esc_url(get_category_link($category->term_id)) . '" rel="bookmark" aria-label="'.esc_attr('Visit the ' . $category->name . ' category page').'" title="'. $category->name .'">' . esc_html($category->name) . '</a>
                        </li>';
            }
        echo "</ul>";

        if ( count($categories) >= $cats_num ) {
            // If there are more categories than the displayed number, show the "View All" button
            echo '<a href="#" class="view-all-category-btn" aria-label="Show More Categories">' . esc_html__('Show More', 'nsc-blog') . '</a>';
        }

        echo $args['after_widget'];
    }

    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'nsc-blog' );
        $cats_num  = ! empty( $instance['cats_num'] ) ? $instance['cats_num'] : esc_html__( '', 'nsc-blog' );
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'nsc-blog' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'cats_num' ) ); ?>"><?php echo esc_html__( 'Number of Categories to Display:', 'nsc-blog' ); ?></label>
            <input class="" id="<?php echo esc_attr( $this->get_field_id( 'cats_num' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'cats_num' ) ); ?>" value="<?php echo esc_attr( $cats_num ); ?>" type="number" style="width: 100%;">
        </p>

        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance          = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['cats_num']  = ( ! empty( $new_instance['cats_num'] ) ) ? $new_instance['cats_num'] : '';
        return $instance;
    }
}

// Register the widget outside of the class constructor
add_action( 'widgets_init', function() {
    register_widget( 'NSC_Blog_Post_Category' );
});
