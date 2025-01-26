<?php
class Controller_Dashboard extends Controller
{
    public function before()
    {
        parent::before();

        // ユーザーがログインしているか確認
        if (!$this->get_user_id()) {
            return Response::redirect('auth/login');
        }
    }

    private function get_user_id()
    {
        return Session::get('user_id');
    }

    public function action_index()
    {
        $user_id = $this->get_user_id();

        // ログインしていない場合、リダイレクト
        if (!$user_id) {
            return Response::redirect('auth/login');
        }

        $username = Session::get('username');
        $progress = Model_UserWord::get_progress($user_id);

        return View::forge('dashboard/index', [
            'username' => $username,
            'progress' => $progress,
        ]);
    }
}
