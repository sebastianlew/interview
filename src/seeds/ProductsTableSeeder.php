<?php
/**
 * Created by Sebastian Lewandowski<sebasolew@gmail.com>.
 * Date: 12.04.2018
 */

namespace Sebastianlew\Interview;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Produkt 1',
                'amount' => 4,
            ],
            [
                'name' => 'Produkt 2',
                'amount' => 12,
            ],
            [
                'name' => 'Produkt 5',
                'amount' => 0,
            ],
            [
                'name' => 'Produkt 7',
                'amount' => 6,
            ],
            [
                'name' => 'Produkt 8',
                'amount' => 2,
            ],
        ];

        DB::table('products')->insert($data);
    }
}