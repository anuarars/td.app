<?php

use App\Models\Subscribe;
use Illuminate\Database\Seeder;

class SubscribeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subscribe::create([
            'name'          =>  'Посделочная',
            'description'   =>  'Оплата за каждую сделку',
            'price'         =>  '50',
        ]);

        Subscribe::create([
            'name'          =>  'Помесячная',
            'description'   =>  'Оплата за месяц',
            'price'         =>  '200',
            'integer'       =>  '1',
            'measure'       =>  'month'
        ]);

        Subscribe::create([
            'name'          =>  'Поквартальная',
            'description'   =>  'Оплата за квартал',
            'price'         =>  '500',
            'integer'       =>  '6',
            'measure'       =>  'months'
        ]);

        Subscribe::create([
            'name'          =>  'Годовая',
            'description'   =>  'Оплата за год',
            'price'         =>  '1200',
            'integer'       =>  '1',
            'measure'       =>  'year'
        ]);
    }
}
