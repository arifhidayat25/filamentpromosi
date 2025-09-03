<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ProgramStudi;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str; // <-- Tambahkan ini

class AkademikSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk mengisi data awal aplikasi.
     */
    public function run(): void
    {
        // =================================================================
        // BAGIAN 1: MEMBUAT ROLE DASAR
        // =================================================================
        $this->command->info('Membuat role dasar (admin, staff, pembina, mahasiswa)...');
        $roles = ['admin', 'staff', 'pembina', 'mahasiswa'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
        }
        $this->command->info('-> Role berhasil dibuat.');

        // =================================================================
        // BAGIAN 2: MEMBUAT PROGRAM STUDI
        // =================================================================
        $this->command->info('Membuat data Program Studi...');
        $prodiData = [
            ['name' => 'S1 Informatika', 'kode' => 'IF'],
            ['name' => 'S1 Farmasi Klinis dan Komunitas', 'kode' => 'FKK'],
            ['name' => 'S1 Fisioterapi', 'kode' => 'FIS'],
            ['name' => 'S1 Kebidanan', 'kode' => 'BDN'],
            ['name' => 'S1 Keperawatan', 'kode' => 'KEP'],
            ['name' => 'S1 Kedokteran Gigi', 'kode' => 'KG'],
            ['name' => 'D4 Keperawatan Anestesiologi', 'kode' => 'ANS'],
            ['name' => 'D3 Keperawatan', 'kode' => 'D3KEP'],
            ['name' => 'D3 Farmasi', 'kode' => 'D3FAR'],
            ['name' => 'D3 Akupunktur', 'kode' => 'D3AKU'],
            ['name' => 'D3 Rekam Medis dan Informasi Kesehatan', 'kode' => 'RMIK'],
        ];

        foreach ($prodiData as $prodi) {
            // Gunakan updateOrCreate untuk mencegah duplikasi jika seeder dijalankan lagi
            ProgramStudi::updateOrCreate(['kode' => $prodi['kode']], ['name' => $prodi['name']]);
        }
        $this->command->info('-> Data Program Studi berhasil dibuat.');

        // =================================================================
        // BAGIAN 3: MEMBUAT PEMBINA UNTUK SETIAP PRODI
        // =================================================================
        $this->command->info('Membuat data Dosen Pembina...');
        $rolePembina = Role::where('name', 'pembina')->first();

        $pembinaData = [
            'IF' => ['Dr. Budi Darmawan, S.Kom., M.T.', 'Ayu Lestari, S.Kom., M.Cs.'],
            'FKK' => ['Apt. Diana Puspita, S.Farm., M.Farm.Klin.'],
            'FIS' => ['Andi Pratama, S.Ft., M.Fis.'],
            'BDN' => ['Fitria Anggraini, S.Keb., Bd., M.Keb.'],
            'KEP' => ['Ns. Hendra Wijaya, S.Kep., M.Kep.'],
            'KG' => ['Drg. Rina Amelia'],
            'ANS' => ['Sari Dewi, S.Tr.Kep.An.'],
            'D3KEP' => ['Ns. Agus Setiawan, A.Md.Kep.'],
            'D3FAR' => ['Rizki Ananda, A.Md.Farm.'],
            'D3AKU' => ['Suryo Nugroho, A.Md.Akup.'],
            'RMIK' => ['Eka Putri, A.Md.RMIK.'],
        ];

        foreach ($pembinaData as $kodeProdi => $namaPembinaList) {
            $prodi = ProgramStudi::where('kode', $kodeProdi)->first();
            if ($prodi) {
                foreach ($namaPembinaList as $nama) {
                    // Membuat email yang lebih bersih (contoh: budi.darmawan@kampus.test)
                    $email = Str::slug(explode(',', $nama)[0], '.') . '@kampus.test';

                    $dosen = User::updateOrCreate(
                        ['email' => $email],
                        [
                            'name' => $nama,
                            'password' => bcrypt('password'),
                            'program_studi_id' => $prodi->id,
                        ]
                    );
                    $dosen->syncRoles($rolePembina);
                }
            }
        }
        $this->command->info('-> Data Dosen Pembina berhasil dibuat.');
        
        // =================================================================
        // BAGIAN 4: MEMBUAT USER ADMIN, STAFF, DAN MAHASISWA CONTOH
        // =================================================================
        $this->command->info('Membuat user Admin, Staff, dan Mahasiswa contoh...');
        
        $admin = User::updateOrCreate(['email' => 'admin@kampus.test'], ['name' => 'Admin', 'password' => bcrypt('password')]);
        $admin->syncRoles('admin');

        $staff = User::updateOrCreate(['email' => 'staff@kampus.test'], ['name' => 'Staff Promosi Kampus', 'password' => bcrypt('password')]);
        $staff->syncRoles('staff');

        $prodiIf = ProgramStudi::where('kode', 'IF')->first();
        if ($prodiIf) {
            $mahasiswa = User::updateOrCreate(
                ['email' => 'mahasiswa@kampus.test'],
                ['name' => 'Mahasiswa Contoh', 'password' => bcrypt('password'), 'program_studi_id' => $prodiIf->id, 'nim' => '22510000']
            );
            $mahasiswa->syncRoles('mahasiswa');
        }
        $this->command->info('-> User Admin, Staff, dan Mahasiswa contoh berhasil dibuat.');


        $this->command->info('===================================================');
        $this->command->info('SEMUA DATA AWAL BERHASIL DIBUAT!');
        $this->command->info('===================================================');
    }
}