<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ProgramStudi;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class AkademikSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk mengisi data Program Studi
     * dan membuat Dosen Pembina dengan nama asli untuk setiap prodi.
     */
    public function run(): void
    {
        // =================================================================
        // BAGIAN 1: MEMBUAT SEMUA PROGRAM STUDI
        // =================================================================
        $this->command->info('Membuat data Program Studi ITSK Soepraoen...');
        DB::table('program_studis')->delete();

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
            ProgramStudi::create($prodi);
        }
        $this->command->info('-> Data Program Studi berhasil dibuat.');

        // =================================================================
        // BAGIAN 2: MEMBUAT PEMBINA DENGAN NAMA ASLI UNTUK SETIAP PRODI
        // =================================================================
        $this->command->info('Membuat data Dosen Pembina untuk setiap Program Studi...');
        $rolePembina = Role::firstOrCreate(['name' => 'pembina']);

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
                    // Membuat email berdasarkan nama (contoh: budi.darmawan@kampus.test)
                    $email = strtolower(str_replace(['. ', ', '], '.', preg_replace('/, M\.Kom\.|, S\.Kom\.|, M\.T\.|, S\.Farm\.|, M\.Farm\.Klin\.|, S\.Ft\.|, M\.Fis\.|, S\.Keb\.|, Bd\.|, M\.Keb\.|, S\.Kep\.|, Ns\.|, M\.Kep\.|, Drg\.|, S\.Tr\.Kep\.An\.|, A\.Md\.Kep\.|, A\.Md\.Farm\.|, A\.Md\.Akup\.|, A\.Md\.RMIK\.|Dr\.|Apt\./', '', $nama))) . '@kampus.test';

                    $dosen = User::firstOrCreate(
                        ['email' => $email],
                        [
                            'name' => $nama,
                            'password' => bcrypt('password'),
                            'program_studi_id' => $prodi->id,
                        ]
                    );
                    $dosen->assignRole($rolePembina);
                }
            }
        }
        $this->command->info('-> Data Dosen Pembina berhasil dibuat.');
        $this->command->info('===================================================');
        $this->command->info('SEMUA DATA AWAL BERHASIL DIBUAT!');
        $this->command->info('===================================================');
    }
}