<?php
function nsc_blog_add_custom_controls() {
	load_template( trailingslashit( get_template_directory() ) . '/inc/nsc-customizer/nsc-toggle-controls.php' );
}
add_action( 'customize_register', 'nsc_blog_add_custom_controls' );

function nsc_blog_customizer_register( $wp_customize ){
	//  site title and tagline
	$wp_customize->add_setting( 'nsc_blog_site_title',array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'nsc_blog_toggle_sanitization'
	));
	$wp_customize->add_control( new NSC_BLOG_TOGGLE_SWITCH_CUSTOM_CONTROL( $wp_customize, 'nsc_blog_site_title',array(
		'label' => esc_html__( 'Show / Hide Title','nsc-blog' ),
		'section' => 'title_tagline'
	)));

	$wp_customize->add_setting( 'nsc_blog_site_description',array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'nsc_blog_toggle_sanitization'
	));
	$wp_customize->add_control( new NSC_BLOG_TOGGLE_SWITCH_CUSTOM_CONTROL( $wp_customize, 'nsc_blog_site_description',array(
		'label' => esc_html__( 'Show / Hide Description','nsc-blog' ),
		'section' => 'title_tagline'
	)));

	$wp_customize->add_setting( 'nsc_blog_site_content_aside',array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'nsc_blog_toggle_sanitization'
	));
	$wp_customize->add_control( new NSC_BLOG_TOGGLE_SWITCH_CUSTOM_CONTROL( $wp_customize, 'nsc_blog_site_content_aside',array(
		'label' => esc_html__( 'Show Title Beside the Logo ','nsc-blog' ),
		'section' => 'title_tagline'
	)));


  //  menu list
  $menus = wp_get_nav_menus();
  $menu_list = array();

  if ($menus) {
      foreach ($menus as $menu) {
          $menu_list[$menu->name] = esc_html($menu->name);
      }
  } else {
      echo 'No menus found.';
  }

  $wp_customize->add_panel( 'nsc_blog_add_panel', array(
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => esc_html__( 'Aviationist Theme Settings', 'nsc-blog' ),
    'priority' => 10,
  ));


  // Topbar START
  $wp_customize->add_section('nsc_blog_topabr' , array(
    'title' => __( 'Topbar', 'nsc-blog' ),
    'panel' => 'nsc_blog_add_panel'
  ) );

	$wp_customize->add_setting('nsc_blog_topbar_menu',array(
		'default' => 'topbar',
		'transport' => 'refresh',
		'sanitize_callback' => 'nsc_blog_customizer_sanitize_choices'
	));
	$wp_customize->add_control('nsc_blog_topbar_menu',array(
		'type' => 'select',
		'label' => __('Select the Menu','nsc-blog'),
		'section' => 'nsc_blog_topabr',
		'choices' 	=> $menu_list,
	));

	$wp_customize->add_setting('nsc_blog_topbar_icon_number',array(
		'default'=> '4',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('nsc_blog_topbar_icon_number',array(
		'label'	=> esc_html__('Number of icons to show','nsc-blog'),
		'section'=> 'nsc_blog_topabr',
		'type'=> 'number'
	));

	$topbar_icons = get_theme_mod('nsc_blog_topbar_icon_number');
	for ($i=0; $i < $topbar_icons ; $i++) {
		$wp_customize->add_setting( 'nsc_blog_topbar_icon_separator'.$i,array(
			'default' => '',
			'transport' => 'refresh',
			'sanitize_callback' => 'nsc_blog_toggle_sanitization'
	  ));

	// 	$wp_customize->add_setting( sprintf( 'nsc_blog_topbar_icon_separator%s', $i ), array(
	//     'default' => '',
	//     'transport' => 'refresh',
	//     'sanitize_callback' => 'nsc_blog_toggle_sanitization',
	// ));

	  $wp_customize->add_control( new NSC_BLOG_SEPARATOR( $wp_customize, 'nsc_blog_topbar_icon_separator'.$i,array(
			'label' => esc_html__( 'Icon '.($i + 1),'nsc-blog' ),
			'section' => 'nsc_blog_topabr'
	  )));

		$wp_customize->add_setting('nsc_blog_topbar_icon'.$i,array(
			'default'=> '',
			// 'sanitize_callback'	=> 'sanitize_text_field'
		));
		$wp_customize->add_control('nsc_blog_topbar_icon'.$i,array(
			'label'	=> esc_html__('Icon Svg Code','nsc-blog'),
			'description' => __( 'Add the svg code', 'nsc-blog' ),
			'section'=> 'nsc_blog_topabr',
			'type'=> 'textarea'
		));

		$wp_customize->add_setting('nsc_blog_topbar_icon_url'.$i,array(
			'default'=> '',
			'sanitize_callback'	=> 'sanitize_text_field'
		));
		$wp_customize->add_control('nsc_blog_topbar_icon_url'.$i,array(
			'label'	=> esc_html__('Url','nsc-blog'),
			'section'=> 'nsc_blog_topabr',
			'type'=> 'text'
		));

		$wp_customize->add_setting('nsc_blog_topbar_icon_title'.$i,array(
			'default'=> '',
			'sanitize_callback'	=> 'sanitize_text_field'
		));
		$wp_customize->add_control('nsc_blog_topbar_icon_title'.$i,array(
			'label'	=> esc_html__('Title','nsc-blog'),
			'description' => __( 'Add the title for the SEO purpose', 'nsc-blog' ),
			'section'=> 'nsc_blog_topabr',
			'type'=> 'text'
		));

	}
  // Topbar END

	//  news scroller
	$wp_customize->add_section('nsc_blog_news_scroller' , array(
    'title' => __( 'News Scroll Bar', 'nsc-blog' ),
    'panel' => 'nsc_blog_add_panel'
  ) );

	$wp_customize->add_setting('nsc_blog_news_ribbon_heading',array(
		'default'=> 'News Tickers',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('nsc_blog_news_ribbon_heading',array(
		'label'	=> esc_html__('Text','nsc-blog'),
		'section'=> 'nsc_blog_news_scroller',
		'type'=> 'text'
	));

	$wp_customize->add_setting('nsc_blog_news_ribbon_post_num',array(
		'default'=> '5',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('nsc_blog_news_ribbon_post_num',array(
		'label'	=> esc_html__('Number of post','nsc-blog'),
		'section'=> 'nsc_blog_news_scroller',
		'type'=> 'number'
	));

	//  slider
	$wp_customize->add_section('nsc_blog_news_slider' , array(
    'title' => __( 'Slider', 'nsc-blog' ),
    'panel' => 'nsc_blog_add_panel'
  ) );

	$wp_customize->add_setting('nsc_blog_slider_post_num',array(
		'default'=> '4',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('nsc_blog_slider_post_num',array(
		'label'	=> esc_html__('Number Of Slider To Show','nsc-blog'),
		'section'=> 'nsc_blog_news_slider',
		'type'=> 'number'
	));

	// Categories section
	$wp_customize->add_section('nsc_blog_post_categories' , array(
		'title' => __( 'Category', 'nsc-blog' ),
		'panel' => 'nsc_blog_add_panel'
	) );

	$wp_customize->add_setting('nsc_blog_category_heading',array(
		'default'=> 'CATEGORIES',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('nsc_blog_category_heading',array(
		'label'	=> esc_html__('Category Heading','nsc-blog'),
		'section'=> 'nsc_blog_post_categories',
		'type'=> 'text'
	));

	$wp_customize->add_setting('nsc_blog_category_see_more',array(
		'default'=> 'See More',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('nsc_blog_category_see_more',array(
		'label'	=> esc_html__('See More','nsc-blog'),
		'section'=> 'nsc_blog_post_categories',
		'type'=> 'text'
	));

	// $wp_customize->add_setting('nsc_blog_category_see_more_url',array(
	// 	'default'=> '#',
	// 	'sanitize_callback'	=> 'sanitize_text_field'
	// ));
	// $wp_customize->add_control('nsc_blog_category_see_more_url',array(
	// 	'label'	=> esc_html__('See More Url','nsc-blog'),
	// 	'section'=> 'nsc_blog_post_categories',
	// 	'type'=> 'text'
	// ));

	$wp_customize->add_setting('nsc_blog_category_cat_num',array(
		'default'=> '10',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('nsc_blog_category_cat_num',array(
		'label'	=> esc_html__('Number of tabs to show','nsc-blog'),
		'section'=> 'nsc_blog_post_categories',
		'type'=> 'number'
	));

	$wp_customize->add_setting('nsc_blog_category_view_more',array(
		'default'=> 'View More',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('nsc_blog_category_view_more',array(
		'label'	=> esc_html__('Number of tabs to show','nsc-blog'),
		'section'=> 'nsc_blog_post_categories',
		'type'=> 'text'
	));

	// other artilces
	$wp_customize->add_section('nsc_blog_other_articles' , array(
		'title' => __( 'Other Articles', 'nsc-blog' ),
		'panel' => 'nsc_blog_add_panel'
	) );

	$wp_customize->add_setting('nsc_blog_other_articles_heading',array(
		'default'=> 'OTHER ARTICLES',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('nsc_blog_other_articles_heading',array(
		'label'	=> esc_html__('Other Articles','nsc-blog'),
		'section'=> 'nsc_blog_other_articles',
		'type'=> 'text'
	));

	// 	comment policy
	$wp_customize->add_section('nsc_blog_comment_policy' , array(
		'title' => __( 'Comment Policy', 'nsc-blog' ),
		'panel' => 'nsc_blog_add_panel'
	) );

	$wp_customize->add_setting('nsc_blog_comments_policy_bgimage',array(
	    'default'   => '',
	    'sanitize_callback' => 'esc_url_raw',
	  ));
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'nsc_blog_comments_policy_bgimage',array(
      'label' => __('Background Image ','nsc-blog'),
      'description' => __('Dimension (1600px * 700px)','nsc-blog'),
      'section' => 'nsc_blog_comment_policy',
      'settings' => 'nsc_blog_comments_policy_bgimage'
  )));

	$wp_customize->add_setting('nsc_blog_comment_policy_heading',array(
		'default'=> 'The Aviationist Comment Policy',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('nsc_blog_comment_policy_heading',array(
		'label'	=> esc_html__('Heading','nsc-blog'),
		'section'=> 'nsc_blog_comment_policy',
		'type'=> 'text'
	));

	$wp_customize->add_setting('nsc_blog_comment_policy_para',array(
		'default'=> 'Comments on this site are moderated. Comment policy applies. Please read our Comment Policy before commenting.',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('nsc_blog_comment_policy_para',array(
		'label'	=> esc_html__('Description','nsc-blog'),
		'section'=> 'nsc_blog_comment_policy',
		'type'=> 'textarea'
	));

	$wp_customize->add_setting('nsc_blog_comment_policy_btn',array(
		'default'=> 'Got It',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('nsc_blog_comment_policy_btn',array(
		'label'	=> esc_html__('Button','nsc-blog'),
		'section'=> 'nsc_blog_comment_policy',
		'type'=> 'text'
	));

	$wp_customize->add_setting('nsc_blog_comment_policy_btn_url',array(
		'default'=> '#',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('nsc_blog_comment_policy_btn_url',array(
		'label'	=> esc_html__('Button Url','nsc-blog'),
		'section'=> 'nsc_blog_comment_policy',
		'type'=> 'text'
	));

	//  also on aviationist
	$wp_customize->add_section('nsc_blog_also_on_aviationist' , array(
		'title' => __( 'Also on aviationist', 'nsc-blog' ),
		'panel' => 'nsc_blog_add_panel'
	) );
	$wp_customize->add_setting('nsc_blog_also_on_aviationist_heading',array(
		'default'=> 'ALSO ON THE AVIATIONIST',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('nsc_blog_also_on_aviationist_heading',array(
		'label'	=> esc_html__('Heading','nsc-blog'),
		'section'=> 'nsc_blog_also_on_aviationist',
		'type'=> 'text'
	));
	$wp_customize->add_setting('nsc_blog_also_on_aviationist_post_num',array(
		'default'=> '-1',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('nsc_blog_also_on_aviationist_post_num',array(
		'label'	=> esc_html__('Number of post to show','nsc-blog'),
		'section'=> 'nsc_blog_also_on_aviationist',
		'type'=> 'num'
	));
	$wp_customize->add_setting('nsc_blog_also_on_aviationist_view_all_post',array(
		'default'=> 'View All',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('nsc_blog_also_on_aviationist_view_all_post',array(
		'label'	=> esc_html__('Button Text','nsc-blog'),
		'section'=> 'nsc_blog_also_on_aviationist',
		'type'=> 'text'
	));
	$wp_customize->add_setting('nsc_blog_also_on_aviationist_view_all_post_url',array(
		'default'=> '#',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('nsc_blog_also_on_aviationist_view_all_post_url',array(
		'label'	=> esc_html__('Button Url','nsc-blog'),
		'section'=> 'nsc_blog_also_on_aviationist',
		'type'=> 'text'
	));




	//  contact us page
	$wp_customize->add_section('nsc_blog_contact_us_page' , array(
		'title' => __( 'Contact Us Page', 'nsc-blog' ),
		'panel' => 'nsc_blog_add_panel'
	) );
	$wp_customize->add_setting('nsc_blog_contact_us_description',array(
		'default'=> 'If you want to tell me something or if you need to prepare books, articles, brochures, datasheets, documentaries, presentations, meetings, movies and so on, and need the world’s most authoritative aviation journalist and blogger, you can send me an email.',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('nsc_blog_contact_us_description',array(
		'label'	=> esc_html__('Page Description','nsc-blog'),
		'section'=> 'nsc_blog_contact_us_page',
		'type'=> 'textarea'
	));

	$wp_customize->add_setting('nsc_blog_contact_us_page_title',array(
		'default'=> 'Get in touch',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('nsc_blog_contact_us_page_title',array(
		'label'	=> esc_html__('Heading','nsc-blog'),
		'section'=> 'nsc_blog_contact_us_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('nsc_blog_contact_us_title_desc',array(
		'default'=> 'Reach out, and let\'s create a universe of possibilities together!',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('nsc_blog_contact_us_title_desc',array(
		'label'	=> esc_html__('Heading Description','nsc-blog'),
		'section'=> 'nsc_blog_contact_us_page',
		'type'=> 'textarea'
	));

	$wp_customize->add_setting('nsc_blog_contact_us_form_title',array(
		'default'=> 'Let’s connect constellations',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('nsc_blog_contact_us_form_title',array(
		'label'	=> esc_html__('Form Heading','nsc-blog'),
		'section'=> 'nsc_blog_contact_us_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('nsc_blog_contact_us_form_description',array(
		'default'=> 'Let\'s align our constellations! Reach out and let the magic of collaboration illuminate our skies.',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('nsc_blog_contact_us_form_description',array(
		'label'	=> esc_html__('Form Description','nsc-blog'),
		'section'=> 'nsc_blog_contact_us_page',
		'type'=> 'textarea'
	));

	$wp_customize->add_setting('nsc_blog_contact_us_form_shortcode',array(
		'default'=> '[wpforms id="60"]',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('nsc_blog_contact_us_form_shortcode',array(
		'label'	=> esc_html__('Form Shortcode','nsc-blog'),
		'section'=> 'nsc_blog_contact_us_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('nsc_blog_contact_us_image',array(
			'default'   => '',
			'sanitize_callback' => 'esc_url_raw',
		));
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'nsc_blog_contact_us_image',array(
			'label' => __('Image ','nsc-blog'),
			'section' => 'nsc_blog_contact_us_page',
			'settings' => 'nsc_blog_contact_us_image'
	)));

	$wp_customize->add_setting('nsc_blog_contact_us_below_description',array(
		'default'=> 'If you were looking for one of world’s most read military aviation blogger, you have just found him. My bio can be read in the About page.',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('nsc_blog_contact_us_below_description',array(
		'label'	=> esc_html__('Text Below Form','nsc-blog'),
		'section'=> 'nsc_blog_contact_us_page',
		'type'=> 'text'
	));
	$wp_customize->add_setting('nsc_blog_contact_us_about_page_link',array(
		'default'=> '#',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('nsc_blog_contact_us_about_page_link',array(
		'label'	=> esc_html__('About page link','nsc-blog'),
		'section'=> 'nsc_blog_contact_us_page',
		'type'=> 'text'
	));
	$wp_customize->add_setting('nsc_blog_contact_us_about_page_text',array(
		'default'=> 'About page',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('nsc_blog_contact_us_about_page_text',array(
		'label'	=> esc_html__('About us page text','nsc-blog'),
		'section'=> 'nsc_blog_contact_us_page',
		'type'=> 'text'
	));
}
add_action( 'customize_register', 'nsc_blog_customizer_register' );
