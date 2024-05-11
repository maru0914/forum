<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'slug' => 'general',
                'name' => '一般',
                'description' => '映画や映画に関するあらゆること！',
            ],
            [
                'slug' => 'reviews',
                'name' => 'レビュー',
                'description' => '最新の映画についてのレビューをチェックしませんか？',
            ],
            [
                'slug' => 'questions',
                'name' => '質問',
                'description' => 'あの脚本がよくわからなかった？ぜひ質問してみてください！',
            ],
            [
                'slug' => 'conspiracies',
                'name' => '陰謀論',
                'description' => '『インクレディブル・ファミリー』と『モンスターズ・インク』がどう関連しているかについての考察がありますか？ぜひ秘密を明かしてください！',
            ],
            [
                'slug' => 'fan-fic',
                'name' => 'フィクション',
                'description' => '続編の素晴らしいアイデアがありますか？それについて話して、みんなの意見を聞いてみましょう。',
            ],

        ];

        Topic::upsert($data, ['slug']);
    }
}
