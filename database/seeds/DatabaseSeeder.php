<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'permission_title' => 'Manage Users',
            'permission_slug' => 'manage_user',
            'permission_description' => 'Manage user data',
        ]);

        $manageUserPermissionId = DB::getPdo()->lastInsertId();

        DB::table('permissions')->insert([
            'permission_title' => 'Manage Data',
            'permission_slug' => 'manage_data',
            'permission_description' => 'Manage data',
        ]);

        $manageDataPermissionId = DB::getPdo()->lastInsertId();

        DB::table('permissions')->insert([
            'permission_title' => 'View Data',
            'permission_slug' => 'view_data',
            'permission_description' => 'View data',
        ]);

        $viewDataPermissionId = DB::getPdo()->lastInsertId();

        DB::table('roles')->insert([
            'role_title' => 'Super Admin',
            'role_slug' => 'super_admin',
        ]);

        $superAdminRoleId = DB::getPdo()->lastInsertId();

        DB::table('roles')->insert([
            'role_title' => 'User',
            'role_slug' => 'user',
        ]);

        $userRoleId = DB::getPdo()->lastInsertId();

        DB::table('permission_role')->insert([
            'role_id' => $superAdminRoleId,
            'permission_id' => $manageUserPermissionId,
        ]);

        DB::table('permission_role')->insert([
            'role_id' => $superAdminRoleId,
            'permission_id' => $manageDataPermissionId,
        ]);

        DB::table('permission_role')->insert([
            'role_id' => $superAdminRoleId,
            'permission_id' => $viewDataPermissionId,
        ]);

        DB::table('permission_role')->insert([
            'role_id' => $userRoleId,
            'permission_id' => $viewDataPermissionId,
        ]);

        DB::table('users')->insert([
            'first_name' => 'Ron',
            'last_name' => 'Royce',
            'email' => 'ruhruhroy@gmail.com',
            'password' => bcrypt('mcdoodle22'),
            'email_verified_at' => date("Y-m-d H:i:s"),
        ]);

        $userId = DB::getPdo()->lastInsertId();

        DB::table('role_user')->insert([
            'role_id' => $superAdminRoleId,
            'user_id' => $userId,
        ]);

    }
}
