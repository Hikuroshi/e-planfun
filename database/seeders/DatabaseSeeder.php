<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create([
            'nama' => 'SUBBAG TU RUNGGA',
            'slug' => 'subbag-tu-rungga',
            'aksi' => 'Operator'
        ]);
        Role::create([
            'nama' => 'SUBAG HUMAS PROTOKOL',
            'slug' => 'subag-humas-protokol',
            'aksi' => 'Operator'
        ]);
        Role::create([
            'nama' => 'KASUBAG PERENCANAAN',
            'slug' => 'kasubag-perencanaan',
            'aksi' => 'Verifikator Daerah 1'
        ]);
        Role::create([
            'nama' => 'KEPALA KANTOR',
            'slug' => 'kepala-kantor',
            'aksi' => 'Verifikator Daerah 2'
        ]);
        Role::create([
            'nama' => 'PEJABAT PEMBUAT KOMITMEN',
            'slug' => 'pejabat-pembuat-komitmen',
            'aksi' => 'Verifikator Pusat'

        ]);
        Role::create([
            'nama' => 'KABAG PERENCANAAN',
            'slug' => 'kabag-perencanaan',
            'aksi' => 'Hasil Verifikasi'
        ]);
        Role::create([
            'nama' => 'SEKJEN',
            'slug' => 'sekjen',
            'aksi' => 'Pengesahan Usulan'
        ]);
        Role::create([
            'nama' => 'Super User',
            'slug' => 'super-user',
            'aksi' => 'Semua Hak Akses'
        ]);

        User::create([
            'nama' => 'Admin',
            'username' => 'operator1',
            'password' => bcrypt('admin'),
            'role_id' => 1
        ]);
        User::create([
            'nama' => 'Admin',
            'username' => 'operator2',
            'password' => bcrypt('admin'),
            'role_id' => 2
        ]);
        User::create([
            'nama' => 'Admin',
            'username' => 'verifikator1',
            'password' => bcrypt('admin'),
            'role_id' => 3
        ]);
        User::create([
            'nama' => 'Admin',
            'username' => 'verifikator2',
            'password' => bcrypt('admin'),
            'role_id' => 4
        ]);
        User::create([
            'nama' => 'Admin',
            'username' => 'verifikator3',
            'password' => bcrypt('admin'),
            'role_id' => 5
        ]);
        User::create([
            'nama' => 'Admin',
            'username' => 'verifikator4',
            'password' => bcrypt('admin'),
            'role_id' => 6
        ]);
        User::create([
            'nama' => 'Admin',
            'username' => 'verifikator5',
            'password' => bcrypt('admin'),
            'role_id' => 7
        ]);
        User::create([
            'nama' => 'Admin',
            'username' => 'superuser',
            'password' => bcrypt('admin'),
            'role_id' => 8
        ]);
    }
}
