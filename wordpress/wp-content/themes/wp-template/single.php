<?php get_header(); ?>

<?php if (have_posts()): while (have_posts()): the_post(); ?>
  <?php
    // ▼投稿の情報を取得
    $postId = get_the_ID();
  ?>
  <?php the_content(); ?>
<?php endwhile; else: endif; ?>

<?php get_footer(); ?>
