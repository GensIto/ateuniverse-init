<?php
/**
 * ショートコード追加
 */

// [get_uploadfolder_url]
function get_uploadfolder_url() {
  return esc_url(home_url('/wp-content/uploads/'));
}
add_shortcode('get_uploadfolder_url', 'get_uploadfolder_url');

// [get_homepage_url]
function get_homepage_url() {
  return esc_url(home_url());
}
add_shortcode('get_homepage_url', 'get_homepage_url');

// [get_templatefolder_url]
function get_templatefolder_url() {
  return get_template_directory_uri();
}
add_shortcode('get_templatefolder_url', 'get_templatefolder_url');

// get_template_partをショートコード化して投稿の編集画面から呼べるようにしたい
// https://migi.me/wordpress/get-template-part-short-code/
// [include_template arg1="templates/loop" arg2="result"]
function include_template($atts) {
  extract(shortcode_atts(
    array(
      'arg1' => '',
      'arg2' => '',
    ), $atts)
  );
  ob_start();
  get_template_part($arg1, $arg2);
  $html = ob_get_contents();
  ob_end_clean();
  return $html;
}
add_shortcode('include_template', 'include_template');
