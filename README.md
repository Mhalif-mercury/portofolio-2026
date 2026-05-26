# Portofolio

Aplikasi web portofolio modern yang dibangun dengan Laravel, Filament Admin Panel, dan Tailwind CSS. Proyek ini menampilkan portfolio personal dengan admin dashboard yang komprehensif untuk mengelola konten portofolio.

**Pembuat:** Muhamad Alif Mandani  
**NIM:** 20240803029

---

## Daftar Isi

- [Arsitektur Informasi](#arsitektur-informasi)
- [Panduan Instalasi](#panduan-instalasi)
- [Contoh Penggunaan](#contoh-penggunaan)
- [Panduan Kontribusi](#panduan-kontribusi)
- [Lisensi](#lisensi)

---

## Arsitektur Informasi

### Struktur Proyek

Aplikasi ini menggunakan struktur yang terorganisir berdasarkan Laravel framework dengan komponen-komponen berikut:

```
portofolio/
├── src/                      # Root aplikasi Laravel
│   ├── app/                  # Kode aplikasi utama
│   │   ├── Console/          # Artisan commands
│   │   ├── Filament/         # Konfigurasi Filament Admin Panel
│   │   ├── Http/             # Controllers, Middleware, Requests
│   │   ├── Models/           # Eloquent Models
│   │   └── Policies/         # Authorization Policies
│   ├── config/               # File konfigurasi aplikasi
│   ├── database/             # Migrations, Seeders, Factories
│   ├── resources/            # Views, CSS, JavaScript
│   ├── routes/               # Web, API, dan Console routes
│   ├── storage/              # File storage, cache, logs
│   ├── tests/                # Unit dan Feature tests
│   └── vendor/               # Dependency packages
├── public/                   # Root directory web
│   ├── assets/               # Static assets
│   ├── build/                # Build assets hasil Vite
│   └── index.php             # Entry point aplikasi
├── docker-compose.yml        # Konfigurasi Docker services
├── nginx/                    # Konfigurasi Nginx web server
├── php/                      # Konfigurasi PHP container
└── db/                       # Database configuration dan data
```

### Teknologi Stack

- **Backend:** Laravel 11 (PHP Framework)
- **Admin Panel:** Filament (Modern Admin Dashboard)
- **Database:** MySQL 8
- **Frontend:** Blade Templates, Tailwind CSS, Alpine.js
- **Build Tool:** Vite
- **Web Server:** Nginx
- **Container:** Docker & Docker Compose
- **Testing:** Pest PHP
- **Code Quality:** PHP Stan, Pint (Code Style)

### Arsitektur Layar/Pages

1. **Public Pages**
   - Homepage - Menampilkan portfolio
   - Detail Portfolio - Halaman detail untuk setiap proyek

2. **Admin Dashboard (Filament)**
   - Dashboard - Overview statistik
   - Portfolio Management - CRUD untuk portfolio items
   - Settings - Konfigurasi aplikasi

---

## Panduan Instalasi

### Prasyarat

Pastikan Anda memiliki tools berikut terinstall:
- Docker & Docker Compose
- Git
- Terminal/Command Line

### Langkah-langkah Instalasi

#### 1. Clone Repository

```bash
git clone <repository-url>
cd portofolio
```

#### 2. Salin File Environment

```bash
cp src/.env.example src/.env
```

#### 3. Build dan Jalankan Docker Containers

```bash
docker compose up -d --build
```

Perintah ini akan:
- Membangun image PHP dan Nginx
- Menjalankan services: PHP, Nginx, MySQL, Redis
- Setup volumes untuk persistent storage

#### 4. Install Dependencies Laravel

```bash
docker compose exec app composer install
```

#### 5. Generate Application Key

```bash
docker compose exec app php artisan key:generate
```

#### 6. Jalankan Database Migrations

```bash
docker compose exec app php artisan migrate
```

#### 7. Seed Database (Optional)

```bash
docker compose exec app php artisan db:seed
```

#### 8. Build Frontend Assets

```bash
docker compose exec app npm install
docker compose exec app npm run build
```

### Verifikasi Instalasi

Akses aplikasi di browser:
- **Website:** http://localhost
- **Admin Panel:** http://localhost/admin

---

## Contoh Penggunaan

### Akses Admin Dashboard

1. Navigasikan ke `http://localhost/admin`
2. Login dengan kredensial default (sesuaikan di seeder)
3. Manage portfolio items melalui interface Filament

### Menambah Portfolio Item

1. Masuk ke Admin Dashboard
2. Pilih menu "Portfolio"
3. Klik tombol "Create"
4. Isi form dengan:
   - Title
   - Description
   - Image
   - Technologies
   - Link (opsional)
5. Klik "Save"

### Menjalankan Tests

```bash
# Jalankan semua tests
docker compose exec app php artisan test

# Jalankan tests spesifik
docker compose exec app php artisan test tests/Feature/PortfolioTest.php

# Dengan coverage report
docker compose exec app php artisan test --coverage
```

### Menjalankan Code Style Check

```bash
# Check code style dengan Pint
docker compose exec app ./vendor/bin/pint --test

# Fix code style otomatis
docker compose exec app ./vendor/bin/pint
```

### Artisan Commands

```bash
# Lihat semua available commands
docker compose exec app php artisan list

# Buat Model baru
docker compose exec app php artisan make:model PortfolioItem -mcr

# Buat Migration
docker compose exec app php artisan make:migration create_portfolios_table

# Clear cache
docker compose exec app php artisan cache:clear
docker compose exec app php artisan config:clear
```

---

## Panduan Kontribusi

Kami sangat menghargai kontribusi Anda! Ikuti langkah-langkah berikut:

### 1. Fork dan Clone

```bash
git clone <your-fork-url>
cd portofolio
```

### 2. Buat Feature Branch

```bash
git checkout -b feature/nama-fitur
```

Atau untuk bug fix:

```bash
git checkout -b fix/nama-bug
```

### 3. Buat Perubahan Anda

- Ikuti coding style yang sudah ada (gunakan Pint untuk auto-formatting)
- Tambahkan tests untuk fitur baru
- Update dokumentasi jika diperlukan

### 4. Test Perubahan Anda

```bash
# Jalankan tests
docker compose exec app php artisan test

# Check code style
docker compose exec app ./vendor/bin/pint --test

# Run static analysis
docker compose exec app ./vendor/bin/phpstan analyse
```

### 5. Commit Changes

```bash
git add .
git commit -m "feat: deskripsi fitur yang jelas"
```

Ikuti [Conventional Commits](https://www.conventionalcommits.org/):
- `feat:` - Fitur baru
- `fix:` - Bug fix
- `docs:` - Documentation changes
- `style:` - Code style changes
- `refactor:` - Code refactoring
- `test:` - Test additions/modifications
- `chore:` - Chores (dependencies, build, etc.)

### 6. Push dan Buat Pull Request

```bash
git push origin feature/nama-fitur
```

Kemudian buat Pull Request dengan deskripsi yang jelas:
- Apa yang diubah?
- Mengapa diubah?
- Bagaimana cara testing?

### Guidelines

- Pastikan code Anda mengikuti PSR-12 coding standard
- Tambahkan unit/feature tests untuk semua fitur baru
- Update README jika ada perubahan significant
- Jangan push langsung ke `main` branch
- Pastikan semua tests passing sebelum submit PR

---

## Lisensi

Proyek ini dilisensikan di bawah **MIT License** - lihat file [LICENSE](./LICENSE) untuk detail lebih lanjut.

### Ringkasan MIT License

Anda diizinkan untuk:
- ✅ Menggunakan software untuk keperluan komersial maupun personal
- ✅ Memodifikasi source code
- ✅ Mendistribusikan software
- ✅ Menggunakan untuk keperluan pribadi

Dengan syarat:
- ⚠️ Sertakan notice lisensi dan copyright
- ⚠️ Sertakan copy dari lisensi

Tidak ada garansi atau tanggung jawab hukum untuk software ini.

---

## Bantuan & Support

Jika Anda memiliki pertanyaan atau menemukan masalah:

1. Cek [Issues](https://github.com/yourusername/portofolio/issues) yang sudah ada
2. Buat issue baru dengan deskripsi detail
3. Hubungi pembuat proyek

---

**Dibuat dengan ❤️ oleh Muhamad Alif Mandani**
