<?php

// namespace Auth;

// use Fuel\Core\Controller;
// use Fuel\Core\View;
// use Fuel\Core\Input;
// use Fuel\Core\Response;
// use Fuel\Core\Session;
// use Fuel\Core\DB;

class Controller_Auth extends Controller
{
    public function action_login()
    {
        $data = []; // エラーメッセージを格納する配列

        if (Input::method() === 'POST') {
            $username = Input::post('username');
            $password = Input::post('password');

            // モデルを使用してユーザーを検索
            $user = Model_User::get_user_by_username($username);

            if ($user && password_verify($password, $user['password'])) {
                // セッションIDを再生成
                Session::instance()->rotate();

                // セッションにユーザー情報を保存
                Session::set('user_id', $user['id']);
                Session::set('username', $user['username']);

                // ダッシュボードにリダイレクト
                return Response::redirect('dashboard/index');
            } else {
                // エラーメッセージを設定
                $data['error'] = 'ユーザー名またはパスワードが正しくありません。';
            }
        }

        return View::forge('auth/login', $data);
    }

    public function action_logout()
    {
        // セッションをクリア
        Session::delete('user_id');
        return Response::redirect('auth/login');
    }

    public function action_register()
    {
        if (Input::method() === 'POST') {
            $username = Input::post('username');
            $email = Input::post('email');
            $password = Input::post('password');
            $password_confirm = Input::post('password_confirm');

            // バリデーション
            if ($password !== $password_confirm) {
                $data['error'] = 'パスワードが一致しません。';
                return View::forge('auth/register', $data);
            }

            // メールアドレスの重複チェック
            if (Model_User::email_exists($email)) {
                $data['error'] = 'このメールアドレスは既に登録されています。';
                return View::forge('auth/register', $data);
            }

            // パスワードをハッシュ化して保存
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // モデルを使用してユーザーを登録
            $user_id = Model_User::register_user($username, $email, $hashed_password);

            // セッションにユーザー情報を保存して自動ログイン
            Session::set('user_id', $user_id);
            Session::set('username', $username);

            // ダッシュボードへリダイレクト
            return Response::redirect('dashboard/index');
        }

        return View::forge('auth/register');
    }

}
