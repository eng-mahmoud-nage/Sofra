<?php

use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\Environment\Console;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Traits\HasRoles;

class UsersTableSeeder extends Seeder
{
    use HasRoles;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'owner',
            'email' => 'owner@Sofra.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('roles')->insert([
            'name' => 'owner',
            'guard_name' => 'web',
            'created_at' => now(),
            'updated_at' => now()
        ]);

            DB::table('permissions')->insert([
                'name' => 'show admins',
                'guard_name' => 'web',
                'routes' => 'admin.index',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::table('permissions')->insert([
                'name' => 'edit admin',
                'guard_name' => 'web',
                'routes' => 'admin.edit,admin.update',
                'created_at' => now(),
                'updated_at' => now()
            ]);

             DB::table('permissions')->insert([
                'name' => 'create admin',
                'guard_name' => 'web',
                'routes' => 'admin.create,admin.store',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::table('permissions')->insert([
                'name' => 'delete admin',
                'guard_name' => 'web',
                'routes' => 'admin.destroy',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        // $user = User::where('email', 'owner@Sofra.com')->get();
        // $user->givePermissionTo('show admins');
        // $permissions = Permission::get();
        // $user->givePermissionTo();
    }
}
