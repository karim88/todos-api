<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
                'name' => 'Karim Oulad Chalha',
                'email' => 'karim@karimoc.me',
                'password' => 'toortoor00'
            ],
            [
                'name' => 'Adil Rebah',
                'email' => 'adil.rebah@avaliance.com',
                'password' => 'toortoor00'
            ],
        ];
        \DB::table('users')->delete();
        foreach ($data as $obj) {
            \App\User::create(array(
                'name' => $obj['name'],
                'email' => $obj['email'],
                'password' => bcrypt($obj['password']),
            ));
        }
    }
}
