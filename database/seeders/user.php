<?php

namespace Database\Seeders;

use App\Models\User as ModelsUser;
use Illuminate\Database\Seeder;

class user extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    ModelsUser::create([
        'name'=>'Mohamed Maher',
        'email'=>'user@gmail.com',
        'password'=>'$2y$10$sH3OUyNGn1JPqb7eiUVPQew2tYQAgYDUHGqdnTbPTldyyp6D19TBe'
    ]);
    }
}
