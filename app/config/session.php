<?php

return [
    'driver' => 'cookie',
    'cookie_name' => 'fuel_session',
    'match_ip' => false, // 必要に応じてIPチェックを有効化
    'match_ua' => true,  // ユーザーエージェントの一致確認を有効化
    'encrypt_cookie' => true, // クッキーの暗号化を有効化
    'expire_on_close' => false,
    'expiration_time' => 7200, // セッションの有効期限（例: 2時間）
];