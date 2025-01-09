<?php
return array(
    '_root_' => 'auth/login', // デフォルトルート
    'auth/login' => 'auth/login',
    'auth/logout' => 'auth/logout',
    'dashboard/index' => 'dashboard/index', // ダッシュボードへのルート
    'words/import' => 'words/import',
    'words/export' => 'words/export',
    // APIルート
    'api/words' => 'api/words/list',               // GETリクエストで単語一覧を取得
    'api/words/add' => 'api/words/add',            // POSTリクエストで単語を追加
    'api/words/delete/(:num)' => 'api/words/delete/$1', // DELETEリクエストで単語を削除
);