<?php
/**
 * 画像の設定の設定
 */

// サムネイル機能ON
add_theme_support('post-thumbnails');


// フロントで表示させる画像サイズを指定
// add_image_size('pickup_thumb', 690, 716, true);


// アップロードした画像の幅を自動的にリサイズ 上限1440px
// https://www.websuccess.jp/blog/archives/2134/
function otocon_resize_at_upload($file) {
  if ($file['type'] == 'image/jpeg' OR $file['type'] == 'image/gif' OR $file['type'] == 'image/png') {
    $w = 1440;
    $h = 0;
    $image = wp_get_image_editor($file['file']);
    if (!is_wp_error($image)) {
      $size = getimagesize($file['file']);
      if ($size[0] > $w || $size[1] > $h) {
        $image->resize($w, $h, false);
        $final_image = $image->save($file['file']);
      }
    }
  }
  return $file;
}
add_action('wp_handle_upload', 'otocon_resize_at_upload');


// 画像アップロード時の自動生成を停止する
// 管理画面ではメディア設定で項目に、幅、高さそれぞれに0を入力すると停止できる
// 管理画面サムネイルの「相対的な縮小」とは幅（width）を基準とした縮小
// そこのチェックを外す場合は、あらかじめ自分でサイズを合わせてからアップする必要がある
add_filter('intermediate_image_sizes_advanced', 'disable_image_sizes');
function disable_image_sizes($new_sizes) {
  // unset( $new_sizes['thumbnail'] );
  // unset( $new_sizes['medium'] );
  unset( $new_sizes['large'] );
  unset( $new_sizes['medium_large'] );
  unset( $new_sizes['1536x1536'] );
  unset( $new_sizes['2048x2048'] );
  return $new_sizes;
}
add_filter('intermediate_image_sizes_advanced', 'disable_image_sizes');
add_filter('big_image_size_threshold', '__return_false');

// 幅768pxの画像の自動生成を停止
update_option('medium_large_size_w', 0);
