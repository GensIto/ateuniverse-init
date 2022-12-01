<?php
/**
 * カテゴリー・タグ・タクソノミー・タームの日本語を自動的に英語にする
 */


// ****************************************************************************************************
// タグをチェックボックス化
// https://nldot.info/how-to-change-the-tags-to-checkbox-in-gutenberg/#toc2
// ****************************************************************************************************
function _re_register_post_tag_taxonomy() {
  $tag_slug_args = get_taxonomy('post_tag');// returns an object
  $tag_slug_args -> hierarchical = true;
  $tag_slug_args -> meta_box_cb = 'post_categories_meta_box';

  register_taxonomy('post_tag', 'post',(array) $tag_slug_args);
}
add_action('init', '_re_register_post_tag_taxonomy', 1);


// ****************************************************************************************************
// カテゴリー・タグ・タクソノミー・タームの日本語を自動的に英語にする
// ****************************************************************************************************
function my_post_taxonomy_auto_slug($term_id) {
  $tax = str_replace('create_', '', current_filter());
  $term = get_term($term_id, $tax);
  if (preg_match('/(%[0-9a-f]{2})+/', $term->slug)) {
    $taxonomyStr = str_replace('_', '-', $term->taxonomy);
    $args = array(
      'slug' => $taxonomyStr . '-' . $term->term_id
    );
    wp_update_term($term_id, $tax, $args);
  }
}

add_action('create_category', 'my_post_taxonomy_auto_slug', 10);
add_action('create_post_tag', 'my_post_taxonomy_auto_slug', 10);
// ▼カスタムタクソノミーを設定している場合は次のように一つずつ指定していく
add_action('first_custom_tax', 'my_post_taxonomy_auto_slug', 10);
add_action('second_custom_tax', 'my_post_taxonomy_auto_slug', 10);
