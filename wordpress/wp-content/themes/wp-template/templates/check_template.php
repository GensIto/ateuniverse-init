<?php
  if (is_user_logged_in()) {
    wp_reset_query();
    global $template;
    $templateName = basename($template);
    echo '<!-- 現在使用しているテンプレートファイル: ' . htmlspecialchars($templateName) . ' -->';

    if (is_archive()) {
      echo '<!-- is_archive -->';
    }
    if (is_category()) {
      echo '<!-- is_category -->';
    }
    if (is_post_type_archive()) {
      echo '<!-- is_post_type_archive -->';
    }
    if (is_tax()) {
      echo '<!-- is_tax -->';
    }
    if (is_date()) {
      echo '<!-- is_date -->';
    }
    if (is_single()) {
      echo '<!-- is_single -->';
    }
    if (is_singular()) {
      echo '<!-- is_singular -->';
    }
  }
?>
