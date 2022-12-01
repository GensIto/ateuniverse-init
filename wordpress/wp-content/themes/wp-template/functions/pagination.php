<?php
/**
 * ページネーションの設定
 */

/**
  * ページネーション出力関数
  * $paged : 現在のページ
  * $pages : 全ページ数
  * $range : 左右に何ページ表示するか
  * $show_only : 1ページしかない時に表示するかどうか
*/
function my_pagination( $pages, $paged, $range = 3, $show_only = true ) {
  $pages = (int) $pages;//float型で渡ってくるので明示的に int型 へ
  $paged = $paged ? : 1;//get_query_var('paged')をそのまま投げても大丈夫なように

  //表示テキスト
  $text_first   = '1';
  $text_before  = '前へ';
  $text_next    = '次へ';
  $text_last    = '次へ';
  $template_directory_uri = esc_url(get_template_directory_uri());

  if (($show_only) && ($pages === 1 || $pages === 0)) {
    // １ページのみで表示設定が true の時
    echo <<<EOM
      <div class="p-pagination">
        <div class="p-pagination__container">
          <ul class="p-pagination-list p-pagination__divider">
            <li class="p-pagination-list__item is-current">
              <div class="p-pagination-list__inner"></div>
            </li>
          </ul>
          <ul class="p-pagination-nav p-pagination__divider">
            <li class="p-pagination-nav__item p-pagination-nav__item--prev">
              <div class="p-pagination-nav__inner">
                <div class="p-pagination-nav__arrow"></div>
              </div>
            </li>
            <li class="p-pagination-nav__item p-pagination-nav__item--next">
              <div class="p-pagination-nav__inner">
                <div class="p-pagination-nav__arrow"></div>
              </div>
            </li>
          </ul>
        </div>
      </div>
EOM;
    return;
  }

  if ($pages === 1) return;// １ページのみで表示設定もない場合

  if (1 !== $pages) {
    //２ページ以上の時
    echo '<div class="p-pagination">';
    echo '<div class="p-pagination__container">';
    echo '<ul class="p-pagination-list p-pagination__divider">';
    if ($paged > $range + 1) {
      // 「最初へ」 の表示
      echo '<li class="p-pagination-list__item"><a class="p-pagination-list__inner" href="', get_pagenum_link(1), '"></a></li>';
      // 「...」
      echo '<li class="p-pagination-list__item is-disabled"><div class="p-pagination-list__inner">...</div></li>';
    }
    for ($i = 1; $i <= $pages; $i++) {
      if ($i <= $paged + $range && $i >= $paged - $range) {
        // $paged +- $range 以内であればページ番号を出力
        if ($paged === $i) {
          echo '<li class="p-pagination-list__item is-current"><div class="p-pagination-list__inner"></div></li>';
        } else {
          echo '<li class="p-pagination-list__item"><a class="p-pagination-list__inner" href="', get_pagenum_link($i), '"></a></li>';
        }
      }
    }
    if ($paged + $range < $pages) {
      // 「...」
      echo '<li class="p-pagination-list__item is-disabled"><div class="p-pagination-list__inner">...</div></li>';
      // 「最後へ」 の表示
      echo '<li class="p-pagination-list__item"><a class="p-pagination-list__inner" href="', get_pagenum_link($pages), '"></a></li>';
    }
    echo '</ul>';// <ul class="p-pagination-list">
    echo '<ul class="p-pagination-nav p-pagination__divider">';
    if ($paged > 1) {
      // 「前へ」 の表示
      echo '<li class="p-pagination-nav__item p-pagination-nav__item--prev is-active">';
      echo '<a class="p-pagination-nav__inner" href="', get_pagenum_link( $paged - 1 ), '">';
      echo '<div class="p-pagination-nav__arrow"></div>';
      echo '</a>';
      echo '</li>';
    } else {
      echo '<li class="p-pagination-nav__item p-pagination-nav__item--prev">';
      echo '<div class="p-pagination-nav__inner">';
      echo '<div class="p-pagination-nav__arrow"></div>';
      echo '</div>';
      echo '</li>';
    }
    if ($paged < $pages) {
      // 「次へ」 の表示
      echo '<li class="p-pagination-nav__item p-pagination-nav__item--next is-active">';
      echo '<a class="p-pagination-nav__inner" href="', get_pagenum_link( $paged + 1 ), '">';
      echo '<div class="p-pagination-nav__arrow"></div>';
      echo '</a>';
      echo '</li>';
    } else {
      echo '<li class="p-pagination-nav__item p-pagination-nav__item--next">';
      echo '<div class="p-pagination-nav__inner">';
      echo '<div class="p-pagination-nav__arrow"></div>';
      echo '</div>';
      echo '</li>';
    }
    echo '</ul>';// <ul class="p-pagination-nav">
    echo '</div>';
    echo '</div>';
  }
}

// 前後の記事のリンクにclassを追加
// ----------------------------------------------------------------------------------------------------
// 投稿一覧
function add_prev_posts_link_attr() {
  return 'class="p-pagination-nav__inner"';
}
add_filter('previous_posts_link_attributes', 'add_prev_posts_link_attr');

function add_next_posts_link_attr() {
  return 'class="p-pagination-nav__inner"';
}
add_filter('next_posts_link_attributes', 'add_next_posts_link_attr');

// 投稿個別
add_filter( 'previous_post_link', function($output) {
  return str_replace('<a href=', '<a class="p-pagination-nav__inner" href=', $output);
});
add_filter( 'next_post_link', function($output) {
  return str_replace('<a href=', '<a class="p-pagination-nav__inner" href=', $output);
});
