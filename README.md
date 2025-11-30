# site name
<br>

## 環境について
|name|ver|
|---|---|
|node|v22.1.0|
|npm|10.7.0|

### 0. ローカル環境構築
wordpressが動く環境なら何でもOK  
*note: 自分はDocker環境*

### 1. npmライブラリのインストール
`src`ディレクトリで `npm i`

### 2. src/scss, src/jsでの変更をコンパイル
`src`ディレクトリで `npm run watch`  
*note: 追加でwatchしたい場合は`webpack.config.js:18`にobjectを追加*

### 3. 圧縮コンパイル（公開前）
`src`ディレクトリで `npm run prod`
<br>
<br>
<br>

## ACFの使用範囲について
- ページ名
  - 該当箇所
  - 該当箇所
<br>
<br>

## cssについて
特定のcssファイルを読み込む場合はページサイドバー下部のページ固有cssにて`hoge.css`を明記してください。  
複数読み込む場合は`,`で区切ってください。  
尚、デフォルトで読み込みこまれるcssは以下を参照してください。  
下記以外で個別にscssがある場合は各固定ページに割り当てられています。

|page|default|
|---|---|
|フロントページ|home.css|
|サブページ|sub.css|
|投稿関連ページ|post.css|
<br>

### 各種scssファイルについて
---
|file|note|
|---|---|
|base/background|背景関連（廃止しようか検討中）|
|base/base|htmlやbodyなどベースになる箇所やself rest|
|base/display|display関連|
|base/layout|inner関連|
|base/layout|inner関連|
|base/space|margin, padding関連|
|base/text|font, 各種テキスト関連|
|components配下|コンポーネント（本来sectionsやpartialsとして使用するものもこちらに：案件の規模によって変更）|
|functions/functions|mixinや各種関数|
|setting/utility|色や幅などの各種変数, web fontもこちらで読み込む|

<br>

### 各種SP⇔PCのサイズ変更について
---
例えばfont-sizeなど、SP⇔PCでサイズが変わる箇所が上記に当たります。  
上記の場合、こちらのmixinを使用してください。  
※ `'/functions/functions' as mx`の読み込みが必要
#### SP: 16px, PC: 24pxの場合
``` scss
font-size: mx.autoClamp({sp}, {pc});
font-size: mx.autoClamp(16, 24);
```
#### SP: 12px, Tablet: 32px, PC: 36pxの場合
``` scss
font-size: mx.autoClampSp({sp}, {tablet}, {pc}, {tablet width: default: 750});
font-size: mx.autoClampSp(12, 32, 36, 1024);
```


<br>

### MediaQueryについて
---
MediaQueryは`src/scss/setting/_utility.scss`内の`$breakpoints`の数値を元に制御しています。  
**MediaQueryをscssで設定したい場合**
```scss
  @include mq(sm) {}     // (max-width: 600px)
  @include mq(sm-up) {}  // (min-width: 600.1px)
```
**特定のbreakpointで非表示設定をしたい場合**
```html
  <div class="--sm"></div>     <!-- sm以上で非表示 -->
  <div class="--sm-up"></div>  <!-- sm以下で非表示 -->

```
<br>


## 各種jsファイルについて
`src/app.js`にまとめる。コンパイル後は`js/bundle.js`として吐き出される。

### 各種scssファイルについて
---
|file|note|
|---|---|
|accordion.js|色々と融通のきくアコーディオン|
|fetchApi.js|簡単なfetch（複雑な場合はVueを使用）|
|accordion.js|色々と融通のきくアコーディオン|
|navigation.js|主にバーカーからのナビ表示アクションのためのもの|
|stickyContent.js|主に追従headerやCTAのためのもの|

