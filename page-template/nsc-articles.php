<?php
/*
* Template Name: NSC Articles
*
* @package nsc-blog
*/


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header(); ?>

<style>
.search-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #f2f2f2;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 20px;
}
.search-container form {
    display: flex;
    align-items: center;
}
.search-container input[type="text"],
.search-container select {
    height: 40px;
    padding: 0 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-right: 10px;
}

.search-container button {
    height: 40px;
    padding: 0 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.search-container button:hover {
    background-color: #0056b3;
}
.page-template-nsc-articles .search-container {
    justify-content: center;
    background: transparent;
    margin: 40px 0;
}
.page-template-nsc-articles .search-container form#searchForm input#searchInput {
  min-width: 660px;
  width: 100% !important;
  padding: 4px 16px 4px 16px;
  border-radius: 6px;
  background: #F4F4F4;
}
.page-template-nsc-articles #nsc-recent-articles {
  margin: 0px !important;
}

.search-container {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background-color: #f2f2f2;
  padding: 10px;
  border-radius: 5px;
  margin-bottom: 20px;
}

.search-container form {
    display: flex;
    align-items: center;
}

.search-container input[type="text"],
.search-container select {
    height: 40px;
    padding: 0 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-right: 10px;
}

#search-results {
    margin-top: 20px;
}

.search-result {
    margin-bottom: 20px;
}
.search-result h3 {
    margin: 0 0 10px 0;
}
.search-result p {
    margin: 0;
}
.swrap {
    position: relative;
}
.swrap div#search-results {
    position: absolute;
    width: 100%;
    top: 40px;
    padding: 20px 0 20px 20px;
    background: #0000008a;
    border-radius: 8px;
}
.swrap div#search-results h3 a, .swrap div#search-results h3 {
    color: #fff;
    font-size: 16px;
    line-height: 20px;
}
.swrap div#search-results p {
    color: #fff;
		font-size: 14px;
}
.swrap #search-results .search-result {
    border-bottom: 1px solid #ffffffa6;
}
.page-template-nsc-articles .search-container .swrap {
    margin-right: 10px;
}
.page-template-nsc-articles aside.sidebar aside#nsc-blog-posts-cats-2 {
    display: none;
}
.page-template-nsc-articles aside.sidebar .widget12 {
    order: 3;
}
</style>

<?php echo do_shortcode('[custom_search]'); ?>
<div class="custom-container">
  <div class="nsc-post-page-grid">
    <div class="sections">
      <?php get_template_part('template-parts/articles/section-recent-articles'); ?>
    </div>

    <aside class="sidebar">
			<?php dynamic_sidebar('home-page');?>
    </aside>
  </div>
</div>
<?php get_footer(); ?>
