<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Projectid;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

    // Projectid::create([
    //     'project_id' => 'FNB-00001',
    //     'nama_project' => 'test',
    //     'nama_client' => 'gua',
    //     'alamat' => 'sumenep',
    //     'hpp' => 19000,
    //     'rab' => 20000,
    // ]);

        User::create([
            'name' => 'LALALALALA',
            'username' => 'admin',
            'password' => Hash::make('123')
        ]);
    }
}
