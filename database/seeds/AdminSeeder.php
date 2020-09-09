<?php

use App\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'name' => 'Item A',
                'email' => 'admin@test.com',
                'password' => bcrypt('12345678'),
                'type' => 'admin'
            ]
        ];

        foreach ($items as $item) {
            User::create($item);
        }
    }
}
