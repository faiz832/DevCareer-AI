<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $ownerRole = Role::create([
            'name' => 'owner'
        ]);

        $teacherRole = Role::create([
            'name' => 'teacher'
        ]);

        $studentRole = Role::create([
            'name' => 'student'
        ]);

        $userOwner = User::create([
            'name' => 'admin',
            'avatar' => 'images/default-avatar.png',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password')
        ]);

        $userOwner->assignRole($ownerRole);

        $userTeacher = User::create([
            'name' => 'teacher',
            'avatar' => 'images/default-avatar.png',
            'email' => 'teacher@gmail.com',
            'password' => bcrypt('password')
        ]);

        $userTeacher->assignRole($teacherRole);

        $userStudent = User::create([
            'name' => 'student',
            'avatar' => 'images/default-avatar.png',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password')
        ]);

        $userStudent->assignRole($studentRole);
    }
}
