<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        $clientRole = Role::where('name', 'client')->first();
        $workerRole = Role::where('name', 'worker')->first();
        $adminRole = Role::where('name', 'admin')->first();

        $client = User::create([
            'name' => 'client',
            'email' => 'client@client.com',
            'email_verified_at' => '2020-07-04 16:35:06',
            'bin' => rand(100000000000, 999999999999),
            'phone' => '87054504505',
            'password' => Hash::make('12345678')
        ]);

        $client2 = User::create([
            'name' => 'client2',
            'email' => 'client2@client2.com',
            'email_verified_at' => '2020-07-04 16:35:06',
            'bin' => rand(100000000000, 999999999999),
            'phone' => '87054504505',
            'password' => Hash::make('12345678')
        ]);

        $client3 = User::create([
            'name' => 'client3',
            'email' => 'client3@client3.com',
            'email_verified_at' => '2020-07-04 16:35:06',
            'bin' => rand(100000000000, 999999999999),
            'phone' => '87054504505',
            'password' => Hash::make('12345678')
        ]);

        $client4 = User::create([
            'name' => 'client4',
            'email' => 'client4@client4.com',
            'email_verified_at' => '2020-07-04 16:35:06',
            'bin' => rand(100000000000, 999999999999),
            'phone' => '87054504505',
            'password' => Hash::make('12345678')
        ]);

        $client5 = User::create([
            'name' => 'client5',
            'email' => 'client5@client5.com',
            'email_verified_at' => '2020-07-04 16:35:06',
            'bin' => rand(100000000000, 999999999999),
            'phone' => '87054504505',
            'password' => Hash::make('12345678')
        ]);

        $worker = User::create([
            'name' => 'worker',
            'email' => 'worker@worker.com',
            'email_verified_at' => '2020-07-04 16:35:06',
            'bin' => rand(100000000000, 999999999999),
            'phone' => '87788711989',
            'password' => Hash::make('12345678')
        ]);

        $worker2 = User::create([
            'name' => 'worker2',
            'email' => 'worker2@worker2.com',
            'email_verified_at' => '2020-07-04 16:35:06',
            'bin' => rand(100000000000, 999999999999),
            'phone' => '87788711989',
            'password' => Hash::make('12345678')
        ]);

        $worker3 = User::create([
            'name' => 'worker3',
            'email' => 'worker3@worker3.com',
            'email_verified_at' => '2020-07-04 16:35:06',
            'bin' => rand(100000000000, 999999999999),
            'phone' => '87788711989',
            'password' => Hash::make('12345678')
        ]);

        $worker4 = User::create([
            'name' => 'worker4',
            'email' => 'worker4@worker4.com',
            'email_verified_at' => '2020-07-04 16:35:06',
            'bin' => rand(100000000000, 999999999999),
            'phone' => '87788711989',
            'password' => Hash::make('12345678')
        ]);

        $worker5 = User::create([
            'name' => 'worker5',
            'email' => 'worker5@worker5.com',
            'email_verified_at' => '2020-07-04 16:35:06',
            'bin' => rand(100000000000, 999999999999),
            'phone' => '87788711989',
            'password' => Hash::make('12345678')
        ]);

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => '2020-07-04 16:35:06',
            'bin' => rand(100000000000, 999999999999),
            'phone' => '87779202066',
            'password' => Hash::make('12345678')
        ]);

        $client->roles()->attach($clientRole);
        $client2->roles()->attach($clientRole);
        $client3->roles()->attach($clientRole);
        $client4->roles()->attach($clientRole);
        $client5->roles()->attach($clientRole);

        $worker->roles()->attach($workerRole);
        $worker2->roles()->attach($workerRole);
        $worker3->roles()->attach($workerRole);
        $worker4->roles()->attach($workerRole);
        $worker5->roles()->attach($workerRole);
        
        $admin->roles()->attach($adminRole);
    }
}
