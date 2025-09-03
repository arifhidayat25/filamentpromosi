-----
\<h1\>Sistem Manajemen Proposal Promosi Mahasiswa\</h1\>
\<p\>
Sebuah aplikasi web canggih untuk mengelola alur pengajuan proposal promosi mahasiswa, dari pembuatan hingga penerbitan sertifikat digital. Dibangun dengan cinta menggunakan \<strong\>Laravel & Filament PHP\</strong\>.
\</p\>
\<p\>
\<a href="\#fitur-utama-sparkles"\>Fitur Utama\</a\> •
\<a href="\#alur-kerja--flow\_chart"\>Alur Kerja\</a\> •
\<a href="\#stack-teknologi-computer"\>Stack Teknologi\</a\> •
\<a href="\#panduan-instalasi-rocket"\>Instalasi\</a\> •
\<a href="\#akun-demo-key"\>Akun Demo\</a\>
\</p\>
\</div\>

## Fitur Utama ✨

Sistem ini dirancang dengan arsitektur **Multi-Panel** yang aman dan intuitif, memisahkan dunia **Admin** dan **Mahasiswa** secara total.

### Panel Admin (`/admin`) - Pusat Kendali 🧠

  * **Dashboard Visual**: Pantau tren pengajuan proposal secara *real-time* melalui grafik interaktif berdasarkan bulan dan program studi.
  * **Manajemen Peran Fleksibel**: Atur hak akses mendetail untuk peran **Admin**, **Staff**, dan **Pembina** menggunakan `FilamentShield`.
  * **Alur Persetujuan Bertingkat**: Kelola proposal dari status "Diajukan" hingga "Selesai" dengan validasi dari Pembina dan Staff.
  * **Arsip & Ekspor Data**: Semua proposal yang selesai secara otomatis diarsipkan dan seluruh data dapat diekspor ke Excel.
  * **Audit Trail**: Lacak setiap perubahan data penting melalui log aktivitas yang komprehensif.
  * **"Login As"**: Fitur *debugging* yang memungkinkan admin masuk sebagai pengguna lain (hanya di lingkungan lokal).

### Panel Mahasiswa (`/student`) - Ruang Kerja Pribadi 🧑‍🎓

  * **Dashboard Personal**: Lihat ringkasan statistik proposal, status laporan, dan notifikasi pembayaran *fee* dalam satu layar.
  * **Pengajuan Proposal Mandiri**: Buat dan kirim proposal promosi dengan mudah, di mana dosen pembina ditetapkan secara otomatis berdasarkan program studi.
  * **Pelaporan Kegiatan**: Setelah proposal disetujui, mahasiswa dapat langsung mengirimkan laporan kegiatan promosi.
  * **Sertifikat Digital**: Unduh sertifikat partisipasi dalam format PDF yang digenerasi secara otomatis setelah semua proses selesai.
  * **API Token**: Hasilkan token API pribadi untuk mengakses data dari aplikasi pihak ketiga (misalnya aplikasi *mobile*) dengan aman menggunakan Laravel Sanctum.

-----

## Alur Kerja  flowchart

Sistem ini memfasilitasi alur kerja yang jelas dan terstruktur, memastikan setiap tahapan terdokumentasi dengan baik.

1.  **Pengajuan**: Mahasiswa membuat proposal melalui Panel Mahasiswa.
2.  **Validasi Pembina**: Dosen Pembina menerima proposal dan melakukan validasi (Setuju/Tolak).
3.  **Pelaksanaan & Laporan**: Mahasiswa melaksanakan kegiatan dan mengirimkan laporan melalui panel.
4.  **Verifikasi Staff**: Staff memverifikasi laporan. Jika valid, status proposal diubah menjadi "Menunggu Pembayaran".
5.  **Pembayaran Fee**: Staff memproses pembayaran *fee* promosi untuk mahasiswa.
6.  **Selesai & Sertifikat**: Setelah pembayaran lunas, status proposal menjadi "Selesai" dan mahasiswa dapat mengunduh sertifikat digital.

