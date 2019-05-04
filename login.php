//login.php
<?php

define('TWITTER_API_KEY' , 'iYLQZfm9c2xa0ttLMKehxOonh'); //consumer key (API key)
define('TWITTER_API_SECRET', 'IvXGkwd8kRGX0Oxvx1ENGAp8BDQNlXdwuzsuGkwfzgo3DaPeSx');  //Consumer Secret (API Secret)
define('CALLBACK_URL', 'http://catch.me.1010muscle.com/callback.php');  //Twitterから認証した時に飛ぶページ場所

//TwitterOAuthのインスタンスを生成し、Twitterからリクエストトークンを取得する
$twitter_connect = new TwitterOAuth(TWITTER_API_KEY, TWITTER_API_SECRET);
$request_token = $twitter_connect->oauth('oauth/request_token', array('oauth_callback' => CALLBACK_URL));
 
//リクエストトークンはcallback.phpでも利用するのでセッションに保存する
$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
 
//Twitterの認証画面へリダイレクト
$url = $twitter_connect->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
header('Location: '.$url);
exit;