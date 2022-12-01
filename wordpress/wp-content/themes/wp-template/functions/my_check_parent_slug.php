<?php
/**
 * 親ページのスラッグ取得
 * if (is_page('親ページのスラッグ') || is_parent_slug() === '親ページのスラッグ')
 * if (function_exists('wp_xxx')) { wp_xxx(); }
 */

function my_check_parent_slug() {
  global $post;
  if ($post->post_parent) {
    $post_data = get_post($post->post_parent);
    return $post_data->post_name;
  }
}
