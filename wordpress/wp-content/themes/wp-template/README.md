# WPテーマ制作の手順など

## このテンプレートの構造

[WordPress 編集がし易くなる！テンプレートファイルの3つの管理方法](https://millkeyweb.com/wp-templates-management/#2)  
このページを参考に、自作で分割しているテンプレートファイル（パーツテンプレートファイル）は全部/templates/の中に入れています。  
header.phpなどのベーステンプレートファイルはテーマフォルダ直下に入れています。

---

## テーマ制作の流れ

1. まずは普通に静的なウェブサイトと同じようにコーディングする
1. WPをサーバーもしくはローカル環境にインストール、カスタム投稿やカスタムフィールドを作る。この際functions.phpを編集する
1. 使うことが明白なものからwp用のphpファイル化していく。慣れてくると大体のことは実際のWPを見なくても動作の想像がつくので前項1.を最後の方にすることもある
    - header.php
    - footer.php
    - front-page.php
    - index.php
    - single.php
    - page.php
    - 404.php など
1. ループなどテンプレートファイルを編集する
1. テーマを有効化して調整する
1. 完成

テーマのファイルは

- [WordPress Codex 日本語版 *(旧 更新停止)*](https://wpdocs.osdn.jp/Main_Page)
- [WordPress サポート *(新)*](https://ja.wordpress.org/support/)

でタグや関数を確認しながら作っていくことになります。

### エスケープについて

WPのテーマで文字列をechoやprintなどを使って出力する際はそれらを適切にエスケープ処理する必要があります。  
（エスケープしなくてもウェブサイトとしての機能はできてしまうので、あまり意識せずに構築してしまいます）

- [WordPress エスケープ処理](https://www.webdesignleaves.com/pr/wp/wp_escape_functions.html)
- [【WordPress】エスケープ関数の使い方](https://hsmt-web.com/blog/wp-escape/)
- [WordPressでechoする文字を適切にエスケープする](https://morilog.com/wordpress/tips/wp_escape/)
- [8つの攻撃手法別】PHPのセキュリティ対策方法を解説！対策の重要性とは](https://www.acrovision.jp/career/?p=1996)
---

## functions.phpについて

テーマの初期設定的なことや機能追加などこのファイルで行っています。  
  
[WordPress functions.phpを関数ごとに分割して管理しやすくする話](https://meshikui.com/2018/08/24/753/)  
functions.phpは長いファイルになりがちで、またテンプレートとしてよく使いそうな機能をあらかじめ記述しておき、案件によって使うか使わないか決めていく方が楽だと思うので機能ごとに分割し、使わないものはインクルードの記述をコメントアウトする方法を採っています。

基本的にプラグインは使わずfunctions.phpに記述して実装することが多いです。  
極力プラグインを使わない理由としては、

- バージョンアップのときにネックになる（特に個人開発のマイナーなものなどは対応しないことが多い）
- 仕組みを理解していないのでエラーの対応が難しい
- 意図している動作と完全には合致しない、また要件を満たせないことが多い
- フロントに出力する系のものはCSSを書き直すことになり無駄に時間がかかる
- WPに関する大体のことは調べれば分かる（WPは色々なカスタマイズができるので理解が深まると他の案件でも活かせる）

など挙げられます。

この項の以下は分割したファイルの解説です。（必要だと思ったものだけ抜粋しています。ちなみにファイル名は任意に決められます）

### init.php

テーマの初期設定。読み込ませるCSSやJavaScriptを管理。

> CSSやJavaScriptの読み込みはSTYLEタグやSCRIPTタグをheader.phpなどに直接書くこともできますが、WordPressではfunctions.phpでwp_enqueue_style()、wp_enqueue_script()をアクションフックを使って読み込むことが推奨されています。  
> wp_enqueue_style()やwp_enqueue_script()を利用する利点として、CSSやJavaScriptの重複読み込みを回避できたり、functions.php内で一元管理できることなどが挙げられます。

[functions.phpでJSやCSSを一元管理する](https://rfs.jp/sb/wordpress/wp-lab/wp_enqueue_script.html)

### mod_admin_menu.php

管理画面左のメニューから特定の項目を非表示にするなどの設定。

### mod_post.php

通常投稿の設定。

### custom_post_type.php

カスタム投稿の追加。

### custom_taxonomy.php

カスタムタクソノミーの追加。

### mod_block_editor.php

ブロックエディター（Gutenberg）の設定。  
ブロックエディターは標準だと色々な機能がありすぎるため、使わないブロックは非表示にした方が良いです。  
よくあるお知らせ程度の投稿だと、「段落」、「見出し」、「リスト」、「画像」ぐらいで十分かと思います。

ブロックエディター内と実際のページの装飾を合わせたい場合は管理画面用にCSSを別途作成する必要がありますが、  
元からあるものをコピペして作ればOK、という訳にもいかずなかなか工数がかかります。  
また、タイトルのあしらいに画像などがある場合、パスの関係でエディター内では実現することが難しいこともあります。  
もしエディター内の見た目をフロントと合わせないといけない場合は、そのシングルページのデザインはCSSだけで実装できるものにした方が良いです。

- [Gutenbergのブロックエディターにテーマのスタイルを適用する方法](https://qiita.com/youthkee/items/3c8b8f91314727d40d3f#%E3%82%A8%E3%83%87%E3%82%A3%E3%82%BF%E3%83%BC%E7%94%A8css%E3%81%AE%E8%A8%98%E8%BF%B0%E4%BE%8B)
- [【Gutenberg】ブロックエディタの編集画面と、実際の表示画面を同じ見た目にする設定方法](https://yumegori.com/wordpress-gutenberg-editor-custmize)

### mod_image.php

WPのメディア設定や自動生成されるサムネイルの設定。

### pagination.php

ページネーションを出力する関数。
吐き出されるHTMLタグの構造を自由に調整できる方法を採用しています。

### set_main_query.php

pre_get_postsを利用したメインクエリの設定。

- [【wordpress】pre_get_postsを使ってみませんか？](https://qiita.com/_ruka_/items/e14280d34eddf49efad1)

WPの仕組みなどがわかりやすく解説されています。  
メインループやサブループの使い分けや意味がわからない場合は一度読んでおいた方が良いです。

### functions.php参考

- [WordPress functions.phpを関数ごとに分割して管理しやすくする話](https://meshikui.com/2018/08/24/753/)
- [functions.phpでJSやCSSを一元管理する](https://rfs.jp/sb/wordpress/wp-lab/wp_enqueue_script.html)
- [【Wordpress】プラグインに頼るよりもfunctions.phpにコピペした方が便利でラクなTipsたち](https://webtrace-cuisine.com/201706/wp-installtips/)
- [\[WordPress\] Olein Designのfunctions.phpを詳しく解説します（コピペ利用可）](https://olein-design.com/blog/my-functions-php)

---

## 大体使うプラグイン

### Advanced Custom Fields

[https://www.advancedcustomfields.com/](https://www.advancedcustomfields.com/)

デファクトスタンダードといってもいいカスタムフィールド追加プラグインです。  
幅広く使われているため日本語の情報も多いです。  
カスタムフィールドも比較的簡単にfunctions.phpで自作できますが、入力内容の種類が多いと大変なのでこれに関してはほぼプラグインを使います。  
大体ACFを使いますが自由に項目を追加する（ループ、繰り返し）には有料版の購入が必要なため

- [Custom Field Suite](https://mgibbs189.github.io/custom-field-suite/)
- [Smart Custom Fields](https://2inc.org/blog/category/products/wordpress_plugins/smart-custom-fields/)

を使うことが多いです。  
どちらも有名なプラグインですが、ACFに比べると情報が少ないです。  
カスタムフィールドの繰り返しはDuplicate Postなど投稿を複製する系のプラグインと相性が悪いことが既知の不具合としてあります。

- [「Custom Field Suite」と「Duplicate Post」を併用した時に起こる問題について](https://www.web-labs.info/?p=9)

#### カスタムフィールドに入力された値の取得について

各プラグインに取得用の関数が設けられていますが、もしプラグインの切り替えなどで使っていたものが無効になると、関数が存在しないことになりエラーになってしまうため、WP標準のget_post_meta()を使用したほうが良いです。  
繰り返し機能を利用しているところは少し複雑になりますが、次のページで解説されています。  

- [Custom Field Suiteの「ループ（複製フィールド） 」を CFS()->getを使わずに出力](https://croquis.jp/post-1166/)
- [Smart Custom Fields（SCF）の繰り返し機能をget_post_metaで取得する方法](https://blog.saboh.net/get_post_meta_scf_repeat/)

基本的な考え方としては、繰り返しのカスタムフィールドは同名のlabelが増えていくことになるので、  
[get_post_meta\(\)](https://developer.wordpress.org/reference/functions/get_post_meta/)の第三引数にfalse（デフォルト値）を指定し配列で取得して回すというものです。

### SiteGuard WP Plugin

[https://www.jp-secure.com/siteguard_wp_plugin/](https://www.jp-secure.com/siteguard_wp_plugin/)

ログインページURLの変更など基本的なセキュリティ対策が簡単にできるプラグインです。

### WP Multibyte Patch

[https://eastcoder.com/code/wp-multibyte-patch/](https://eastcoder.com/code/wp-multibyte-patch/)

WPで日本語（マルチバイト文字）に関する不具合を解消するプラグインです。

### MWWP Form

[https://2inc.org/manual-mw-wp-form/](https://2inc.org/manual-mw-wp-form/)

多機能なメールフォームです。カスタマイズできる幅もとても広く、HTMLも好きなように調整できます。  
送られた内容をデータベースに保存することもできますが、個人情報などを扱っている場合は漏洩のリスクもあるため注意が必要です。  
Contact Form 7よりこちらのプラグインの方が優れていると思います。

---

## ローカル開発環境

最近だとローカルサーバーの構築はDockerでやるのが一番簡単でしかも融通も効くと思います。  
Dockerの利用が主流になっているので情報も集めやすいのでそういう意味でもおすすめです。  

- [簡単便利！DockerでWordPressの開発環境を作ろう。方法＆メリット紹介](https://goworkship.com/magazine/wordpress-docker/)

WPのテーマ制作ぐらいだとこのページに沿って作業すればできると思います。

### その他Docker参考

- [Docker Compose のインストール](https://docs.docker.jp/compose/install.html)
- [Docker-composeで最強（自分史上）のWordPress開発環境を作る](https://qiita.com/ryo2132/items/d75e1846aa181676406e)
- [Docker Compose でWordPress環境を作ってみる](http://bashalog.c-brains.jp/19/08/15-120000.php)
- [Docker + nginx + mariadb + wordpress を構築をしてみた](https://hachimoto12.com/build_docker_nginx_mariadb_wordpress.html)

---

## その他、WPの高度なカスタマイズ

### ヘッドレスCMS化

WPはバックエンドだけ担当させるようにし、フロント側では投稿情報などを、WP REST APIをJavaScriptで取得し実質静的なサイトとして動かす方法です。  
JavaScriptの高度な知識が必要になりますがWPのこのカスタマイズは最近結構流行っていると思います。

- [Next.jsを使った静的なHeadless WordPressサイトの作り方](https://www.getshifter.io/ja/next-js/)
- [【Next.js】WordPressをヘッドレスCMS化させる方法](https://akiblog10.com/headless-wordpress-nextjs/)

Next.js(React.js)、Nuxt.js(Vue.js)といったフレームワークの利用はかなり広まっていて、今風のインタラクティブなウェブサイトを作ろうとすると必須の技術なので、できれば習得しておいた方が良いです。

### MVCモデル風カスタマイズ

キモプリやBBQBIGなどのカスタム投稿のsingle-**.phpを見てもらえれば分かりますが、カスタムフィールドが多い投稿を一つのphpで作ろうとすると、情報の取得と見た目の実装でかなり長いファイルになってしまい可読性が低くなってしまいます。  
そこでMVCモデルという設計思想に基づき、取得と実装を分けて管理する手法です。

- [WordPressでHTMLとデータ取得ロジックを分離させる方法](https://www.tam-tam.co.jp/tipsnote/cms/post17254.html)
- [MVCモデル風WordPressカスタマイズ設計](https://qiita.com/ichigo_daifuku3/items/1f204d5fc1b8d89d1f06)
- [WordPressによるWEBサイト開発1 - MVCモデル的な設計](https://bahtera.jp/platform-wordpress/)