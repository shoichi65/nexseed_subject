# required
- Composer
- php (7系)
- mysql (5.6以上)
- laravel（5.6.*）

## インストール
### 以下のコマンドを実行  
ドキュメント直下へ移動  
```
$ cd ~/Documents/
```  
GitHubからクローン  
```
$ git clone https://github.com/shoichi65/nexseed_subject.git
```  
matchingディレクトリへ移動  
```
$ cd nexseed_subject
```  
必要なパッケージのインストール  
```
$ composer install
```  
## laravel起動
カレントディレクトリはnexseed_subject
```
$ php artisan serve
Laravel development server started on http://localhost:8000/
```  
ブラウザ(Chrome推奨)で以下のURLを開く
```
http://localhost:8000/
```
