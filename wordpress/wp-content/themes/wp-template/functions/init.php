<?php
/**
 * 初期設定
 */

// ====================================================================================================
// 任意に追加する読み込みcss/js
// ====================================================================================================
function add_files() {
  // ▼js wp標準のjq coreを除外
  // wp_deregister_script('jquery');

  // キャッシュ対策クエリパラメーター自動化
  // ----------------------------------------------------------------------------------------------------
  define("TEMPLATE_DIRE", get_template_directory_uri());
  define("TEMPLATE_PATH", get_template_directory());

  function wp_css ($css_name, $file_path) {
    wp_enqueue_style($css_name,TEMPLATE_DIRE.$file_path, array(), date('YmdGis', filemtime(TEMPLATE_PATH.$file_path)));
  }
  function wp_script ($script_name, $file_path, $bool = true) {
    wp_enqueue_script($script_name,TEMPLATE_DIRE.$file_path, array(), date('YmdGis', filemtime(TEMPLATE_PATH.$file_path)), $bool);
  }

  // css
  // ----------------------------------------------------------------------------------------------------
  // ▼google font
  // rel="preconnect"のlinkタグなども必要な場合はheaader.phpに記述
  // *任意に読み込ませるcssやjsはfunctions.phpで一括管理する方法が望ましい
  // wp_enqueue_style( 'font-google', 'https://fonts.googleapis.com/hoge', array(), '' );
  // ▼css main
  wp_css('css-main','/assets/css/style.css');

  // js
  // ----------------------------------------------------------------------------------------------------
  // ▼js viewport (header)
  wp_enqueue_script('viewport', get_template_directory_uri() . '/assets/js/viewport.bundle.js', '', '', false);
  // ▼js jq core (header)
  // 任意のjquery
  // wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/libs/jquery-3.3.1.min.js', '', '', false );
  // もしくはwp標準のjquery
  // wp_enqueue_script('jquery');
  // ▼js yubinbango (header)
  // if (is_page(array('contact'))) {
  //   wp_enqueue_script('js-yubinbango', get_template_directory_uri() . '/assets/js/yubinbango.js', '', '', false);
  // }
  // ▼js vendor (footer)
  wp_enqueue_script('js-vendor', get_template_directory_uri() . '/assets/js/vendor.bundle.js', '', '', true);
  // ▼js common (footer)
  wp_script('js-common','/assets/js/common.bundle.js');
  // ▼js insta (footer)
  // wp_enqueue_script('js-insta', get_template_directory_uri() . '/assets/js/insert_instagram_post.js', '', '', true);
}

// 出力するcssやjsの属性などを調整 gutenberg注意
// ----------------------------------------------------------------------------------------------------
add_filter('style_loader_tag', 'replace_link_stylesheet_tag');
function replace_link_stylesheet_tag($tag) {
  // ▼gutenbergでは管理画面以外にしないと投稿画面が真っ白になる
  if (!is_admin()) {
    return preg_replace( array( "/'/", '/(id|type|media)=".+?" */', '/ \/>/' ), array( '"', '', '>' ), $tag );
  }
  return $tag;
}
add_filter('script_loader_tag', 'replace_script_tag');
function replace_script_tag($tag) {
  // ▼gutenbergでは管理画面以外にしないと投稿画面が真っ白になる
  if (!is_admin()) {
    return preg_replace( array( "/'/", '/ type=\"text\/javascript\"/' ), array( '"', '' ), $tag );
  }
  return $tag;
}

// 通常のcss、jsを追加
// ----------------------------------------------------------------------------------------------------
add_action('wp_enqueue_scripts', 'add_files');


// ====================================================================================================
// google計測
// ====================================================================================================
// head内
function add_gtm_head() {
  echo <<<GTMH
    <!-- Google Tag Manager -->
    <!-- End Google Tag Manager -->
GTMH;
}
// add_action('wp_head', 'add_gtm_head', 0);

// body内
function add_gtm_body() {
  echo <<<GTMB
    <!-- Google Tag Manager (noscript) -->
    <!-- End Google Tag Manager (noscript) -->
GTMB;
}
// add_action('wp_body_open', 'add_gtm_body', 0);


// ====================================================================================================
// デフォルト読み込みcss/jsの調整
// ====================================================================================================
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');

// 自動挿入されるDNSプリフェッチ用コードを削除する ▼など
// <link rel='dns-prefetch' href='//ajax.googleapis.com' />
// <link rel='dns-prefetch' href='//s0.wp.com' />
// <link rel='dns-prefetch' href='//s.w.org' />
add_filter('wp_resource_hints', 'remove_dns_prefetch', 10, 2);
function remove_dns_prefetch($hints, $relation_type) {
  if ('dns-prefetch' === $relation_type) {
    return array_diff(wp_dependencies_unique_hosts(), $hints);
  }
  return $hints;
}