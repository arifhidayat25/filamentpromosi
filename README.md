Tentu, setelah mempelajari semua file dan alur sistem yang Anda berikan, berikut adalah draf dokumentasi komprehensif yang siap untuk Anda salin dan tempel ke dalam file `README.md` di repositori GitHub Anda.

-----

# Sistem Manajemen Proposal Promosi Mahasiswa

Sistem ini adalah aplikasi web berbasis Laravel yang dirancang untuk mengelola alur pengajuan proposal promosi oleh mahasiswa ke berbagai sekolah. Aplikasi ini dibangun menggunakan framework TALL Stack, dengan **Filament PHP** sebagai panel admin utamanya.

Aplikasi ini memiliki dua panel yang terpisah untuk membedakan hak akses dan fungsionalitas:

1.  **Panel Admin (`/admin`)**: Diperuntukkan bagi pengguna dengan peran **Admin**, **Staff**, dan **Pembina**.
2.  **Panel Mahasiswa (`/student`)**: Diperuntukkan bagi pengguna dengan peran **Mahasiswa**.

## Fitur Utama

### 1\. Sistem Multi-Panel dengan Hak Akses Berbasis Peran

  - **Pemisahan Akses**: Pengguna secara otomatis diarahkan ke panel yang sesuai berdasarkan peran mereka saat login. Mahasiswa tidak dapat mengakses panel admin, dan sebaliknya.
  - **Manajemen Peran & Hak Akses**: Dikelola menggunakan `spatie/laravel-permission` dan terintegrasi dengan `BezhanSalleh/FilamentShield` untuk kontrol yang mendalam.
  - **Tiga Peran Admin**:
      - **Admin**: Akses penuh ke seluruh sistem, termasuk manajemen pengguna, peran, dan semua data.
      - **Staff**: Dapat memverifikasi laporan yang diajukan mahasiswa dan memproses pembayaran.
      - **Pembina**: Hanya dapat melihat dan menyetujui/menolak proposal dari mahasiswa yang berada di bawah program studinya.

### 2\. Alur Kerja Proposal (End-to-End)

  - **Pengajuan oleh Mahasiswa**: Mahasiswa dapat membuat proposal, memilih sekolah tujuan, dan secara otomatis akan ditetapkan dosen pembina berdasarkan program studinya.
  - **Persetujuan oleh Pembina**: Pembina menerima notifikasi dan dapat menyetujui atau menolak proposal yang masuk.
  - **Pelaporan oleh Mahasiswa**: Setelah proposal disetujui, mahasiswa dapat *mengirimkan* laporan kegiatan.
  - **Verifikasi oleh Staff**: Staff memeriksa laporan yang masuk dan menyetujuinya, yang kemudian memicu proses pembayaran *fee*.
  - **Manajemen Pembayaran**: Staff dapat mengelola dan mencatat pembayaran *fee* untuk mahasiswa.
  - **Penerbitan Sertifikat**: Setelah semua proses selesai dan pembayaran lunas, sistem dapat menghasilkan sertifikat PDF secara otomatis untuk mahasiswa, yang dapat diunduh.

### 3\. Panel Mahasiswa yang Interaktif

  - **Dashboard Informatif**: Menampilkan ringkasan statistik total pengajuan, proposal yang disetujui, ditolak, serta status pembayaran *fee*.
  - **Manajemen Mandiri**: Mahasiswa dapat mengelola proposal, laporan, melihat riwayat pembayaran, dan memperbarui data sekolah.
  - **Manajemen API Token**: Mahasiswa dapat membuat dan mengelola API token untuk mengakses data mereka dari aplikasi eksternal.

