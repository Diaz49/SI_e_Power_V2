<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Projectid;
use App\Models\User;
use App\Models\DataClient;
use App\Models\Bank;
use App\Models\PT;
use App\Models\DataVendor;
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
        
        $pts = [
            ['nama_pt' => 'Multi Power Abadi', 'kode_pt' => 'MPA'],
            ['nama_pt' => 'Rajata Wedding', 'kode_pt' => 'RJT'],
            ['nama_pt' => 'Ramada Event Organizer', 'kode_pt' => 'REO'],
            ['nama_pt' => 'Naismedia', 'kode_pt' => 'NM'],
            ['nama_pt' => 'MARK', 'kode_pt' => 'MARK'],
            ['nama_pt' => 'Multi Creation', 'kode_pt' => 'MC'],
        ];
    
        foreach ($pts as $index => $pt) {
            PT::create([
                'nama_pt' => $pt['nama_pt'],
                'kode_pt' => $pt['kode_pt'],
            ]);
        }
        // Seeder for Bank
        foreach (['BRI', 'BNI', 'Mandiri', 'BCA', 'CIMB Niaga', 'Danamon', 'Permata', 'Maybank', 'Panin', 'Mega'] as $index => $bankName) {
            Bank::create([
                'nama_bank' => $bankName,
                'nama_rek' => "Rekening $bankName",
                'nomer_rek' => '123456789' . ($index + 1),
                'status' => $index % 2 == 0 ? 'use' : 'no_use',
            ]);
        }
        
        // Seeder for DataClient
        $clients = [
            ['nama_client' => 'PT Sumber Sejahtera', 'alamat' => 'Jl. Sudirman No. 12, Jakarta', 'kota' => 'Jakarta'],
            ['nama_client' => 'CV Makmur Sentosa', 'alamat' => 'Jl. Diponegoro No. 45, Surabaya', 'kota' => 'Surabaya'],
            ['nama_client' => 'PT Karya Abadi', 'alamat' => 'Jl. Slamet Riyadi No. 30, Solo', 'kota' => 'Solo'],
            ['nama_client' => 'CV Jaya Mandiri', 'alamat' => 'Jl. Ahmad Yani No. 18, Bandung', 'kota' => 'Bandung'],
            ['nama_client' => 'PT Sinar Gemilang', 'alamat' => 'Jl. Pemuda No. 25, Semarang', 'kota' => 'Semarang'],
            ['nama_client' => 'CV Cahaya Terang', 'alamat' => 'Jl. Veteran No. 8, Medan', 'kota' => 'Medan'],
            ['nama_client' => 'PT Mitra Harmoni', 'alamat' => 'Jl. Asia Afrika No. 10, Jakarta', 'kota' => 'Jakarta'],
            ['nama_client' => 'CV Bintang Timur', 'alamat' => 'Jl. Merdeka No. 77, Yogyakarta', 'kota' => 'Yogyakarta'],
            ['nama_client' => 'PT Delta Utama', 'alamat' => 'Jl. Imam Bonjol No. 99, Malang', 'kota' => 'Malang'],
            ['nama_client' => 'CV Prima Jaya', 'alamat' => 'Jl. Gatot Subroto No. 5, Bali', 'kota' => 'Bali'],
        ];

        foreach ($clients as $index => $client) {
            // Mengambil pt_id secara acak dari tabel PT
            $pt = PT::inRandomOrder()->first(); // Mengambil 1 data PT secara acak
        
            DataClient::create([
                'nama_client' => $client['nama_client'],
                'alamat' => $client['alamat'],
                'up_invoice' => "UP Invoice $index",
                'up_sph' => "UP SPH $index",
                'pt_id' => $pt ? $pt->id : null, // Jika ditemukan PT, gunakan ID PT tersebut
            ]);
        }

        // Seeder for DataVendor
        $vendors = [
            ['nama_vendor' => 'PT Indo Teknik', 'alamat_vendor' => 'Jl. Mangga Besar No. 14, Jakarta', 'kota' => 'Jakarta'],
            ['nama_vendor' => 'CV Multi Karya', 'alamat_vendor' => 'Jl. Kenari No. 23, Surabaya', 'kota' => 'Surabaya'],
            ['nama_vendor' => 'PT Adi Jaya', 'alamat_vendor' => 'Jl. Gajah Mada No. 31, Bandung', 'kota' => 'Bandung'],
            ['nama_vendor' => 'CV Sejahtera Abadi', 'alamat_vendor' => 'Jl. Pattimura No. 11, Semarang', 'kota' => 'Semarang'],
            ['nama_vendor' => 'PT Mega Teknik', 'alamat_vendor' => 'Jl. Kusuma Bangsa No. 40, Solo', 'kota' => 'Solo'],
            ['nama_vendor' => 'CV Mandiri Persada', 'alamat_vendor' => 'Jl. Sudirman No. 9, Medan', 'kota' => 'Medan'],
            ['nama_vendor' => 'PT Global Sukses', 'alamat_vendor' => 'Jl. Pemuda No. 15, Jakarta', 'kota' => 'Jakarta'],
            ['nama_vendor' => 'CV Anugerah Jaya', 'alamat_vendor' => 'Jl. Kartini No. 7, Bali', 'kota' => 'Bali'],
            ['nama_vendor' => 'PT Cipta Mandiri', 'alamat_vendor' => 'Jl. Diponegoro No. 22, Yogyakarta', 'kota' => 'Yogyakarta'],
            ['nama_vendor' => 'CV Terang Abadi', 'alamat_vendor' => 'Jl. Imam Bonjol No. 33, Malang', 'kota' => 'Malang'],
        ];

        foreach ($vendors as $index => $vendor) {
            DataVendor::create([
                'nama_vendor' => $vendor['nama_vendor'],
                'alamat_vendor' => $vendor['alamat_vendor'],
                'kota' => $vendor['kota'],
                'no_tlp' => "0812345678$index",
                'email' => "vendor$index@example.com",
                'up' => "UP Vendor $index",
            ]);
        }

        // Seeder for Projectid
        foreach (range(1, 10) as $index) {
            Projectid::create([
                'project_id' => $index,
                'nama_project' => "Project $index",
                'nama_client' => "Client $index",
                'alamat' => "Alamat Project $index",
                'hpp' => rand(1000000, 5000000),
                'rab' => rand(5000000, 10000000),
            ]);
        }


    }
}
