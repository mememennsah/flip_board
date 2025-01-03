<?php

// use Fuel\Core\DB;

class Model_Word extends \Fuel\Core\Model
{
    // 単語を追加
    public static function add_word($english_word, $japanese_translation, $user_id)
    {
        // トランザクションを開始
        DB::start_transaction();

        try {
            // 単語をwordsテーブルに追加
            $result = DB::insert('words')->set([
                'english_word' => $english_word,
                'japanese_translation' => $japanese_translation,
            ])->execute();

            $word_id = $result[0]; // 挿入されたIDを取得

            \Fuel\Core\Log::debug("New word added with ID: $word_id");

            // トランザクションをコミット
            DB::commit_transaction();

            return $word_id; // 新しい単語のIDを返す
        } catch (\Exception $e) {
            // トランザクションをロールバック
            DB::rollback_transaction();
            \Fuel\Core\Log::error('Error adding word: ' . $e->getMessage());
            return false;
        }
    }


    // 単語を取得
    public static function get_words_by_user($user_id)
    {
        return DB::select('user_words.id', 'words.english_word', 'words.japanese_translation', 'user_words.status')
            ->from('user_words')
            ->join('words', 'INNER')
            ->on('user_words.word_id', '=', 'words.id')
            ->where('user_words.user_id', $user_id)
            ->execute()
            ->as_array();
    }
}
