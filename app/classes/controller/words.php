<?php

// use Fuel\Core\Controller;
// use Fuel\Core\Input;
// use Fuel\Core\Response;
// use Fuel\Core\Session;
// use Fuel\Core\DB;
// use Fuel\Core\View;

class Controller_Words extends Controller
{
    public function before()
    {
        parent::before();

        // ログイン確認
        if (!Session::get('user_id')) {
            return Response::redirect('auth/login');
        }
    }


    // use Fuel\Core\Config;

    public function action_index()
    {
        // セッションからユーザーIDを取得
        $user_id = Session::get('user_id');
    
        // 1ページあたりの単語数をConfigから取得
        $items_per_page = Config::get('my_config.items_per_page', 20); // デフォルト値20
    
        // モデルを利用してデータを取得
        $user_words = Model_UserWord::get_user_words($user_id, $items_per_page);
    
        // アプリ名をConfigから取得
        $app_name = Config::get('my_config.app_name', 'Vocabulary App');
    
        // ビューにデータを渡す
        return View::forge('words/index', [
            'user_words' => $user_words,
            'app_name' => $app_name,
            'items_per_page' => $items_per_page,
        ]);
    }
    
    

    // 単語の追加
    public function action_add()
    {
        if (Input::method() === 'POST') {
            $english_word = Input::post('english_word');
            $japanese_translation = Input::post('japanese_translation');
            $user_id = Session::get('user_id');

            \Fuel\Core\Log::debug("Received: $english_word, $japanese_translation for user_id: $user_id");
            
            // モデルを利用して単語を追加
            $word_id = Model_Word::add_word($english_word, $japanese_translation, $user_id);

            // ユーザーに単語を紐づけ
            Model_UserWord::add_user_word($user_id, $word_id);

            return Response::redirect('words/index');
        }

        return View::forge('words/add');
    }




    // 単語の削除
    public function action_delete($id)
    {
        // ユーザー単語を削除
        Model_UserWord::delete_user_word($id);

        return Response::redirect('words/index');
    }


    // 単語の編集
    public function action_edit($id)
    {
        if (Input::method() === 'POST') {
            $status = Input::post('status');
    
            // ステータスを更新
            Model_UserWord::update_status($id, $status);
    
            return Response::redirect('words/index');
        }
    
        // 現在の情報を取得
        $user_word = DB::select()
            ->from('user_words')
            ->where('id', $id)
            ->execute()
            ->current();
    
        if (!$user_word) {
            throw new \HttpNotFoundException('指定された単語は存在しません。');
        }
    
        return View::forge('words/edit', ['user_word' => $user_word]);
    }
    


    public function action_import()
    {
        if (Input::method() === 'POST' && isset($_FILES['csv_file'])) {
            $file = $_FILES['csv_file']['tmp_name'];

            if (($handle = fopen($file, 'r')) !== false) {
                $user_id = Session::get('user_id');

                while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                    if (count($data) < 2) {
                        continue; // 不正な行はスキップ
                    }

                    list($english_word, $japanese_translation) = $data;

                    // モデルを使用して単語を追加
                    Model_Word::add_word($english_word, $japanese_translation, $user_id);
                }
                fclose($handle);
            }

            return Response::redirect('words/index');
        }

        return View::forge('words/import');
    }


    public function action_export()
    {
        $user_id = Session::get('user_id');

        // モデルを利用してエクスポート用データを取得
        $user_words = Model_UserWord::get_export_data($user_id);

        // CSV出力
        $filename = 'vocabulary_export_' . date('Ymd') . '.csv';
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=' . $filename);

        $output = fopen('php://output', 'w');
        foreach ($user_words as $word) {
            fputcsv($output, $word);
        }
        fclose($output);

        exit;
    }

    public function action_get_words()
    {
        $user_id = Session::get('user_id');

        $words = Model_UserWord::get_user_words($user_id);

        return $this->response(['words' => $words]);
    }

    public function action_update_status()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        $user_word_id = $input['id'];
        $status = $input['status'];

        if (Model_UserWord::update_status($user_word_id, $status)) {
            return $this->response(['success' => true]);
        } else {
            return $this->response(['success' => false], 400);
        }
    }

    
}
