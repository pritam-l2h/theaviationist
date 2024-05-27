<?php
/**
 * The template for displaying all posts of the custom post type 'videos_interviews'
 *
 * @package nsc-blog
 */
?>

<style>
.video-wrapper h4 {
    font-family: Work Sans;
    font-size: 16px;
    font-weight: 600;
    line-height: 24px;
    text-align: left;
}
.videos-container ul.top-videos,.videos-container ul.tvinterviews {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}
.videos-container ul.top-videos li,.videos-container ul.tvinterviews li {
    width: calc(100% / 3 - 20px);
}
p.video-desc {
    font-size: 15.5px;
    font-family: WorkSans;
}
</style>

<div id="primary" class="content-area col-md-12 col-12">
    <main id="main" class="site-main" role="main">

        <section class="top-videos">
            <h3 class="section-main-head">Top Videos</h3>
            <div class="videos-container">
                <ul class="top-videos">
                  <?php
                  $args_top_videos = array(
                      'post_type' => 'videos_interviews',
                      'posts_per_page' => -1,
                      'tax_query' => array(
                          array(
                              'taxonomy' => 'videos_interviews_category',
                              'field' => 'slug',
                              'terms' => 'top-videos'
                          )
                      )
                  );
                  $query_top_videos = new WP_Query($args_top_videos);

                  if ($query_top_videos->have_posts()) :
                      $counter = 0;
                      while ($query_top_videos->have_posts()) : $query_top_videos->the_post();
                          $video_url = get_post_meta(get_the_ID(), '_video_url', true);
                          $video_details = nsc_blog_get_video_details($video_url);
                          ?>

                          <li>
                            <div class="video-wrapper">
                                <iframe width="440" height="300" src="<?php echo esc_url($video_url); ?>?controls=0&amp;showinfo=0&amp;rel=0&amp;modestbranding=1" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
                                <?php if ($video_details) : ?>
                                    <h4><?php echo esc_html($video_details['title']); ?></h4>
                                    <?php if (!empty($video_details['duration'])): ?>
                                        <p>Duration: <?php echo esc_html($video_details['duration']); ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                          </li>

                          <?php
                          $counter++;
                          // Break after every 3 videos
                          if ($counter % 3 == 0) {
                              echo '<div style="clear:both;"></div>'; // Clear float
                          }
                      endwhile;
                      wp_reset_postdata();
                  else :
                      echo '<p>' . __('No videos found.', 'nsc-blog') . '</p>';
                  endif;
                  ?>
                </ul>
            </div><!-- .videos-container -->
        </section><!-- .top-videos -->

        <section class="tv-interviews">
            <h4 class="section-main-head">TV Interviews</h4>
            <div class="videos-container">
                <ul class="tvinterviews">
                  <?php
                  $args_tv_interviews = array(
                      'post_type' => 'videos_interviews',
                      'posts_per_page' => -1,
                      'tax_query' => array(
                          array(
                              'taxonomy' => 'videos_interviews_category',
                              'field' => 'slug',
                              'terms' => 'tv-interviews'
                          )
                      )
                  );
                  $query_tv_interviews = new WP_Query($args_tv_interviews);

                  if ($query_tv_interviews->have_posts()) :
                      $counter = 0;
                      while ($query_tv_interviews->have_posts()) : $query_tv_interviews->the_post();
                          $video_url = get_post_meta(get_the_ID(), '_video_url', true);
                          $video_details = nsc_blog_get_video_details($video_url);
                          ?>

                          <li>
                            <div class="video-wrapper">

                                <?php if ($video_details) :
                                  $image_id = get_post_thumbnail_id();
                                  $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
                                  $image_title = get_the_title($image_id); ?>



                                  <iframe width="300" height="169" src="<?php echo esc_url($video_url); ?>?controls=0&amp;showinfo=0&amp;rel=0&amp;modestbranding=1" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>

                                    <h4><?php echo esc_html($video_details['title']); ?></h4>
                                    <?php if (!empty($video_details['duration'])): ?>
                                        <p>Duration: <?php echo esc_html($video_details['duration']); ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                          </li>

                          <?php
                          $counter++;
                          // Break after every 3 videos
                          if ($counter % 3 == 0) {
                              echo '<div style="clear:both;"></div>'; // Clear float
                          }
                      endwhile;
                      wp_reset_postdata();
                  else :
                      echo '<p>' . __('No videos found.', 'nsc-blog') . '</p>';
                  endif;
                  ?>
                </ul>
            </div><!-- .videos-container -->
        </section><!-- .tv-interviews -->

        <p class="video-desc">
          If there are any questions you may contact DC Media Srls, via Fiume delle Perle 188, 00144, Rome, VAT IT12871451006, phone number +39 342 802 0729 or sending an email at the address below: dcmediasrls@pec.it
        </p>
    </main><!-- #main -->
</div><!-- #primary -->

<?php

function nsc_blog_get_video_details($video_url) {
    if (strpos($video_url, 'youtube.com') !== false || strpos($video_url, 'youtu.be') !== false) {
        return nsc_blog_get_youtube_video_details($video_url);
    } elseif (strpos($video_url, 'vimeo.com') !== false) {
        return nsc_blog_get_vimeo_video_details($video_url);
    }
    return false;
}

function nsc_blog_get_youtube_video_details($video_url) {
    preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $video_url, $matches);
    if (empty($matches[1])) {
        return false;
    }
    $video_id = $matches[1];
    $api_url = "https://www.youtube.com/oembed?url=https://www.youtube.com/watch?v=$video_id&format=json";

    $response = wp_remote_get($api_url);
    if (is_wp_error($response)) {
        return false;
    }

    $data = json_decode(wp_remote_retrieve_body($response), true);
    if (empty($data)) {
        return false;
    }

    $title = $data['title'];

    // Extract duration from the YouTube page using oEmbed (not always accurate)
    $duration = nsc_blog_extract_youtube_duration($video_url);

    return [
        'title' => $title,
        'duration' => $duration
    ];
}

function nsc_blog_extract_youtube_duration($video_url) {
    $response = wp_remote_get($video_url);
    if (is_wp_error($response)) {
        return false;
    }

    $body = wp_remote_retrieve_body($response);
    preg_match('/"approxDurationMs":"(\d+)"/', $body, $matches);
    if (empty($matches[1])) {
        return false;
    }

    $duration_ms = (int)$matches[1];
    $seconds = floor($duration_ms / 1000);
    $minutes = floor($seconds / 60);
    $seconds = $seconds % 60;
    $hours = floor($minutes / 60);
    $minutes = $minutes % 60;

    return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
}

function nsc_blog_get_vimeo_video_details($video_url) {
    preg_match('/vimeo\.com\/(\d+)/', $video_url, $matches);
    if (empty($matches[1])) {
        return false;
    }
    $video_id = $matches[1];
    $api_url = "https://vimeo.com/api/oembed.json?url=https://vimeo.com/$video_id";

    $response = wp_remote_get($api_url);
    if (is_wp_error($response)) {
        return false;
    }

    $data = json_decode(wp_remote_retrieve_body($response), true);
    if (empty($data)) {
        return false;
    }

    $title = $data['title'];
    $duration = gmdate("H:i:s", $data['duration']);

    return [
        'title' => $title,
        'duration' => $duration
    ];
}
?>
