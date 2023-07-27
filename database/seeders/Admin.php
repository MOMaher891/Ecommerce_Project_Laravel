<?php

namespace Database\Seeders;

use App\Models\Admin as ModelsAdmin;
use Illuminate\Database\Seeder;

class Admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsAdmin::create([
            'name'=>'Admin',
            'email'=>'admin@admin.com',
            'password'=>'$2y$10$sH3OUyNGn1JPqb7eiUVPQew2tYQAgYDUHGqdnTbPTldyyp6D19TBe'
            //Another Method to set password hashed --> bcrypt('password')
        ]);
    }
}
