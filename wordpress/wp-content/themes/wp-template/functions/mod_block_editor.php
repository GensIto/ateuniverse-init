<?php
/**
 * gutenberg ブロックエディタの設定
 */

// 不要なブロックを削除（いるものだけ指定 ホワイトリスト）
add_filter('allowed_block_types_all', 'custom_allowed_block_types', 10, 2);
function custom_allowed_block_types($allowed_block_types, $block_editor_context) {
  if ($block_editor_context->post->post_type === 'post' || $block_editor_context->post->post_type === 'first_custom_post') {
    $allowed_block_types = array(
      // テキスト
      'core/paragraph',// 段落
      'core/heading',// 見出し
      'core/list',// リスト
      // 'core/quote',// 引用
      // 'core/code',// コード
      // 'core/freeform',// クラシック
      // 'core/preformatted',// 整形済み
      // 'core/pullquote',// プルクオート
      // 'core/table',// テーブル
      // 'core/verse',// 詩

      // メディア
      'core/image',// 画像
      // 'core/gallery',// ギャラリー
      // 'core/audio',// 音声
      // 'core/cover',// カバー
      // 'core/file',// ファイル
      // 'core/media-text',// メディアとテキスト
      // 'core/video',// 動画

      // デザイン
      // 'core/buttons',// ボタン
      // 'core/columns',// カラム
      // 'core/group',// グループ
      // 'core/more',// 続き
      // 'core/nextpage',// ページ区切り
      // 'core/separator',// 区切り
      // 'core/spacer',// スペーサー
      // 'core/site-logo',// サイトロゴ
      // 'core/site-tagline',// サイトのキャッチフレーズ
      // 'core/site-title',// サイトのタイトル
      // 'core/query-title',// アーカイブタイトル
      // 'core/post-terms',// 投稿カテゴリー, 投稿タグ

      // ウィジェット
      // 'core/shortcode',// ショートコード
      // 'core/archives',// アーカイブ
      // 'core/calendar',// カレンダー
      // 'core/categories',// カテゴリー
      // 'core/html',// カスタムHTML
      // 'core/latest-comments',// 最新のコメント
      // 'core/latest-posts',// 最新の投稿
      // 'core/page-list',// 固定ページリスト
      // 'core/rss',// RSS
      // 'core/social-links',// ソーシャルアイコン
      // 'core/tag-cloud',// タグクラウド
      // 'core/search',// 検索

      // テーマ
      // 'core/query',// クエリーループ, 投稿一覧
      // 'core/post-title',// 投稿タイトル
      // 'core/post-content',// 投稿コンテンツ
      // 'core/post-date',// 投稿日
      // 'core/post-excerpt',// 投稿の抜粋
      // 'core/post-featured-image',// 投稿のアイキャッチ画像
      // 'core/loginout',// ログイン/ログアウト

      // 埋め込み
      // 'core/embed',
      // 'core-embed/twitter',// Twitter
      // 'core-embed/youtube',// YouTube
      // 'core-embed/wordpress',// WordPress
      // 'core-embed/soundcloud',// SoundCloud
      // 'core-embed/spotify',// Spotify
      // 'core-embed/flickr',// Flickr
      // 'core-embed/vimeo',// Vimeo
      // 'core-embed/animoto',// Animoto
      // 'core-embed/cloudup',// Cloudup
      // 'core-embed/crowdsignal',// Crowdsignal
      // 'core-embed/dailymotion',// Dailymotion
      // 'core-embed/imgur',// Imgur
      // 'core-embed/issuu',// Issuu
      // 'core-embed/kickstarter',// Kickstarter
      // 'core-embed/meetup-com',// Meetup.com
      // 'core-embed/mixcloud',// Mixcloud
      // 'core-embed/reddit',// Reddit
      // 'core-embed/reverbnation',// ReverbNation
      // 'core-embed/screencast',// Screencast
      // 'core-embed/scribd',// Scribd
      // 'core-embed/slideshare',// Slideshare
      // 'core-embed/smugmug',// SmugMug
      // 'core-embed/speaker-deck',// Speaker Deck
      // 'core-embed/tiktok',// TikTok
      // 'core-embed/ted',// TED
      // 'core-embed/tumblr',// Tumblr
      // 'core-embed/videopress',// VideoPress
      // 'core-embed/wordpress-tv',// WordPress.tv
      // 'core-embed/amazon-kindle',// Amazon Kindle
    );
  }
  return $allowed_block_types;
}


/**
 * 色、フォントなど
 */

add_theme_support('editor-color-palette', array());
add_theme_support('editor-font-sizes', array());
add_filter( 'block_editor_settings_all', function( $editor_settings ){
  $editor_settings['disableCustomColors'] = true;
  $editor_settings['disableCustomFontSizes'] = true;
  return $editor_settings;
});

// add_theme_support( '__experimental-disable-custom-gradients' );
// add_theme_support( '__experimental-editor-gradient-presets', array() );

add_theme_support( 'editor-font-sizes', array() );


/**
 * ブロックパターン・カテゴリ削除
 */

remove_theme_support('core-block-patterns');
add_filter('should_load_remote_block_patterns', '__return_false');


/**
 * 画像をフルサイズしか選択できなくする
 */

// function my_image_size_names_choose( $image_size_names ) {
//   $image_size_names = array(
//     'full' => __( 'Full Size' ),
//   );
//   return $image_size_names;
// }
// add_filter('image_size_names_choose', 'my_image_size_names_choose');


/**
 * 管理画面ブロックエディタ用css
 */

// add_editor_style('/assets/css/block-editor-style.css');
// add_theme_support( 'editor-styles' );

// function add_my_assets_to_block_editor() {
//   wp_enqueue_style('editor-style', get_template_directory_uri() . '/assets/css/editor-style.css');
// }
// add_action('enqueue_block_editor_assets', 'add_my_assets_to_block_editor');
// ▲body閉じタグの直前にstyle要素が生成され、その中にエディター用スタイルが記述される

// 補足的なcss読み込み
// function add_my_optional_assets_to_block_editor() {
//   wp_enqueue_style('optional-block-editor--styles', get_template_directory_uri() . '/assets/css/custom-post-block-editor-style.css', '', '');
// }
// add_action( 'enqueue_block_editor_assets', 'add_my_optional_assets_to_block_editor' );
// ▲この方法では.editor-styles-wrapperクラスを自動的に付与してくれたりはしないため、セレクターの書き方を工夫しないと管理画面全体のスタイルに影響してしまうので、注意が必要です。


/**
 * 埋め込みレスポンシブ化
 */

add_theme_support('responsive-embeds');


/**
 * Default block stylesを有効化
 */

add_theme_support('wp-block-styles');


/**
 * ブロックエディタ無効化
 */

// https://pikodon.com/note/solution/blockeditor/
add_filter('use_block_editor_for_post_type', 'set_block_editor', 10, 2);
function set_block_editor($default, $post_type) {
  // 固定ページの場合
  if ($post_type === 'page') return false;
  // if ($post_type === 'page' || $post_type === 'post') return false;
  return $default;
}
