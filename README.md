📚 Laravel SIAKAD SMK

Sistem Informasi Akademik Digital (SIAKAD) berbasis Laravel untuk kebutuhan pengelolaan data siswa, guru, kelas, jurusan, dan berita sekolah pada tingkat SMK.

🚀 Fitur Utama

✅ Manajemen Data Siswa (CRUD)

✅ Manajemen Data Guru (CRUD)

✅ Manajemen Jurusan dan Kelas

✅ Pengelolaan Berita Sekolah

✅ Autentikasi Login

✅ Dashboard Admin

✅ Cetak Laporan Siswa dan Guru

📦 Cara Install & Menjalankan Proyek

🛠️ Persiapan

Pastikan Anda sudah menginstal:

PHP >= 8.1

Composer

MySQL / MariaDB

Node.js + npm (untuk Vite/frontend)

📦 Install Dependency

composer install
npm install

⚙️ Setup Environment

cp .env.example .env

Edit .env dan sesuaikan:

DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=

🔑 Generate App Key

php artisan key:generate

🛠️ Migrasi & Seeder

php artisan migrate
php artisan db:seed  # opsional jika disediakan

⚡ Jalankan Vite (jika pakai Laravel 10/11)

npm run dev

▶️ Jalankan Server Laravel

php artisan serve

Akses di: http://localhost:8000

