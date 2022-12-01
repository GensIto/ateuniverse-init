<?php
/**
 * フッターナビゲーション
 * 
 * 主な解説は/templates/header_item.phpを参照
 */
?>
<?php
  wp_reset_query();
  $firstCustomPostUrl = get_post_type_archive_link('first_custom_post');
  $secondCustomTaxTerm = get_term_by('slug', 'second_custom_tax_term', 'second_custom_tax');
  if ($secondCustomTaxTerm) {
    $secondCustomTaxTermId = $secondCustomTaxTerm->term_id;
    $secondCustomTaxTermUrl = get_term_link((int)$secondCustomTaxTermId);
  }
  $newsUrl = get_permalink(get_option('page_for_posts'));
?>

<div class="p-footer-links">
  <ul class="p-footer-links__list">
    <li class="p-footer-links__divider">
      <a class="p-footer-links__item" href="<?php echo esc_url(home_url('/')); ?>">
        <p class="p-footer-links__txt">TOP</p>
      </a>
    </li>
    <?php
      if ($firstCustomPostUrl):
    ?>
      <li class="p-footer-links__divider">
        <a class="p-footer-links__item" href="<?php echo esc_url($firstCustomPostUrl); ?>">
          <p class="p-footer-links__txt">first_custom_postを探す</p>
        </a>
      </li>
    <?php endif; ?>
    <?php
      if ($secondCustomTaxTerm && !is_wp_error($secondCustomTaxTermUrl)):
    ?>
      <li class="p-footer-links__divider">
        <a class="p-footer-links__item" href="<?php echo esc_url($secondCustomTaxTermUrl); ?>">
          <p class="p-footer-links__txt">second_custom_tax_termを探す</p>
        </a>
      </li>
    <?php endif; ?>
    <?php
      if ($newsUrl):
    ?>
      <li class="p-footer-links__divider">
        <a class="p-footer-links__item" href="<?php echo esc_url($newsUrl); ?>">
          <p class="p-footer-links__txt">お知らせ</p>
        </a>
      </li>
    <?php endif; ?>
  </ul>
</div>
