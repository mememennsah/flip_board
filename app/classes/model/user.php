<?php

// use Fuel\Core\DB;

class Model_User extends \Fuel\Core\Model
{
    // ユーザーを取得
    public static function get_user_by_username($username)
    {
        return DB::select()
            ->from('users')
            ->where('username', $username)
            ->execute()
            ->current();
    }

    // メールアドレスの重複チェック
    public static function email_exists($email)
    {
        return DB::select()
            ->from('users')
            ->where('email', $email)
            ->execute()
            ->count() > 0;
    }

    // ユーザーを登録
    public static function register_user($username, $email, $hashed_password)
    {
        return DB::insert('users')->set([
            'username' => $username,
            'email' => $email,
            'password' => $hashed_password,
        ])->execute()[0];
    }
}
