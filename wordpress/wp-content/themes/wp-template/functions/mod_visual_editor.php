<?php
/**
 * ビジュアルエディタの設定
 */

// ビジュアルエディタ無効化
function mod_visual_editor($default) {
  // 固定ページの場合
  $type = get_post_type();
  if ($type === 'page') return false;
  // if ($type === 'page' || $type === 'post') return false;
  return $default;
}
add_filter('user_can_richedit', 'mod_visual_editor');
