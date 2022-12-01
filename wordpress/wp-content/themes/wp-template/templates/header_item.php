<?php
/**
 * ヘッダーの中身
 * 
 * カスタム投稿「first_custom_post」のアーカイブページ、
 * カスタム投稿「second_custom_post」に紐づくカスタムタクソノミー「second_custom_tax」に属するターム「second_custom_tax_term」のアーカイブページ、
 * それぞれへのリンクを設置し、かつ、そのページのときには該当するリンクの見た目が変わるため、HTMLにつけているクラス名を出し分けたい。
 * という想定
 */
?>

<?php
  // クエリ情報をデフォルトの状態に戻す。ページ判定の条件分岐が効かない場合はこの記述を追加しておくと正常に動作する場合が多い
  wp_reset_query();
  // 通常、現在のページのターム情報などを取得するときはget_queried_object()を利用するが、一つのタームしか取得できないため
  // 複数タームが組み合わさっている場合にはWPのグローバル変数$wp_queryからクエリ情報を取得し、それを利用する
  // ※このファイルはキモプリから持ってきているためタームが複合しているという想定になっている
  $queriedTerms = $wp_query->query;
  // カスタム投稿「first_custom_post」のアーカイブページへのリンクを取得
  $firstCustomPostUrl = get_post_type_archive_link('first_custom_post');
  if ($firstCustomPostUrl) {
    // 「first_custom_post」へのリンクがcurrent状態になってほしいケースは、「first_custom_post」のアーカイブページの他、
    // 「first_custom_post」に紐づくタクソノミーアーカイブページの場合もあるので、その全てのタクソノミーを取得する(slugで)
    $firstCustomPostTaxonomies = get_taxonomies([
      'public' => true,
      'object_type' => ['first_custom_post'],
      // '__builtin' => false,
    ]);
    // 「first_custom_post」に紐づくすべてのタクソノミーのslugを格納する配列を定義
    // 
    if (!empty($firstCustomPostTaxonomies)) {
      $firstCustomPostTaxonomiesArray = [];
      foreach ($firstCustomPostTaxonomies as $firstCustomPostTaxonomy) {
        $firstCustomPostTaxonomiesArray[] = $firstCustomPostTaxonomy;
      }
    }
  }
  // ターム「second_custom_tax_term」のアーカイブページへのリンクを取得
  $secondCustomTaxTerm = get_term_by('slug', 'second_custom_tax_term', 'second_custom_tax');
  if ($secondCustomTaxTerm) {
    $secondCustomTaxTermId = $secondCustomTaxTerm->term_id;
    $secondCustomTaxTermUrl = get_term_link((int)$secondCustomTaxTermId);
  }
  // WPの「表示設定 > ホームページの表示」で「投稿ページ」に指定しているページへのリンクを取得。大体はindex.phpになる。今回は「お知らせ」という想定
  $newsUrl = get_permalink(get_option('page_for_posts'));
  // 固定ページ「about」へのリンクを取得 したい場合
  // $about = get_page_by_path('about');
  // if ($about) {
  //   $aboutUrl = get_permalink($about->ID);
  // }
  // 出し分けるクラス
  $headerNavDividerClassName = 'p-header-nav__divider';
  $headerNavDividerCurrentClassName = 'p-header-nav__divider p-header-nav__divider--current';
  $gnavDividerClassName = 'p-gnav__divider';
  $gnavDividerCurrentClassName = 'p-gnav__divider p-gnav__divider--current';
?>
<?php /* ヘッダー */ ?>
<header class="l-header" id="js-header">
  <div class="c-logo c-logo--type_header">
    <a class="c-logo__inner" href="<?php echo esc_url(home_url('/')); ?>">
      <img class="c-logo__item" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/logo/header.png" alt="ウェブサイトの名前">
    </a>
  </div>
  <div class="p-header-nav">
    <ul class="p-header-nav__group">
      <?php /* トップ */ ?>
      <li class="
        <?php is_front_page() ? print htmlspecialchars($headerNavDividerCurrentClassName) : print htmlspecialchars($headerNavDividerClassName); ?>
      ">
        <a class="p-header-nav__item" href="<?php echo esc_url(home_url('/')); ?>">TOP</a>
      </li>

      <?php
        // first_custom_postを探す
        if ($firstCustomPostUrl):
      ?>
        <li class="
          <?php
            if (isset($firstCustomPostTaxonomiesArray) && count($firstCustomPostTaxonomiesArray) !== 0) {
              is_post_type_archive('first_custom_post') || is_tax($firstCustomPostTaxonomiesArray) ? print htmlspecialchars($headerNavDividerCurrentClassName) : print htmlspecialchars($headerNavDividerClassName);
            } else {
              is_post_type_archive('first_custom_post') ? print htmlspecialchars($headerNavDividerCurrentClassName) : print htmlspecialchars($headerNavDividerClassName);
            }
          ?>
        ">
          <a class="p-header-nav__item" href="<?php echo esc_url($firstCustomPostUrl); ?>">first_custom_postを探す</a>
        </li>
      <?php endif; ?>

      <?php
        // second_custom_tax_termを探す
        if ($secondCustomTaxTerm && !is_wp_error($secondCustomTaxTermUrl)):
      ?>
        <li class="
          <?php (!empty($queriedTerms) && array_search('second_custom_tax_term', $queriedTerms)) || is_tax('second_custom_tax', 'second_custom_tax_term') ? print htmlspecialchars($headerNavDividerCurrentClassName) : print htmlspecialchars($headerNavDividerClassName); ?>
        ">
          <a class="p-header-nav__item" href="<?php echo esc_url($secondCustomTaxTermUrl); ?>">second_custom_tax_termを探す</a>
        </li>
      <?php endif; ?>

      <?php
        // お知らせ
        if ($newsUrl):
      ?>
        <li class="
          <?php is_archive() && !is_post_type_archive() && !is_tax() ? print htmlspecialchars($headerNavDividerCurrentClassName) : print htmlspecialchars($headerNavDividerClassName); ?>
        ">
          <a class="p-header-nav__item" href="<?php echo esc_url($newsUrl); ?>">お知らせ</a>
        </li>
      <?php endif; ?>

      <?php
        // about
        // if (isset($aboutUrl)):
      ?>
        <?php /*
        <li class="
          <?php is_page('about') ? print htmlspecialchars($headerNavDividerCurrentClassName) : print htmlspecialchars($headerNavDividerClassName); ?>
        ">
          <a class="p-header-nav__item" href="<?php echo esc_url($aboutUrl); ?>">about</a>
        </li>
        */ ?>
      <?php // endif; ?>
    </ul>
  </div>
</header>

<?php /* ハンバーガーメニュー */ ?>
<div class="p-hamburger" id="js-gnav-trg">
  <div class="p-hamburger__container">
    <span class="p-hamburger__item"></span>
    <span class="p-hamburger__item"></span>
    <span class="p-hamburger__item"></span>
  </div>
</div>
