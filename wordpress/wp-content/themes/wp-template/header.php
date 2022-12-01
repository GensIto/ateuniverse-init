<!doctype html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title><?php wp_title( '|', true, 'right' ); bloginfo('name'); ?></title>
  <?php /* ▼noidex
    echo "<meta name='robots' content='noindex' />"; */
  ?>
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width">
  <meta name="format-detection" content="telephone=no">

  <meta name="keywords" content="key, words">
  <meta name="description" content="<?php bloginfo('description'); ?>">

  <meta property="og:type" content="website">
  <meta property="og:title" content="<?php wp_title( '|', true, 'right' ); bloginfo('name'); ?>">
  <meta property="og:description" content="<?php bloginfo('description'); ?>">
  <meta property="og:site_name" content="<?php wp_title( '|', true, 'right' ); bloginfo('name'); ?>">
  <meta property="og:url" content="<?php echo esc_url(home_url('/')); ?>">
  <meta property="og:image" content="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/common/ogp.png">
  <meta property="og:locale" content="ja_JP">

  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?php wp_title( '|', true, 'right' ); bloginfo('name'); ?>">
  <meta name="twitter:description" content="<?php bloginfo('description'); ?>">
  <meta name="twitter:image" content="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/common/ogp.png">

  <link rel="apple-touch-icon" href="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/common/favicon.png">
  <link rel="icon" href="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/common/favicon.png" type="image/png">

  <?php /* Googleフォント */ ?>
  <?php /*
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cedarville+Cursive&amp;family=Zen+Kaku+Gothic+New:wght@400;500;700&amp;display=swap" rel="stylesheet">
  */ ?>

  <?php wp_head(); ?>
</head>

<body
  <?php
    if (is_front_page()) {
      echo ' class="is-home is-front"';
    } else if (is_single()) {
      echo ' class="is-son is-single"';
    } else if(is_page()) {
      echo ' class="is-son is-page"';
    } else {
      echo ' class="is-son"';
    }
  ?>
>

  <?php wp_body_open(); ?>

  <div class="l-body" id="js-body">

    <?php
      // ****************************************************************************************************
      // l-header
      // ****************************************************************************************************
      get_template_part('templates/header_item');
    ?>
