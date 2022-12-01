<?php
/**
 * リダイレクト設定
 */

function my_redirect() {
  if (!is_user_logged_in()) {
    $currentUrl = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $tempUrl = home_url('/prepare/');
    if (preg_match('/lostpassword|logout|login|wp-admin|prepare/', $currentUrl)) {
      return;
    }
    wp_safe_redirect($tempUrl, 302);
    exit;
    // var_dump($tempUrl);
    // var_dump($currentUrl);
  }
}
add_filter('init', 'my_redirect');
