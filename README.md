# Demo Kelompok 8

Demo Tugas Presentasi Kelompok 8
Semester 3
Teknik Informatika
Universitas Multimedia Nusantara

# Instalasi

**PENTING !**
Ikuti langkah berikut untuk instalasi aplikasi website ini

### 1. Clone

- Download dan extract atau _clone_ folder website ke _Apache HTTP Server_ anda

### 2. Environment

- Duplikat file `env` dan rename menjadi `.env`
- Buka file `.env`
- Cari variabel `app.baseURL` dan ganti nilainya menjadi lokasi `public` di folder website anda
  ```env
  app.baseURL = 'http://localhost/demo-kelompok-8/public'
  ```
- Cari variabel berikut ini dan ganti nilainya sesuai informasi database anda
  ```
  database.default.hostname = localhost
  database.default.database = demo_kelompok_8
  database.default.username = root
  database.default.password =
  database.default.DBDriver = MySQLi
  ```

### 3. Composer

- Download dan install _Composer_ di https://getcomposer.org/download/
- Jika sudah, buka terminal misalnya _Command Prompt_ atau _PowerShell_ di Windows
- Arahkan ke folder website yang ada di _Apache HTTP Server_ anda
  ```
  cd /d C:\xampp\htdocs\demo-kelompok-8
  ```
- Install dependencies menggunakan _Composer_
  ```
  composer update
  ```

### 4. Migration

- Jalankan Apache HTTP Server dan MySQL
- Di terminal pada lokasi directory yang sama, buat database dan migrasi semua tabel
  ```
  php spark db:create demo_kelompok_8
  php spark migrate
  ```

### 5. Run

- Untuk menjalankan aplikasi website, buka browser dan arahkan URL ke `app.baseURL` yang ada di environment tadi
  ```
  http://localhost/demo-kelompok-8/public
  ```
