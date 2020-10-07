<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
          'role_id'   => '1',
          'name'      => 'Mr. Admin',
          'username'  => 'admin',
          'email'     => 'admin@gmail.com',
          'nid'     => '1016227190',
          'contact'     => '01670605075',
          'created_at' => '2020-09-18 13:20:14',
          'updated_at' => '2020-09-18 13:20:14',
          'password'  => bcrypt('11223344'),
        ]);

    DB::table('users')->insert([
          'role_id'   => '2',
          'name'      => 'Mr. Landlord',
          'username'  => 'landlord',
          'email'     => 'landlord@gmail.com',
          'nid'     => '1016227150',
          'contact'     => '01970605076',
          'created_at' => '2020-09-18 13:20:14',
          'updated_at' => '2020-09-18 13:20:14',
          'password'  => bcrypt('11223344'),
        ]);

        DB::table('users')->insert([
          'role_id'   => '3',
          'name'      => 'Mr. Renter',
          'username'  => 'renter',
          'email'     => 'renter@gmail.com',
          'nid'     => '1016227180',
          'contact'     => '01870605075',
          'created_at' => '2020-09-18 13:20:14',
          'updated_at' => '2020-09-18 13:20:14',
          'password'  => bcrypt('11223344'),
        ]);


    }
}
