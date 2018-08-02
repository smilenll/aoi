<?php

namespace App\Console\Commands;

use App\Http\Resources\Product\ProductCollection;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Model\Product;

class rename extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sml:rename {table}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload data';

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
     *array:5 [
     * 0 => "name"
     * 1 => "detail"
     * 2 => "price"
     * 3 => "stock"
     * 4 => "discount"
     * ]
     * @return mixed
     */
    public function handle()
    {
        $table = $this->argument('table');
        $db = DB::table($table)->select('*')->get();
        $this->importCSV();
    }


    public function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;

    }

    public function importCsv()
    {
        $file = "C:\\xampp\\htdocs\\eapi\\db\\MOCK_DATA.csv";

        $customerArr = $this->csvToArray($file);
        foreach ($customerArr as $key => $value) {
            $product = new Product;
            $product->name = $value['name'];
            $product->user_id = 4;
            $product->detail = $value['detail'];
            $product->price = $value['price'];
            $product->stock = $value['stock'];
            $product->discount = $value['discount'];
            $product->save();
        }
        return 'Jobi done or what ever';
    }
}







