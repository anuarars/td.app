<?php

use App\Models\Address;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Address::truncate();

        Address::create([
            'user_id'=>'11',
            'region_id' => '1',
            'district' => 'Есильский Район',
            'town' => 'Астана',
            'home' => '20',
            'street' => 'Орынбор',
            'unit' => '115',
            'postcode' => '010000'
        ]);
    }
}
