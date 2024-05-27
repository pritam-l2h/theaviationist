<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to nsc_blog_comment() which is
 * located in the inc/template-tags.php file.
 *
 * @package nsc-blog
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if ( have_comments() ) : ?>
        <h3 class="nsc-comment-title">
            <?php
            $nsc_blog_comments_number = get_comments_number();
            printf(
                esc_html__( 'Responses (%d)', 'nsc-blog' ),
                $nsc_blog_comments_number
            );
            ?>
        </h3>

        <?php the_comments_navigation(); ?>

        <ol class="comment-list">
        <?php
            $args = array(
                'callback' => 'nsc_blog_custom_comment_list',
            );
            wp_list_comments($args);
        ?>
        </ol>

        <?php the_comments_navigation(); ?>

    <?php endif; ?>

    <?php
        if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
        <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'nsc-blog' ); ?></p>
    <?php endif; ?>

    <?php
        comment_form( array(
            'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
            'title_reply_after'  => '</h2>',
            'title_reply' => esc_html(get_theme_mod('nsc_blog_single_blog_comment_title',__('','nsc-blog' )) ),
            'label_submit' => esc_html(get_theme_mod('nsc_blog_single_blog_comment_button_text',__('Submit','nsc-blog' )) ),
        ) );
    ?>
</div>
