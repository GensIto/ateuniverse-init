<?php wp_reset_query(); ?>
<footer class="l-footer">
  <div class="l-footer__top">
    <div class="l-footer__container">
      <div class="c-logo c-logo--type_footer">
        <a class="c-logo__inner" href="<?php echo esc_url(home_url('/')); ?>">
          <img class="c-logo__item" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/logo/footer.svg" alt="LOGO">
        </a>
      </div>
    </div>
  </div>
  <div class="l-footer__middle">
    <div class="l-footer__container">
      <?php
        // ▼フッターナビゲーション
        get_template_part('templates/footer_links');
      ?>
    </div>
  </div>
  <div class="l-footer__bottom">
    <div class="l-footer__container">
      <?php
        $then = 2022;// サイトの公開年
        $now = date('Y');
        if ($then < $now) {
          $yearStr = $then . ' - ' . $now;
        } else {
          $yearStr = $then;
        }
      ?>
      <p class="p-copy">&copy; <?php echo htmlspecialchars($yearStr); ?> WEBSITE NAME</p>
    </div>
  </div>
</footer>

<?php
  // 今使われているテンプレート名などをコメントアウトで出力（ログインしていたら）
  get_template_part('templates/check_template');
?>

<?php wp_footer(); ?>

</body>
</html>
