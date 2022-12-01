<?php get_header(); ?>

<?php
  if (have_posts()): while (have_posts()): the_post();
    remove_filter ('the_content', 'wpautop');
    the_content();
  endwhile; else: endif;
?>

<?php get_footer(); ?>
