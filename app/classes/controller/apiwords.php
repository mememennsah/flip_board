<?php

// use Fuel\Core\Input;
// use Fuel\Core\Response;
// use Fuel\Core\Controller_Rest;
// use Fuel\Core\Session;

class Controller_Api_Words extends Controller_Rest
{
    // GET /api/words
    public function get_list()
    {
        $user_id = Session::get('user_id');
        if (!$user_id) {
            return $this->response(['error' => 'ログインしてください。'], 401);
        }

        // ユーザーの単語データを取得
        $user_words = Model_UserWord::get_user_words($user_id);

        return $this->response(['words' => $user_words]);
    }

    // POST /api/words
    public function post_add()
    {
        $user_id = Session::get('user_id');
        if (!$user_id) {
            return $this->response(['error' => 'ログインしてください。'], 401);
        }

        $english_word = Input::post('english_word');
        $japanese_translation = Input::post('japanese_translation');

        if (empty($english_word) || empty($japanese_translation)) {
            return $this->response(['error' => '英単語と日本語訳を入力してください。'], 400);
        }

        // 単語を追加
        $word_id = Model_Word::add_word($english_word, $japanese_translation);
        Model_UserWord::add_user_word($user_id, $word_id);

        return $this->response(['success' => true, 'word_id' => $word_id], 201);
    }

    // DELETE /api/words/:id
    public function delete_delete($id)
    {
        $user_id = Session::get('user_id');
        if (!$user_id) {
            return $this->response(['error' => 'ログインしてください。'], 401);
        }

        // 単語を削除
        Model_UserWord::delete_user_word($id);

        return $this->response(['success' => true]);
    }
}
