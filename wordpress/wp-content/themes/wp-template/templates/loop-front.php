<?php
/**
 * トップページ サブループ
 * カスタム投稿「first_custom_post」のループという設定
 */
?>

<?php
  // ****************************************************************************************************
  // 「first_custom_post」の情報を取得
  // ****************************************************************************************************
  $args = array(
    'post_type' => 'first_custom_post',
    'posts_per_page' => 10,
  );
  // ▼よく解説しているページでnwe WP_Query()を格納する変数を$wp_queryとしている場合が見られるが、
  // $wp_queryはWPのグローバル変数として定義済みのものになるので注意しておいた方が良い
  $myQuery = new WP_Query($args);
?>

<?php
  // ****************************************************************************************************
  // ループ
  // ****************************************************************************************************
?>
<?php if ($myQuery -> have_posts()): ?>
  <ul class="">
    <?php while ($myQuery -> have_posts()):
      $myQuery -> the_post();
      // 投稿の情報を取得
      $postId = get_the_ID();
    ?>
      <li class="">
        <a class="" href="<?php echo esc_url(the_permalink()); ?>">
          <div class="">
            <?php the_title(); ?>
          </div>
        </a>
      </li>
    <?php endwhile; wp_reset_postdata(); ?>
  </ul>
<?php else: ?>
  <p>ただいま準備中です</p>
  <p>公開までしばらくお待ちください。</p>
<?php endif; ?>