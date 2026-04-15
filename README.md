# 🩺 VitaGuard – Web-Based Health Service Platform

## 📌 Deskripsi Proyek

**VitaGuard** adalah aplikasi berbasis web yang dikembangkan menggunakan framework **Laravel** untuk menyediakan layanan kesehatan digital bagi masyarakat. Platform ini memungkinkan pengguna untuk mengakses informasi kesehatan, melakukan konsultasi dengan dokter, serta melakukan pemesanan jadwal konsultasi secara online.

Aplikasi ini dirancang untuk meningkatkan aksesibilitas layanan kesehatan dengan memanfaatkan teknologi digital.

---

## 👥 Jenis Pengguna

Sistem VitaGuard memiliki tiga jenis pengguna utama:

### 1. Admin

* Mengelola seluruh data sistem
* Mengelola dokter, member, dan artikel
* Memantau aktivitas konsultasi

### 2. Dokter

* Menyediakan layanan konsultasi
* Mengelola jadwal konsultasi
* Berinteraksi dengan member melalui fitur chat

### 3. Member

* Membaca artikel kesehatan
* Melakukan konsultasi online
* Booking jadwal konsultasi
* Melihat riwayat konsultasi

---

## 🚀 Fitur Utama

### 🔐 1. Manajemen Pengguna

* Role-based access (Admin, Dokter, Member)
* Autentikasi dan otorisasi pengguna

### 📚 2. Artikel Kesehatan

* Menampilkan artikel edukasi kesehatan
* CRUD artikel oleh admin

### 👨‍⚕️ 3. Direktori Dokter

* Daftar dokter lengkap dengan profil
* Informasi spesialisasi dan pengalaman

### 💬 4. Konsultasi Online

* Chat antara member dan dokter
* Real-time atau asynchronous messaging

### 📅 5. Booking Konsultasi

* Pemesanan jadwal berdasarkan ketersediaan dokter
* Manajemen slot waktu

### 🕒 6. Riwayat Konsultasi

* Penyimpanan histori konsultasi
* Akses riwayat oleh member

### 📊 7. Dashboard Admin

* Monitoring data pengguna
* Statistik konsultasi
* Manajemen sistem secara keseluruhan

---

## 🛠️ Teknologi yang Digunakan

* **Backend**: Laravel
* **Frontend**: Blade / HTML / CSS / JavaScript
* **Database**: MySQL
* **Authentication**: Laravel Auth / Breeze / Sanctum (opsional)

---

## ⚙️ Instalasi & Setup

### 1. Clone Repository

```bash
git clone https://github.com/username/vitaguard.git
cd vitaguard
```

### 2. Install Dependency

```bash
composer install
npm install
```

### 3. Konfigurasi Environment

```bash
cp .env.example .env
php artisan key:generate
```

Atur konfigurasi database di file `.env`:

```
DB_DATABASE=vitaguard
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Migrasi dan Seed Database

```bash
php artisan migrate
php artisan db:seed
```

### 5. Jalankan Server

```bash
php artisan serve
```

Akses aplikasi di:

```
http://127.0.0.1:8000
```

---

## 🗂️ Struktur Fitur (Sederhana)

* `/app/Models` → Model database
* `/app/Http/Controllers` → Logic aplikasi
* `/resources/views` → Tampilan (Blade)
* `/routes/web.php` → Routing aplikasi

---

## 📌 Use Case Utama

* Member mencari dokter → Booking → Konsultasi
* Dokter menerima konsultasi → Memberi respon
* Admin mengelola seluruh sistem

---


## 👨‍💻 Kontributor

* Nama: AKU RAJA RIMBA
* Mata Kuliah: Web Framework Programming (WFP)

---

## 📄 Lisensi

Project ini dibuat untuk keperluan akademik.
