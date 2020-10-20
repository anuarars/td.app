<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();

        $categories = [
            [
                'id' => '1',
                'name' => 'Продукты',
                'parent_id' => '0'
            ],
            [
                'id' => '2',
                'name' => 'Спиртное',
                'parent_id' => '1'
            ],
            [
                'id' => '3',
                'name' => 'Овощи Фрукты',
                'parent_id' => '1'
            ],
            [
                'id' => '4',
                'name' => 'Мясные продкуты',
                'parent_id' => '1'
            ],
            [
                'id' => '5',
                'name' => 'Молочные продкуты',
                'parent_id' => '1'
            ],
            [
                'id' => '6',
                'name' => 'Крупы и Макаронные Изделия',
                'parent_id' => '1'
            ],
            [
                'id' => '7',
                'name' => 'Консервы',
                'parent_id' => '1'
            ],
            [
                'id' => '8',
                'name' => 'Кондитерские Изделия',
                'parent_id' => '1'
            ],
            [
                'id' => '9',
                'name' => 'Пром Товары',
                'parent_id' => '0'
            ],
            [
                'id' => '10',
                'name' => 'Мыломоющие изделия',
                'parent_id' => '9'
            ],
            [
                'id' => '11',
                'name' => 'Одежда и Обувь',
                'parent_id' => '9'
            ],
            [
                'id' => '12',
                'name' => 'Посуда',
                'parent_id' => '9'
            ],
            [
                'id' => '13',
                'name' => 'Текстиль',
                'parent_id' => '9'
            ],
            [
                'id' => '14',
                'name' => 'Туризм и отдых',
                'parent_id' => '9'
            ],
            [
                'id' => '15',
                'name' => 'Электротехника',
                'parent_id' => '0'
            ],
            [
                'id' => '16',
                'name' => 'Телефоны',
                'parent_id' => '15'
            ],
            [
                'id' => '17',
                'name' => 'Орг Техника',
                'parent_id' => '15'
            ],
            [
                'id' => '18',
                'name' => 'Аудио и Видео аппаратура',
                'parent_id' => '15'
            ],
            [
                'id' => '19',
                'name' => 'Аксессуары',
                'parent_id' => '15'
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
