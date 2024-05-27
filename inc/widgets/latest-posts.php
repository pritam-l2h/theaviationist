<?php
// Updated Widget Code
/**
 * Custom Latest Posts Widget with Title in H3
 */

class NSC_Latest_Posts_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'nsc_latest_posts_widget', // Widget ID
            __('NSC Latest Posts', 'nsc-blog'), // Widget name
            array('description' => __('Displays the latest posts with a "View All" button', 'nsc-blog')) // Description
        );
    }

    public function widget($args, $instance) {
        // Default settings
        $title = isset($instance['title']) ? $instance['title'] : __('Latest Posts', 'nsc-blog');
        $num_posts = isset($instance['num_posts']) ? (int) $instance['num_posts'] : 5;
        $view_all_link = isset($instance['view_all_link']) ? $instance['view_all_link'] : '';

        // Display the widget's outer structure
        echo $args['before_widget'];

        // If there's a title, display it as an H3 heading
        if (!empty($title)) {
            echo '<h3 class="section-main-head">' . esc_html($title) . '</h3>';
        }

        // Fetch and display the latest posts
        $latest_posts = new WP_Query(array(
            'posts_per_page' => $num_posts,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC'
        ));

        if ($latest_posts->have_posts()) {
            while ($latest_posts->have_posts()) {
                $latest_posts->the_post();

                $image_id = get_post_thumbnail_id();
                $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
                $image_title = get_the_title($image_id);

                ?>
                <div class="nsc-latest-post">
                    <?php if (has_post_thumbnail()) { ?>
                        <a href="<?php the_permalink(); ?>" class="nsc-latest-post-thumbnail" title="<?php echo esc_attr(($image_title) ? $image_title : get_the_title() ); ?>">
                          <img
                               src="<?php echo esc_url(get_the_post_thumbnail_url( get_the_ID(), 'full' )); ?>"
                               alt="<?php echo esc_attr(($image_alt) ? $image_alt : get_the_title() ); ?>"
                               title="<?php echo esc_attr(($image_title) ? $image_title : get_the_title() ); ?>">
                        </a>
                    <?php } ?>

                    <div class="nsc-latest-post-details">
                        <a href="<?php the_permalink(); ?>" class="nsc-latest-post-title" title="<?php echo esc_attr(get_the_title()); ?>">
                            <?php the_title(); ?>
                        </a>

                        <div class="nsc-latest-post-meta">
                            <span class="nsc-post-date"><?php echo get_the_date(); ?></span>
                            <span class=""><i class="fa fa-circle" aria-hidden="true"></i></span>
                            <span class="nsc-post-author"><?php the_author(); ?></span>
                        </div>
                    </div>
                </div>
                <?php
            }
            wp_reset_postdata();
        }

        // Add the "View All" button and popup HTML
        if (!empty($view_all_link)) {
            ?>
            <div class="nsc-view-all">
                <a href="javascript:void(0);" class="nsc-view-all-button" onclick="openCategoryPopup()">
                    <?php esc_html_e('View All Posts', 'nsc-blog'); ?>
                </a>
            </div>

            <div id="nsc-category-popup" class="nsc-popup">
                <div class="nsc-popup-content">
                    <span class="nsc-popup-close" onclick="closeCategoryPopup()">&times;</span>
                    <?php echo do_shortcode('[custom_search]'); ?>

                    <?php
                    $args = array(
                        'public'   => true,
                        '_builtin' => false // Exclude built-in post types
                    );
                    $post_types = get_post_types($args, 'objects');

                    // Include 'post' post type explicitly
                    $post_types['post'] = get_post_type_object('post');

                    foreach ($post_types as $post_type) {
                        $taxonomies = get_object_taxonomies($post_type->name, 'objects');

                        echo '<h3 class="section-main-head">' . esc_html($post_type->label) . '</h3>'; // Display post type title

                        foreach ($taxonomies as $taxonomy) {
                            if ($taxonomy->hierarchical) { // Only include hierarchical taxonomies
                                $categories = get_terms(array(
                                    'taxonomy'   => $taxonomy->name,
                                    'hide_empty' => false,
                                ));

                                echo '<ul>';

                                foreach ($categories as $category) {
                                    echo '<li><a href="' . esc_url(get_term_link($category->term_id)) . '">' . esc_html($category->name) . '</a></li>';
                                }

                                echo '</ul>';
                            }
                        }
                    }
                    ?>
                    <button class="view-more-categories-btn" onclick="toggleMoreCategories()">View More Categories</button>
                </div>
            </div>
            <?php
        }

        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = isset($instance['title']) ? $instance['title'] : __('Latest Posts', 'nsc-blog');
        $num_posts = isset($instance['num_posts']) ? (int) $instance['num_posts'] : 5;
        $view_all_link = isset($instance['view_all_link']) ? $instance['view_all_link'] : '';

        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <?php esc_html_e('Widget Title:', 'nsc-blog'); ?>
            </label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                   type="text"
                   value="<?php echo esc_attr($title); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('num_posts')); ?>">
                <?php esc_html_e('Number of posts to display:', 'nsc-blog'); ?>
            </label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('num_posts')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('num_posts')); ?>"
                   type="number"
                   min="1"
                   max="10"
                   value="<?php echo esc_attr($num_posts); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('view_all_link')); ?>">
                <?php esc_html_e('Link for "View All" button:', 'nsc-blog'); ?>
            </label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('view_all_link')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('view_all_link')); ?>"
                   type="text"
                   value="<?php echo esc_attr($view_all_link); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['num_posts'] = (int) $new_instance['num_posts'];
        $instance['view_all_link'] = esc_url_raw($new_instance['view_all_link']);
        return $instance;
    }
}

// Function to register the widget
function nsc_load_latest_posts_widget() {
    register_widget('NSC_Latest_Posts_Widget');
}

// Hook to register the widget with `widgets_init`
add_action('widgets_init', 'nsc_load_latest_posts_widget');

// Enqueue the necessary scripts for the popup functionality
function nsc_enqueue_scripts() {
    wp_enqueue_script('nsc-popup-script', get_template_directory_uri() . '/js/nsc-popup.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'nsc_enqueue_scripts');
?>
