<?php
/**
 * カスタム投稿の設定
 */

// 投稿タイプ名(スラッグ)にハイフンを使ってはいけない
// WordPress カスタム投稿タイプを使うときの注意点
// https://designhack.slashlab.net/tips-for-adding-custom-post-type-in-wordpress/

// 新規登録
// ----------------------------------------------------------------------------------------------------
function my_create_post_type() {
  // カスタム投稿1つ目
  register_post_type('first_custom_post',
    array(
      'label' => 'カスタム投稿1',
      'labels' => array(
        'all_items'          => '投稿一覧',
        'name'               => 'カスタム投稿1',
        'singular_name'      => 'カスタム投稿1',
        'menu_name'          => 'カスタム投稿1',
        'add_new'            => '新規追加',
        'add_new_item'       => '投稿を追加',
        'edit'               => '編集',
        'edit_item'          => '投稿の編集',
        'view'               => '表示',
        'view_item'          => '投稿を表示',
        'search_items'       => '投稿の検索',
        'not_found'          => '見つかりません',
        'not_found_in_trash' => 'ゴミ箱にはありません',
        'parent'             => '親',
      ),
      'public' => true,
      'has_archive' => true,
      'menu_position' => 5,
      'supports' => array(
        'title',
        'editor',
        // 'author',
        // 'excerpt',
        // 'thumbnail',
        'custom-fields',
        'revisions',
      ),
      'show_in_rest' => true,
      'rewrite' => array('with_front' => false)
      // 'rewrite' => array('with_front' => true)
    )
  );

  // カスタム投稿2つ目
  register_post_type('second_custom_post',
    array(
      'label' => 'カスタム投稿2',
      'labels' => array(
        'all_items'          => '投稿一覧',
        'name'               => 'カスタム投稿2',
        'singular_name'      => 'カスタム投稿2',
        'menu_name'          => 'カスタム投稿2',
        'add_new'            => '新規追加',
        'add_new_item'       => '投稿を追加',
        'edit'               => '編集',
        'edit_item'          => '投稿の編集',
        'view'               => '表示',
        'view_item'          => '投稿を表示',
        'search_items'       => '投稿の検索',
        'not_found'          => '見つかりません',
        'not_found_in_trash' => 'ゴミ箱にはありません',
        'parent'             => '親',
      ),
      'public' => true,
      'has_archive' => true,
      'menu_position' => 5,
      'supports' => array(
        'title',
        // 'editor',
        // 'author',
        // 'excerpt',
        // 'thumbnail',
        'custom-fields',
        'revisions',
      ),
      'show_in_rest' => true,
      'rewrite' => array('with_front' => false)
      // 'rewrite' => array('with_front' => true)
    )
  );

}
// 追加
add_action('init', 'my_create_post_type');


// パーマリンク設定
// ----------------------------------------------------------------------------------------------------
function my_generate_custom_post_link($link, $post) {
  if ($post->post_type === 'first_custom_post') {
    // 投稿IDに書き換えたパーマリンク文字列を返す
    return home_url('/first_custom_post/' . $post->ID);
  } else if ($post->post_type === 'second_custom_post') {
    return home_url('/second_custom_post/'.$post->ID);
  } else {
    return $link;
  }
}
function my_add_rewrite_rules($rules) {
  // 書き換えたパーマリンクに対応したクエリルールを追加
  $new_rule = array(
    'first_custom_post/([0-9]+)/?$' => 'index.php?post_type=first_custom_post&p=$matches[1]',
    'second_custom_post/([0-9]+)/?$' => 'index.php?post_type=second_custom_post&p=$matches[1]',
  );
  // ルール配列に結合
  return $new_rule + $rules;
}
// 追加
add_filter('post_type_link', 'my_generate_custom_post_link', 1, 2);
add_filter('rewrite_rules_array', 'my_add_rewrite_rules');


// 編集画面で不要な項目を非表示にする
// ----------------------------------------------------------------------------------------------------
// カスタムフィールドを非表示
function my_remove_meta_boxes() {
  remove_meta_box('postcustom', 'first_custom_post', 'normal');
  remove_meta_box('postcustom', 'second_custom_post', 'normal');
}
// add_action('admin_menu', 'my_remove_meta_boxes');
