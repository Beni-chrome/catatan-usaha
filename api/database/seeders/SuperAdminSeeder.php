<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('usaha')->insert([
            'nama_usaha'     => 'CATATAN USAHA',
            'nama_pemilik'   => 'Developer',
            'email'          => 'admin@catatanusaha.com',
            'password'       => Hash::make('superadmin123'),
            'telepon'        => '08123456789',
            'alamat'         => 'Indonesia',
            'logo'           => null,
            'warna_primer'   => '#8B4513',
            'warna_sekunder' => '#D2691E',
            'role'           => 'super_admin',
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
    }
}
