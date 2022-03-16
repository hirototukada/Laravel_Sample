<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportPostalCodeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:postal-code'; //コマンド実行名

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import postal-code'; //コマンドの説明内容

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // 登録処理の前にテーブルを一旦、空にする
        \App\PostalCode::truncate();

        // CSVファイルの文字コード変換
        $csv_path = storage_path('app/csv/KEN_ALL.CSV'); //先程ダウンロードしたCSVファイルのパスを書く
        $converted_csv_path = storage_path('app/csv/postal_code_utf8.csv'); //CSVファイルの文字コードをSJIS-winからUTF-8に変換した後のファイル名を指定

        // 文字コードを変換したCSVファイルから郵便データを取得してDBへ保存
        $file = new \SplFileObject($csv_path);
        $file->setFlags(\SplFileObject::READ_CSV);

        foreach ($file as $row) {
            if (!is_null($row[0])) { //空行の場合、登録処理の際にエラーが発生することがあるので条件分岐させる
                \App\PostalCode::create([
                    'first_code' => intval(substr($row[2], 0, 3)),
                    'last_code' => intval(substr($row[2], 3, 4)),
                    'prefecture' => $row[6],
                    'city' => $row[7],
                    'address' => (str_contains($row[8], '（')) ? current(explode('（', $row[8])) : $row[8],
                ]);
            }
        }
    }
}
