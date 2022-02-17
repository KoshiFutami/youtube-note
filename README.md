# SOKOMIRU（そこみる）

## 1. アプリの概要

URL: https://www.sokomiru.com/

YouTube動画とセットでメモを記録・管理できるWebアプリケーションです。

1番の推しポイントは、**何度も見返したい動画の場面も一緒に記録**できる点です。

「開始位置の時間も一緒に投稿する」というシンプルな仕組みとなっています。

### 作成に至った背景
趣味として1年前から週末にプールで泳いでいます。

今でこそぼちぼち泳げるようにはなったのですが、最初は金づちだったため、YouTubeで泳ぎ方の基本を学べる動画を見漁っていました。

動画で練習法やコツを勉強し、実際にプールでその泳ぎ方を試したとしても、なかなか思ったとおりには泳げず、帰宅してから動画を見直すのは当たり前。

そこで、「**動画投稿者が大事なポイントを話している場面**」や「**正しい泳ぎ方を実演している場面**」をすぐに見返せるアプリを作ってみたら、効率よく動画を見返せると閃き、本アプリの作成を開始しました。



## 2. 使用技術

### バックエンド
- PHP 8.0.15
- Laravel 8.78.1
- MySQL 8.0.27
- composer
- PHPUnit

### フロントエンド
- HTML
- CSS/Sass
- jQuery 3.6.0

### インフラ
- Docker/docker-compose
- Heroku
- AWS(S3)
- Nginx

### その他
- Git/GitHub
- Visual Studio Code



## 3. 機能一覧

### メイン機能
- メモ投稿（CRUD）
- タグ付け
- ブックマーク（非同期処理）
- お問い合わせフォーム
  - 確認画面表示
  - 送信完了メール・受付通知メール送信 

### 認証機能
- ユーザー登録・ログイン・ログアウト（Laravel UI） 
- Googleログイン（Laravel Socialite）
- プロフィール編集
  - プロフィール画像投稿 


