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
        $user_id = Session::get('user_id');

        // 進捗データを取得
        $progress = Model_UserWord::get_progress($user_id);

        return View::forge('dashboard/index', ['progress' => $progress]);
    }

}

