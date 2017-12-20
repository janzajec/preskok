<?php

namespace App\Preskok\Junior;

use Faker\Factory;

class Practical
{

    private $url = 'https://admin.b2b-carmarket.com//test/project';

    public function parse()
    {

        \DB::table('junior_practical')->truncate();
        $data = file_get_contents($this->url);

        $rows = explode("\n", $data);

        $bulk = [];

        for ($i = 1; $i <= count($rows) - 1; $i++) {


            if ($rows[$i] == '') {
                continue;
            }


            $s = explode(',', str_replace('<br>', '', $rows[$i]));

            $bulk[] = [
                'vehicle_id' => $s[0],
                'inhouse_seller_id' => $s[1],
                'buyer_id' => $s[2],
                'model_id' => $s[3],
                'sale_date' => $s[4],
                'buy_date' => $s[5],
            ];

        }

        \DB::table('junior_practical')->insert($bulk);
    }

    public function mapBuyers()
    {
        $buyers = \DB::table('junior_practical')->distinct()->get(['buyer_id']);
        $faker = Factory::create();

        $bulk = [];

        foreach($buyers as $buyer) {

            $bulk[] = [
                'id' => $buyer->buyer_id,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
            ];
        }

        \DB::table('buyers')->insert($bulk);

    }


}