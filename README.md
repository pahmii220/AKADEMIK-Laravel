📚 Laravel SIAKAD SMK
Sistem Informasi Akademik Digital (SIAKAD) berbasis Laravel untuk kebutuhan pengelolaan data siswa, guru, kelas, jurusan, dan berita sekolah pada tingkat SMK

🚀 Fitur Utama

✅ Manajemen Data Siswa (CRUD)

✅ Manajemen Data Guru (CRUD)

✅ Manajemen Jurusan dan Kelas

✅ Pengelolaan Berita Sekolah

✅ Autentikasi Login

✅ Dashboard Admin

✅ Cetak Laporan Siswa dan Guru

📦 Cara Install & Menjalankan Proyek

Pastikan Anda sudah menginstal:

PHP >= 8.1

Composer

MySQL / MariaDB

## 🚀 Cara Menjalankan

```bash
git clone https://github.com/pahmii220/AKADEMIK-Laravel.git
cd AKADEMIK-Laravel
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run dev
php artisan serve
