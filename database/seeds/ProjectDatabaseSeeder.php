<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProjectDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function randomNumber($length) {
        $result = '';

        for($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }

        return $result;
    }

    public function run()
    {
        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
        ]);

        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
        ]);

        DB::table('companies')->insert([
            'OIB' => $this->randomNumber(11),
            'name' => str_random(10),
            'address' => str_random(10),
            'user_id' => rand(1,3),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('companies')->insert([
            'OIB' => $this->randomNumber(11),
            'name' => str_random(10),
            'address' => str_random(10),
            'user_id' => rand(1,3),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('expenses')->insert([
            'type' => str_random(10),
            'name' => str_random(10),
            'date' => '2016-11-15',
            'amount' => rand(300,5000),
            'company_id' => rand(1,6),
            'user_id' => rand(1,3),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('expenses')->insert([
            'type' => str_random(10),
            'name' => str_random(10),
            'date' => '2016-10-17',
            'amount' => rand(300,5000),
            'company_id' => rand(1,6),
            'user_id' => rand(1,3),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('invoices')->insert([
            'due_date' => '2016-11-15',
            'amount' => rand(300,5000),
            'company_id' => rand(1,6),
            'user_id' => rand(1,3),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('invoices')->insert([
            'due_date' => '2016-11-15',
            'amount' => rand(300,5000),
            'company_id' => rand(1,5),
            'user_id' => rand(9,16),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('invoices')->insert([
            'due_date' => '2016-11-15',
            'amount' => rand(300,5000),
            'company_id' => rand(1,6),
            'user_id' => rand(1,3),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);


    }
}
