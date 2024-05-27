<?php
/**
 * The header for NSC Blog.
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package nsc-blog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?><!DOCTYPE html>
<?php do_action('nsc_blog_html'); ?>
<html <?php language_attributes(); ?>>
<head>
<?php do_action('nsc_blog_head_top'); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="description" content="<?php echo esc_attr(get_bloginfo( 'description' )) ?>">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<!--<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">-->

<!-- <meta http-equiv="refresh" content="2"> -->
<?php wp_head(); ?>
<?php do_action('nsc_blog_head_bottom'); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action('nsc_blog_body_top'); ?>
<?php wp_body_open(); ?>

<header class="nsc-header">
	<?php get_template_part('template-parts/header/topbar');
	get_template_part('template-parts/header/site-logo');
	get_template_part('template-parts/header/menu'); ?>
</header>
