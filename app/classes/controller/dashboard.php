<?php

// namespace Dashboard;

// use Fuel\Core\Controller;
// use Fuel\Core\Session;
// use Fuel\Core\Response;
// use Fuel\Core\View;

class Controller_Dashboard extends Controller
{
    public function before()
    {
        parent::before();

        // ユーザーがログインしているか確認
        if (!Session::get('user_id')) {
            return Response::redirect('auth/login');
        }
    }

    public function action_index()
    {
        // セッションからユーザーIDを取得
        $user_id = Session::get('user_id');

        // ログインしていない場合、リダイレクト
        if (!$user_id) {
            return Response::redirect('auth/login');
        }

        // セッションからユーザー名を取得
        $username = Session::get('username');

        // 進捗データを取得
        $progress = Model_UserWord::get_progress($user_id);

        // ビューにデータを渡す
        return View::forge('dashboard/index', [
            'username' => $username,
            'progress' => $progress,
        ]);
    }


}

