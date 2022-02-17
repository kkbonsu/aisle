<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Type;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
        	'name' => 'Admin', 
        	'email' => 'admin@aisle.com',
        	'password' => bcrypt('12345678')
        ]);
  
        $role = Role::create(['name' => 'Admin']);
   
        $permissions = Permission::pluck('id','id')->all();
  
        $role->syncPermissions($permissions);
   
        $user->assignRole([$role->id]);

        $category = Category::create(['name' => 'Rent']); //1
        $category1 = Category::create(['name' => 'Sale']); //2
        $category2 = Category::create(['name' => 'Lease']); //3

        $type = Type::create(['name' => 'House']); //1
        $type2 = Type::create(['name' => 'Apartment']); //2
        $type3 = Type::create(['name' => 'Office Space']); //3
        $type4 = Type::create(['name' => 'Warehouse']); //4
        $type5 = Type::create(['name' => 'Guest House']); //5
        $type6 = Type::create(['name' => 'Shop']); //6
    }
}