-----

## Stack Teknologi 💻

Aplikasi ini dibangun menggunakan ekosistem Laravel modern yang andal dan skalabel.

| Komponen            | Teknologi                                                                                                                                                                                                                                                                 |
| ------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **Framework** | Laravel 10                                                                                                                                                                                                                                           |
| **Panel Admin** | Filament PHP v3                                                                                                                                                                                                       |
| **Frontend** | Livewire & Alpine.js (TALL Stack)                                                                                                                                                                                                                                         |
| **Database** | MySQL (dapat disesuaikan)                                                                                                                                                                                                                       |
| **Caching** | **Redis** (untuk performa optimal pada *cache* aplikasi dan hak akses)                                                                                                                                                        |
| **Manajemen Peran** | `spatie/laravel-permission` & `bezhanSalleh/filament-shield`                                                                                                                                                       |
| **Penyimpanan File**| MinIO (S3 Compatible) untuk menyimpan sertifikat dan aset lainnya                                                                                                                                                                            |
| **API** | Laravel Sanctum untuk autentikasi API yang aman                                                                                                                                                                                                  |

-----

## Panduan Instalasi 🚀

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lingkungan pengembangan lokal Anda.

### 1\. Prasyarat

  - PHP 8.1+
  - Composer
  - Node.js & NPM
  - Database (misalnya MySQL)
  - **Server Redis**
  - Server MinIO (opsional, untuk fitur sertifikat)

### 2\. Kloning & Setup Awal

```bash
# 1. Kloning repositori
git clone https://github.com/username/nama-repositori.git
cd nama-repositori

# 2. Instal dependensi PHP & JS
composer install
npm install
npm run build

# 3. Buat file .env dan generate kunci aplikasi
cp .env.example .env
php artisan key:generate
```

### 3\. Konfigurasi Lingkungan (`.env`)

Buka file `.env` dan sesuaikan variabel berikut:

```env
# Konfigurasi Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=root
DB_PASSWORD=

# Konfigurasi Redis
REDIS_CLIENT=phpredis # atau predis
REDIS_HOST=127.0.0.1
REDIS_PORT=6379

# Konfigurasi MinIO/S3 (jika digunakan)
FILESYSTEM_DISK=minio
AWS_ACCESS_KEY_ID=minioadmin
AWS_SECRET_ACCESS_KEY=minioadmin
AWS_BUCKET=nama-bucket
AWS_ENDPOINT=http://localhost:9000
AWS_USE_PATH_STYLE_ENDPOINT=true
```

> **Penting**: Aplikasi ini memerlukan **klien Redis** untuk PHP. Pilih salah satu:
>
>   * **`phpredis` (Direkomendasikan)**: Instal ekstensi PECL `redis` dan aktifkan di `php.ini`.
>   * **`predis`**: Jalankan `composer require predis/predis` dan atur `REDIS_CLIENT=predis` di `.env`.

### 4\. Migrasi & Seeding Database

Perintah ini akan membuat semua tabel dan mengisi data awal seperti peran (*roles*) dan hak akses (*permissions*).

```bash
php artisan migrate --seed
```

### 5\. Buat Pengguna Admin Pertama

```bash
php artisan make:filament-user
```

Ikuti petunjuk untuk membuat akun yang akan Anda gunakan untuk login pertama kali.

### 6\. Jalankan Aplikasi

```bash
php artisan serve
```

🎉 **Selesai\!** Aplikasi Anda sekarang dapat diakses:

  - **Panel Admin**: `http://localhost:8000/admin`
  - **Panel Mahasiswa**: `http://localhost:8000/student`

-----

## Akun Demo 🔑

Setelah menjalankan `php artisan migrate --seed`, Anda dapat menggunakan akun berikut untuk mencoba sistem:

  - **Admin**:
      - Email: `admin@example.com`
      - Password: `password`
  - **Mahasiswa**:
      - Email: `student@example.com`
      - Password: `password`
