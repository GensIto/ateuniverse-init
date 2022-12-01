<?php
/**
 * 管理バー表示スペースの確保のためのコールバックを削除（カスタマイズするため）
 */

//
add_theme_support('admin-bar', array('callback' => '__return_false'));
