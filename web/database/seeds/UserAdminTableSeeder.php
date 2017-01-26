<?php

use Illuminate\Database\Seeder;

class UserAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('users')->insert([
    		'name' => 'admin',
    		'email' => 'admin@test.com.br',
    		'password' => bcrypt('admin123'),
    		'role_id' => 2, 
    		]);
    }
  }
