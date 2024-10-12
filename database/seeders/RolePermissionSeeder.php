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
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password')
        ]);

        $userOwner->assignRole($ownerRole);

        $userTeacher = User::create([
            'name' => 'teacher',
            'email' => 'teacher@gmail.com',
            'password' => bcrypt('password')
        ]);

        $userTeacher->assignRole($teacherRole);

        \App\Models\Teacher::create([
            'user_id' => $userTeacher->id,
            'is_active' => true,
        ]);

        $userStudent = User::create([
            'name' => 'student',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password')
        ]);

        $userStudent->assignRole($studentRole);
    }
}
