<?php
/**
 * メインクエリの設定
 */

function my_set_main_loop($query) {

  // 管理画面,メインクエリ以外に干渉しないために必須
  if (is_admin() || !$query->is_main_query()) {
    return;
  }

  // ▼少し複雑な例
  // カスタム投稿「hoge」のタクソノミー「fuga」のターム「piyo」と「hogera」の
  // アーカイブページでは、他のタクソノミーと複合させた一覧にしたいとき
  if ($query->is_tax('fuga')) {
    if ($query->is_tax('fuga', 'piyo')) {
      $fugaTermSlug = 'piyo';
    } else if ($query->is_tax('fuga', 'hogera')) {
      $fugaTermSlug = 'hogera';
    }
    $taxQueryCont = [];
    $taxQueryCont += array('relation' => 'AND');
    $firstTaxQueryCont = array(
      'taxonomy' => 'fuga',
      'field' => 'slug',
    );
    if (isset($fugaTermSlug)) {
      $firstTaxQueryCont += array(
        'terms' => $fugaTermSlug
      );
    }
    $taxQueryCont[] = $firstTaxQueryCont;
    /* ここまででtax_queryは▼のようになる
    'tax_query' => array(
      $firstTaxQueryCont
    )
    ▼ すなわち
    'tax_query' => array(
      'relation' => 'AND',
      array(
        'taxonomy' => 'fuga',
        'field' => 'slug',
        'terms' => $fugaTermSlug
        ),
      )
    )
    ▼ ここから▼でtax_queryにarray()を追加する
    */
    if (!empty($_SERVER['QUERY_STRING'])) {
      $queryStr = urldecode($_SERVER['QUERY_STRING']);
      parse_str($queryStr, $queryStrArry);// 連想配列
      foreach ($queryStrArry as $queryStrArryKey => $queryStrArryVal) {
        if (isset($_GET[$queryStrArryKey]) && $_GET[$queryStrArryKey] != "") {
          $addTaxQueryCont = array(
            'taxonomy' => $queryStrArryKey,
            'field' => 'slug',
            'terms' => $_GET[$queryStrArryKey],
          );
          $taxQueryCont[] = $addTaxQueryCont;
        }
      }
    }
    $query->set('tax_query', $taxQueryCont);
    return;
  }

  // タクソノミーアーカイブページ全般（タクソノミー「fuga」除く）
  if ($query->is_tax() && !$query->is_tax('fuga')) {
    $query->set('posts_per_page', '9');
    return;
  }

  // カスタム投稿投稿一覧ページ
  // if ($query->is_post_type_archive('shop')) {
  //   $query->set('posts_per_page', '6');
  //   return;
  // }

  // カスタム投稿投稿一覧ページ
  // if ($query->is_post_type_archive()) {
  //   $query->set('posts_per_page', '12');
  //   return;
  // }

  // カテゴリーアーカイブページ
  // if ($query->is_category()) {
  //   $query->set('posts_per_page', '12');
  //   return;
  // }

  // 日付アーカイブページ
  // if ($query->is_date()) {
  //   $query->set('posts_per_page', '12');
  //   return;
  // }

  // アーカイブページ
  // if ($query->is_archive()) {
  //   $query->set('posts_per_page', '12');
  //   return;
  // }

  // 通常投稿一覧ページ
  // if ($query->is_home() && !$query->is_front_page()) {
  //   $query->set('posts_per_page', '12');
  //   return;
  // }

}
add_action('pre_get_posts', 'my_set_main_loop');
