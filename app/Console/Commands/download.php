<?php

namespace App\Console\Commands;

use App\Model\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class download extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sml:download {table}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $table = $this->argument('table');
        $results = Product::all();

        $csvArray = [];
        foreach ($results as $v)
        {
            $csvArray[] =
                [
                    'id' => $v['id'],
                    'name' => $v['name'],
                    'detail' => $v['detail'],
                    'price' => $v['price'],
                    'stock' => $v['stock'],
                    'discount' => $v['discount'],
                    'user_id' => $v['user_id'],
                    'created_at' => $v['created_at'],
                    'updated_at' => $v['updated_at'],
                ];
        }
        $pathToGenerate = "C:\\xampp\\htdocs\\eapi\\db\\DbToCsv.csv";
        $header = null;
        $createFile = fopen($pathToGenerate, "w+");
        foreach ($csvArray as $row) {

            if (!$header) {

                fputcsv($createFile, array_keys($row));
                fputcsv($createFile, $row);   // do the first row of data too
                $header = true;
            } else {
                fputcsv($createFile, $row);
            }
        }
        fclose($createFile);


    }
}
