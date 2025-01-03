<?php

// use Fuel\Core\DB;

class Model_UserWord extends \Fuel\Core\Model
{
    // ユーザーの学習単語を取得
    public static function get_user_words($user_id)
    {
        return DB::select('user_words.id', 'words.english_word', 'words.japanese_translation', 'user_words.status')
            ->from('user_words')
            ->join('words', 'INNER')
            ->on('user_words.word_id', '=', 'words.id')
            ->where('user_words.user_id', $user_id)
            ->execute()
            ->as_array();
    }

    // ユーザーに単語を紐づける
    public static function add_user_word($user_id, $word_id, $status = 'unknown')
    {
        \Fuel\Core\Log::debug("Adding user_word: user_id = $user_id, word_id = $word_id, status = $status");
        
        return DB::insert('user_words')->set([
            'user_id' => $user_id,
            'word_id' => $word_id,
            'status' => $status,
        ])->execute();
    }

    // ユーザー単語のステータスを更新
    public static function update_status($user_word_id, $status)
    {
        return DB::update('user_words')->set(['status' => $status])
            ->where('id', $user_word_id)
            ->execute();
    }

    // ユーザー単語を削除
    public static function delete_user_word($user_word_id)
    {
        return DB::delete('user_words')
            ->where('id', $user_word_id)
            ->execute();
    }

    // エクスポート用データを取得
    public static function get_export_data($user_id)
    {
        return DB::select('words.english_word', 'words.japanese_translation')
            ->from('user_words')
            ->join('words', 'INNER')
            ->on('user_words.word_id', '=', 'words.id')
            ->where('user_words.user_id', $user_id)
            ->execute()
            ->as_array();
    }

    public static function get_progress($user_id)
    {
        $total_words = DB::select(DB::expr('COUNT(*) as count'))
            ->from('user_words')
            ->where('user_id', $user_id)
            ->execute()
            ->get('count', 0);

        $understood_words = DB::select(DB::expr('COUNT(*) as count'))
            ->from('user_words')
            ->where('user_id', $user_id)
            ->and_where('status', 'understand')
            ->execute()
            ->get('count', 0);

        // 進捗率を計算
        $progress = $total_words > 0 ? ($understood_words / $total_words) * 100 : 0;

        return [
            'total_words' => $total_words,
            'understood_words' => $understood_words,
            'progress' => round($progress, 2), // 小数点2桁に丸める
        ];
    }

}
