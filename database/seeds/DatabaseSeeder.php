<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(AddressSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SubscribeSeeder::class);
        $this->call(RegionSeeder::class);

        // factory(App\Models\Order::class, 100)->create();
        // factory(App\Models\Address::class, 2)->create();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
