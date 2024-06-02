# Sistem Manajemen Sumber Daya Manusia

Ini adalah aplikasi web untuk mengelola sumber daya manusia di suatu perusahaan. Itu dibangun menggunakan Laravel 8.
<br>
<br>
Lamaran tersebut merupakan persyaratan untuk studi "On the Job Training" kuliah saya di perusahaan tempat saya bekerja.

## Langkah-langkah untuk menjalankan aplikasi ini:

1. Klik tombol `<> Kode`
2. Salin tautan repositori HTTPS/SSH
3. Jalankan perintah `git clone` di terminal Anda.
4. Instal dependensi yang diperlukan dengan menjalankan `composer install`
5. Membuat file .env dengan `cp .env.example .env` dan mengisi kolom yang diperlukan, misalnya: koneksi database, dll.
6. Hasilkan kunci aplikasi dengan menjalankan `php artisan key:generate`
7. Selanjutnya jalankan migrasi database dengan perintah `php artisanmigrate` ini.
8. Anda dapat melakukan seeding database dengan perintah `php artisan db:seed`.
9. Terakhir, sajikan aplikasi dengan perintah `php artisan serve` ini.
10. Aplikasi HRMS harus dapat diakses di browser Anda di "http://localhost:8000"

### Kredensial Masuk

Anda dapat masuk ke aplikasi dengan kredensial ini (jika Anda melakukan penyemaian basis data).

- Nama pengguna: `admin@gmail.com`
- Kata sandi: `admin`

## Tangkapan layar

**Tampilan depan**
![Layar Utama](./documentation-images/Home.png)

**Layar Dasbor**
![Layar Dasbor](./documentation-images/Dashboard.png)

**Layar Daftar Karyawan**
![Layar Daftar Karyawan](./documentation-images/Employee%20List.png)

**Karyawan Meninggalkan Layar**
![Layar Cuti Karyawan](./documentation-images/Employees%20Leaves.png)

**Layar Kehadiran**
![Layar Kehadiran](./documentation-images/Attendances.png)

**Layar Rekrutmen**
![Layar Rekrutmen](./documentation-images/Recruitment.png)

**Layar Detail Rekrutmen**
![Layar Detail Rekrutmen](./documentation-images/Recruitment%20Detail.png)
