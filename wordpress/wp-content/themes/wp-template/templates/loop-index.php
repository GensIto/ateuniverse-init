<?php
/**
 *  通常投稿アーカイブページ用ループ（メインループ）
 */
?>

<?php if (have_posts()): ?>
  <ul class="">
    <?php while (have_posts()): ?>
      <?php
        the_post();
        $postId = get_the_ID();
      ?>
      <li class="">
        <a class="" href="<?php echo esc_url(the_permalink()); ?>">
          <div class="">
            <p class="">
              <time datetime="<?php echo htmlspecialchars(get_post_time('Y-m-d')); ?>"><?php echo htmlspecialchars(get_post_time('Y.m.d')); ?></time>
            </p>
          </div>
          <div class="">
            <p class="">
              <?php the_title(); ?>
            </p>
          </div>
        </a>
      </li>
    <?php endwhile; ?>
  </ul>
<?php else: ?>
  <div class="">
    <p>ただいま準備中です</p>
    <p>公開までしばらくお待ちください。</p>
  </div>
  <div class="c-btn">
    <div class="c-btn__wrap">
      <a class="c-btn__item c-btn__item--reverse" href="<?php echo esc_url(home_url('/')); ?>">
        <p class="c-btn__txt">トップページへ</p>
        <div class="c-btn__arrow"></div>
      </a>
    </div>
  </div>
<?php endif; ?>
