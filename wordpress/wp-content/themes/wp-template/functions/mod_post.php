<?php
/**
 * 通常投稿の設定
 */

function change_post_menu_label() {
  global $menu;
  global $submenu;
  $menu[5][0] = 'ニュース';
  // $submenu['edit.php'][5][0] = '投稿一覧';
  // $submenu['edit.php'][10][0] = '新規追加';
}
function change_post_object_label() {
  global $wp_post_types;
  $labels = &$wp_post_types['post']->labels;
  $labels->name = 'ニュース';
  $labels->singular_name = 'ニュース';
//   $labels->add_new = _x('追加', '投稿');
//   $labels->add_new_item = '新規追加';
//   $labels->edit_item = '投稿の編集';
//   $labels->new_item = '新規追加';
//   $labels->view_item = '投稿を表示';
//   $labels->search_items = '投稿を検索';
//   $labels->not_found = '投稿が見つかりませんでした';
//   $labels->not_found_in_trash = 'ゴミ箱に投稿は見つかりませんでした';
}
add_action('init', 'change_post_object_label');
add_action('admin_menu', 'change_post_menu_label');


function remove_post_supports() {
  $url = $_SERVER['REQUEST_URI'];
  // ▼通常投稿
  // remove_post_type_support('post', 'thumbnail');// アイキャッチ
  // remove_post_type_support('post', 'editor');// エディター
  remove_post_type_support('post', 'excerpt');// 抜粋
  remove_post_type_support('post', 'trackbacks');// トラックバック
  remove_post_type_support('post', 'comments');// コメント
  remove_post_type_support('post', 'post-formats');// 投稿フォーマット
  // unregister_taxonomy_for_object_type('category', 'post');// カテゴリ
  unregister_taxonomy_for_object_type('post_tag', 'post');// タグ
  // ▼管理者ではない場合
  // if (!current_user_can('administrator')) {
  //   unregister_taxonomy_for_object_type('category', 'post');// カテゴリ
  // }
  // ▼固定ページ
  remove_post_type_support('page', 'thumbnail');// アイキャッチ
  remove_post_type_support('page', 'comments');// コメント
  // remove_post_type_support('page', 'custom-fields'); // カスタムフィールド
  // フロントページ
  if (strstr($url, 'post=1161&action=edit')) {
    remove_post_type_support('page','editor'); // 本文
  }
}
add_action('init', 'remove_post_supports');
