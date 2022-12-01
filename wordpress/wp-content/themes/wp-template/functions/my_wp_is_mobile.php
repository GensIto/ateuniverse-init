<?php
/**
 * wp_is_moblieでタブレットをpc扱いにする
 * @return int|bool
 */

function my_wp_is_mobile() {
  $useragents = array(
    'iPhone',// iPhone
    'iPod',// iPod touch
    'Android.*Mobile',// 1.5+ Android *** Only mobile
    'Windows.*Phone',// *** Windows Phone
    'dream',// Pre 1.5 Android
    'CUPCAKE',// 1.5+ Android
    'blackberry9500',// Storm
    'blackberry9530',// Storm
    'blackberry9520',// Storm v2
    'blackberry9550',// Storm v2
    'blackberry9800',// Torch
    'webOS',// Palm Pre Experimental
    'incognito',// Other iPhone browser
    'webmate'// Other iPhone browser
  );
  $pattern = '/'.implode('|', $useragents).'/i';
  return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}

/*
 * if (function_exists('my_wp_is_mobile')) {
 *  if (my_wp_is_mobile()) {
 *  }
 * }
*/