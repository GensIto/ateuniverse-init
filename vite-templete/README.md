# vite-web
このプロジェクトは gulp 脱却を目標とし作成しました。
使っていたgulpのいいと感じたところは引き継いでいます

## サイトデザイン
[作って学ぶコーディング学習サイト](https://code-step.com/)さんの無料カンプのレイアウトを参考に組ませていただきました。
- [TOP](https://xd.adobe.com/view/f30fe031-d0a3-4e98-a1c1-a309c5add0c6-a65c/grid?hints=off)
- [ABOUT](https://xd.adobe.com/view/d3d624d6-c12a-4ce8-82fd-e046d7c76dd2-8685/grid?hints=off)
- [SINGLE](https://xd.adobe.com/view/8d0c7d5c-194e-4793-842d-449d7581170a-d85f/grid?hints=off)
## 採用技術

- vite
- scss
- tailwind css
  - flowbite
- typescript
- scrollreveal
- swiper

## tailwind css
このプロジェクトでは **1rem = 10px**になるようにcssで制御しています
カスタマイズはtailwind.config.cjsを参照してください
figmaとの相性もいいらしい?ソフトウェア開発っぽくなりますが共存できればかなりコーディングスピード上がりそうです。
- [チートシート](https://tailwindcomponents.com/cheatsheet/)
- [アニメーション生成ツール](https://tail-animista.vercel.app/play/basic/scale-up/scale-up-center)
- [アニメーション生成ツール参考記事](https://zenn.dev/angelecho/articles/f171ca2b3b1f6a)
- [.containerのカスタマイズ](https://www.memory-lovers.blog/entry/2022/10/14/120000)
- [tailwin default config](https://github.com/tailwindlabs/tailwindcss/blob/master/stubs/defaultConfig.stub.js)こちらでカスタマイズできるものが確認できます
- [任意の値を入れる](https://runebook.dev/ja/docs/tailwindcss/adding-custom-styles)
- [tailwind css 3(日本語訳)](https://runebook.dev/ja/docs/tailwindcss/-index-)
- [tailwind css grid generator](https://www.tailwind-tools.com/grid)
- [tailwind css gradation template](https://hypercolor.dev/)
```
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './src/**/*.{html,js,ts}',
    './node_modules/flowbite/**/*.js'
  ],
  theme: {
    fontSize: {
      xs: '1.4rem',
      sm: '1.6rem',
      base: '1.8rem',
      lg: '2rem',
      xl: '2.2rem'
    },
    extend: {
      //! ここに追記すると既存のtailwind cssの値に追加のイメージ
      //! theme直下では完全に上書きのイメージ
    }
  },
  plugins: [require('flowbite/plugin')]
};

```
htmlが冗長になりそうなときは@applyを使いscssに書くことでシュッとなると思います

## プラグイン簡単な説明
### scrollreveal
  - スクロールアニメーションのプラグイン簡単です。凝ったものは自分で記述しないとダメです
- [ドキュメント](https://scrollrevealjs.org/)
### swiper
  - スライダーのプラグイン
  - [ドキュメント](https://swiperjs.com/)
### flowbite
  - 欲しい機能(ハンバーガーメニュー,タブ,モーダル,スライダーもできるがカスタマイズは難しそう)を追加するのに使うのがいいかも
  - 細かいUIの設定は難しいのであくま機能をjs(ts)を書かなくても動かせるように
  - 切り替え時などにアニメーションをつけて欲しいと言われたら、ユーザー目線では速い方がいいと押し切りましょう！！！！(無理だったら、js,tsで書いてください....)
  - tailwind cssのUIライブラリーweb制作では使うことは少なそうですが一応
  - [ドキュメント](https://flowbite.com/)
  - [こちらはtailwind cssのUIライブラリーをまとめている記事](https://zenn.dev/kkeisuke/scraps/c3d668e6388676)

### その他おすすめプラグイン
- モーダル(Micromodal.js)
  - yarn add micromodal --save
  - [ドキュメント](https://micromodal.vercel.app/)
  - [参考記事](https://pengi-n.co.jp/blog/js-micromodal/)
  - 
- パララックス (simple parallax js)
  - yarn add simple-parallax-js
  - [ドキュメント](https://simpleparallax.com/)
  - [github](https://github.com/geosigno/simpleParallax.js/)
  - [参考記事](https://coliss.com/articles/build-websites/operation/javascript/vanilla-js-library-simpleparallax.html])
- tailwindcss-line-clamp
  - wordpressの開発などに便利かと思います。
  - 行数を指定できてそれ以上は表示されなくなります
  - yarn add @tailwindcss/line-clamp -D
  - [ドキュメント](https://tailwindcss.com/docs/plugins#line-clamp)
  - [github](https://github.com/tailwindlabs/tailwindcss-line-clamp)
  - [挙動が分かり易い記事](https://blog.cohu.dev/tailwind-css-tools#@tailwindcss/line-clamp)

## フォルダ構造
```
src
|_ _components (html 分割)
|   |
|   |_layout(header,footerなどページをとうして共通している部分)
|   |
|   |_parts(ページの部分的なもの**コンポーネント**)
|   |
|   |_tools(partsをまとめて表示させるのに使う)
|
|
|_ ts (関数コンポーネント思考)
|
|_ main.ts (ts をまとめるところ)
|
|_ scss (大きな枠のstyle layoutやfoundation)
|
|_ index.html (ページに応じて増やす)
|
|_ style.scss (scss の読み込みをを書くところ)
```

scssの配置場所は,例えばbuttonを作りたい時
components/parts/button フォルダを作成しそこにindex.htmlとstyle.scssを作る
```
components
|_ parts
  |__ button
    |_ index.html
    |_ style.scss
```
scssフォルダを作成していましたが基本tailwindで書くことになるので、layoutやfoundationを書く初期設定のような物を書く想定にしています。
scssフォルダ配下にはflocssのようにl-やu-などフォルデ名の頭文字をつけて判別してください。
componentsのstyleを明瞭的にしたかったのでフォルダの配下にhtml&scssを配置することでファイル生成&ファイル変更がしやすくなると思います。
componentsフォルダ配下のクラス名はそのままフォルダ名でいいかと思います。
(例) button -> .button-wrap

## ページを増やすとき

root/vite.config.js にて追記お願いします
33 行目あたりに下記のようなコードがあります

```
const pageData = {
  '/index.html': {
    isHome: true,
    title: 'Main Page',
    description: 'test description',
    keywords: 'test keywords',
    type: 'website',
    ogImg: '/',
    ogUrl: '/',
    lang: 'ja',
  },
};
```

ページを増やすときはこのおコードを流用し追記お願いします。
こちらによってページ別にコンテンツを独立させることによって SEO 対策を狙っています。

### 変更例

```
const pageData = {
  '/index.html': {
    isHome: true,
    title: 'Main Page',
    description: 'test description',
    keywords: 'test keywords',
    type: 'website',
    ogImg: '/',
    ogUrl: '/',
    lang: 'ja',
  },
  '/about.html': {
    isHome: true,
    title: 'about Page',
    description: 'about description',
    keywords: 'about keywords',
    type: 'website',
    ogImg: '/',
    ogUrl: '/',
    lang: 'ja',
  },
};
```

src/about.html を作成した例です。
このように追記すれば about.html 独自の seo に変更することができます

## css(scss)設計
ここではcomponentと同じ構造にしています。
flocss設計の方がいいんですかね~
[おすすめ記事](https://qiita.com/super-mana-chan/items/644c6827be954c8db2c0)
## 画像圧縮

~~root/vite.config 95 行あたりに書いています~~
~~viteImagemin の中に記述しています。~~
~~特に書き換える必要はないかと思います。もう少しすれば画像は webp を使うことを強く勧めます~~
動かないため削除しました。
色々調べると圧縮率が悪いそうで
僕が使っていた[imageoptim](https://imageoptim.com/mac)が優秀なので DL おすすめします
これからはwebpの使用がいいみたいです[サルワカ道具箱](https://saruwakakun.com/tools/png-jpeg-to-webp/)

## NG
- component/**.htmlに<style></style>でstyleを当ててもいいと思ったのですが、長くなったり汚くなるのでやめた方がいいです。partsぐらい小さいものならいいかもです~
- コーディオンにscrollrevealを追加すると反応してくれずアニメーションが発火しないバグが起きるので入れない

## ちなみに....
- [techfeed](https://techfeed.io/categories/all)
- [コリス](https://coliss.com/)
- [zenn](https://zenn.dev/)
- [wordpress私的マニュアル](https://elearn.jp/wpman/)
- [命名ツール](https://codic.jp/engine/)
- [gradation生成](https://cssgradient.io/)
- [clip mask generator](https://bennettfeely.com/clippy/)
- [can I use?](https://caniuse.com/css-filters/)
- [ファビコン生成](https://favicon-generator.mintsu-dev.com/)
- [画像圧縮](https://squoosh.app/)
- [画像圧縮](https://squoosh.app/)
- [だみー文章](https://webtools.dounokouno.com/dummytext/)
- [だみー画像](https://placehold.jp/)
- [webPについての記事](https://webdesign-trends.net/entry/13745)
- [コーダーができるSEO対策](https://web-guided.com/1147/)
- [パスワード生成](https://www.luft.co.jp/cgi/randam.php)
- [htpasswd生成](https://www.luft.co.jp/cgi/htpasswd.php)
- [javascript lesson](https://bigfrontend.dev/ja)
- [javascript news](https://jser.info/)

僕が使っていたものです~

### husky
gitなどでコードを管理する時に便利でコードの品質を担保したり,コードレビューの負担を減らせたりするものです
このプロジェクトではcommit時に以下のものが走ります。
- yarn prettier コード整形
- yarn lint:style:fix styleを事前に綺麗にする
- yarn lint:style styleが綺麗か確認する
- yarn ts-check tsに危険なものがないかチェックする
### メモ

- html に tailwind css 読み込み

  - https://bubudoufu.com/vite-js-bulma-tailwindcss/

- project 参考

  - https://zenn.dev/sakata_kazuma/articles/59a741489c8bbc

- tailwindcss 拡張
  - https://blog.cohu.dev/tailwind-css-tools#@tailwindcss/line-clamp
    - なんかめっちゃまとめてあった記事
  - https://daisyui.com/docs/install/
    - こちらかなり使いごごちがいいですが、web 制作ではテンプレートとしては使いづらいためメモ
  - ~~https://flowbite.com/docs/getting-started/quickstart/~~~
    - ~~こちら js でしたいことも込み込みであります。もし苦戦したら導入してもいいかと~~
    - 導入しました！
  - https://devdojo.com/tailwindcss/buttons
    - ボタンのテンプレートです
