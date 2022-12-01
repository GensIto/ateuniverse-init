<?php
/**
 * カスタムタクソノミーの設定
 */

function my_custom_taxonomies() {
  // カスタムタクソノミー1
  $labels = array(
    'name' => _x('カスタムタクソノミー1', 'taxonomy general name'),
    'singular_name' => _x('カスタムタクソノミー1', 'taxonomy singular name'),
  );
  $args = array(
    "labels" => $labels,
    "public" => true,
    "hierarchical" => true,// true: カテゴリー / false: タグ
    "show_ui" => true,// 管理画面のメニューへの表示の有無
    "show_in_menu" => true,
    "show_in_nav_menus" => true,//「外観」＞「メニュー」への表示の有無
    "query_var" => true,// wp_queryでの使用の可否
    "rewrite" => array('slug' => 'first_custom_tax', 'with_front' => true),// パーマリンクの設定 スラッグはハイフン使わずアンスコで
    "show_admin_column" => true,// 管理画面の投稿一覧への表示の有無
    "show_in_rest" => true,
    "rest_base" => "first_custom_tax",
    "show_in_quick_edit" => true,// クイック編集への表示の可否
    // 'meta_box_cb' => false,
  );
  register_taxonomy('first_custom_tax', 'first_custom_post', $args);

  // カスタムタクソノミー2
  $labels = array(
    'name' => _x('カスタムタクソノミー2', 'taxonomy general name'),
    'singular_name' => _x('カスタムタクソノミー2', 'taxonomy singular name'),
  );
  $args = array(
    "labels" => $labels,
    "public" => true,
    "hierarchical" => true,// true: カテゴリー / false: タグ
    "show_ui" => true,// 管理画面のメニューへの表示の有無
    "show_in_menu" => true,
    "show_in_nav_menus" => true,//「外観」＞「メニュー」への表示の有無
    "query_var" => true,// wp_queryでの使用の可否
    "rewrite" => array('slug' => 'second_custom_tax', 'with_front' => true),// パーマリンクの設定 スラッグはハイフン使わずアンスコで
    "show_admin_column" => true,// 管理画面の投稿一覧への表示の有無
    "show_in_rest" => true,
    "rest_base" => "second_custom_tax",
    "show_in_quick_edit" => true,// クイック編集への表示の可否
    // 'meta_box_cb' => false,
  );
  register_taxonomy('second_custom_tax', 'second_custom_tax', $args);
}

add_action('init', 'my_custom_taxonomies');


// descriptionの中身で並び替え
// function taxonomy_orderby_description( $orderby, $args ) {
//   if ( $args['orderby'] == 'description' ) {
//       $orderby = 'tt.description';
//   }
//   return $orderby;
// }
// add_filter( 'get_terms_orderby', 'taxonomy_orderby_description', 10, 2 );
