<?php
/**
 * 投稿画面でカテゴリー（カスタムタクソノミー）の階層を維持する
 */

function solecolor_wp_terms_checklist_args($args, $post_id = null){
  $args['checked_ontop'] = false;
  return $args;
}
add_filter('wp_terms_checklist_args', 'solecolor_wp_terms_checklist_args', 10, 2);