### 4\. Panel Admin yang Kuat

  - **Visualisasi Data**: Dashboard admin dilengkapi dengan grafik tren pengajuan proposal per bulan dan berdasarkan program studi.
  - **Manajemen Data Master**: CRUD (Create, Read, Update, Delete) untuk semua entitas penting seperti Pengguna, Sekolah, Program Studi, dan lainnya.
  - **Fitur "Login As"**: Admin dapat masuk sebagai pengguna lain untuk tujuan *debugging* atau bantuan (hanya aktif di lingkungan lokal).
  - **Arsip & Ekspor**: Proposal yang telah selesai akan diarsipkan dan seluruh data dapat diekspor ke format Excel.
  - **Log Aktivitas**: Setiap perubahan data penting dicatat oleh sistem untuk keperluan audit.

### 5\. API RESTful

  - Aplikasi menyediakan *endpoint* API untuk memungkinkan aplikasi eksternal (misalnya aplikasi *mobile*) berinteraksi dengan data pengguna, seperti mengambil daftar proposal, laporan, dan status pembayaran.
  - Autentikasi API menggunakan Laravel Sanctum.

## Stack Teknologi

  - **Framework**: Laravel
  - **Panel Admin**: Filament PHP v3
  - **Frontend**: Livewire & Alpine.js (TALL Stack)
  - **Database**: MySQL (dapat disesuaikan di `config/database.php`)
  - **Manajemen Peran**: `spatie/laravel-permission`
  - **Penyimpanan File**: MinIO (S3 Compatible) untuk menyimpan sertifikat dan dokumen lainnya
  - **Log Aktivitas**: `spatie/laravel-activitylog`

## Panduan Instalasi

Berikut adalah langkah-langkah untuk menjalankan proyek ini di lingkungan lokal Anda.

### 1\. Prasyarat

  - PHP 8.1+
  - Composer
  - Node.js & NPM
  - Database (MySQL direkomendasikan)
  - Server MinIO atau layanan S3-compatible lainnya (opsional, untuk fitur sertifikat)

### 2\. Kloning Repositori

```bash
git clone https://github.com/username/nama-repositori.git
cd nama-repositori
```

### 3\. Instalasi Dependensi

```bash
composer install
npm install
npm run build
```

### 4\. Konfigurasi Lingkungan

  - Salin file `.env.example` menjadi `.env`.
    ```bash
    cp .env.example .env
    ```
  - Buat kunci aplikasi baru.
    ```bash
    php artisan key:generate
    ```
  - Konfigurasikan koneksi database Anda di dalam file `.env`.
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database
    DB_USERNAME=root
    DB_PASSWORD=
    ```
  - (Opsional) Jika Anda menggunakan MinIO untuk penyimpanan file, konfigurasikan kredensial S3.
    ```
    FILESYSTEM_DISK=minio
    AWS_ACCESS_KEY_ID=minioadmin
    AWS_SECRET_ACCESS_KEY=minioadmin
    AWS_DEFAULT_REGION=us-east-1
    AWS_BUCKET=nama-bucket
    AWS_ENDPOINT=http://localhost:9000
    AWS_USE_PATH_STYLE_ENDPOINT=true
    ```

### 5\. Migrasi dan Seeding Database

Jalankan migrasi untuk membuat semua tabel yang diperlukan. Kemudian, jalankan *seeder* untuk mengisi data awal seperti peran (*roles*), hak akses (*permissions*), dan pengguna admin.

```bash
php artisan migrate --seed
```

### 6\. Buat Pengguna Admin

Filament memerlukan pengguna awal untuk bisa login ke panel admin. Jalankan perintah berikut dan ikuti instruksinya.

```bash
php artisan make:filament-user
```

Pastikan untuk memberikan peran **admin** kepada pengguna ini saat proses *seeding* atau secara manual di database.

### 7\. Jalankan Server Pengembangan

```bash
php artisan serve
```

Aplikasi Anda sekarang berjalan dan dapat diakses:

  - **Panel Admin**: `http://localhost:8000/admin`
  - **Panel Mahasiswa**: `http://localhost:8000/student`

Selamat\! Sistem siap untuk digunakan.
