<div align="center">
  <h1>💰 Finote</h1>
  <p>Personal Finance Management Application</p>

  ![Laravel](https://img.shields.io/badge/Laravel-12-red?style=flat&logo=laravel)
  ![PHP](https://img.shields.io/badge/PHP-8.3-blue?style=flat&logo=php)
  ![Filament](https://img.shields.io/badge/Filament-3-orange?style=flat)
  ![License](https://img.shields.io/badge/license-MIT-green?style=flat)
</div>

---

## 📌 About

Finote is a personal finance management application that helps users track their income and expenses efficiently. Built with Laravel as the backend API and Flutter as the mobile frontend.

## ✨ Features

- 🔐 Authentication (Register, Login, Logout)
- 💸 Transaction Management (Income & Expense)
- 🗂️ Category Management
- 📊 Admin Panel powered by Filament
- 📄 PDF Export for transactions
- 🌐 REST API for mobile integration

## 🛠️ Tech Stack

**Backend:**
- PHP 8.3
- Laravel 12
- Laravel Sanctum (API Authentication)
- Filament 3 (Admin Panel)

**Database:**
- MySQL

**Mobile:**
- Flutter (by [ahmadabdillah001](https://github.com/ahmadabdillah001))

## ⚙️ Installation

```bash
# Clone repo
git clone https://github.com/Athallahsy/finote.git
cd finote

# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate app key
php artisan key:generate

# Setup database di .env lalu jalankan migrasi
php artisan migrate --seed

# Jalankan server
php artisan serve
```

## 🔑 API Endpoints

| Method | Endpoint | Description | Auth |
|--------|----------|-------------|------|
| POST | /api/register | Register user baru | ❌ |
| POST | /api/login | Login user | ❌ |
| POST | /api/logout | Logout user | ✅ |
| GET | /api/transactions | Ambil semua transaksi | ✅ |
| POST | /api/transactions | Tambah transaksi | ✅ |
| PUT | /api/transactions/{id} | Update transaksi | ✅ |
| DELETE | /api/transactions/{id} | Hapus transaksi | ✅ |
| GET | /api/categories | Ambil semua kategori | ✅ |

## 👨‍💻 Developer

**Athallah Muhammad Syaffa**
- GitHub: [@Athallahsy](https://github.com/Athallahsy)
- Portfolio: [athallahsy.github.io/portofolio](https://athallahsy.github.io/portofolio)

## 📄 License

This project is open-sourced under the [MIT License](LICENSE).
