<?php
/**
* カスタムメニュー
*/

function add_custom_menu() {
  register_nav_menus(array(
    'global-navi' => 'グローバルナビ'
  ));
}
add_action('after_setup_theme','add_custom_menu');

add_filter('show_admin_bar', '__return_false');

// カスタムメニューの出力タグを整形
function custom_menu_shape($item_output, $item){
  return preg_replace('/(<a.*?>[^<]*?)</', '<a href="'."{$item->url}".'">'.'<span>'."{$item->title}".'</span></a><', $item_output);
}
add_filter( 'walker_nav_menu_start_el', 'custom_menu_shape', 10, 4 );
