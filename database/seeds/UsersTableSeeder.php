<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    public function run()
    {

        for ($i = 1; $i < 21; $i++)
        {
          $random_date = [rand(2017, 2019), rand(1, 12), rand(1,31)];

          if(!checkdate($random_date[1], $random_date[2], $random_date[0])){
            $random_date = [rand(2017, 2019), rand(1, 12), 1];
          }

          DB::table('users')->insert([
              [
                  'email'              => $i.'wakabayashi@example.com',
                  'password'           => Hash::make('password'),
                  'role'               => 10,
                  'created_at'         => new DateTime($random_date[0].'-'.$random_date[1].'-'.$random_date[2]),
                  'updated_at'         => new DateTime($random_date[0].'-'.$random_date[1].'-'.$random_date[2]),
                  'token'              => str_random(15),
                  'email_verify_token' => str_random(15),
                  'status'             => 1,
              ],
          ]);
      }
      //テストユーザーの作成
      DB::table('users')->insert([
          [
              'email'              => 'test@test.com',
              'password'           => Hash::make('password'),
              'role'               => 10,
              'created_at'         => new DateTime(),
              'updated_at'         => new DateTime(),
              'token'              => str_random(15),
              'email_verify_token' => str_random(15),
              'status'             => 1,
          ],
      ]);
    }
}
