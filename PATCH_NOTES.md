# Finote — Patch Notes (v1.1.0)

Patch ini memperbaiki bug security & functional yang ditemukan saat audit
project Finote (Laravel 12 + Filament 3), sekaligus rename typo
`expanse` → `expense` di enum DB, model, resource, widget, view, dan API.

Tanggal patch: 2026-04-29

---

## 🔐 A. Security fixes (CRITICAL — install ASAP)

| # | File | Fix |
|---|------|-----|
| 1 | `app/Filament/Resources/TransactionResource.php` | Tambah `getEloquentQuery()` yang scope ke `Auth::id()`. User cuma bisa lihat/edit transaksi miliknya sendiri. Dropdown kategori juga di-scope. |
| 2 | `app/Filament/Resources/CategoryResource.php` | Sama: scope ke `Auth::id()`. |
| 3 | `app/Http/Controllers/TransactionPdfController.php` | Tambah `where('user_id', Auth::id())` di query. Sebelumnya endpoint ini bocor data semua user. |
| 4 | `routes/web.php` | Endpoint PDF dibungkus middleware `auth`. |
| 5 | `app/Http/Controllers/Api/TransactionController.php` | `show()` sekarang authorize ke owner (sebelumnya bisa akses transaksi user lain via route binding). `update()` dibatasi ke kolom whitelisted. |

## 🐛 B. Functional fixes

| # | File | Fix |
|---|------|-----|
| 6 | `TransactionResource.php` & `CategoryResource.php` | `canCreate()` → `true`. Tombol Create sekarang aktif. |
| 7 | `app/Filament/Resources/TransactionResource.php` | `getPages()` mendaftarkan route `create` (sebelumnya cuma index + edit, jadi tombol Create gak punya halaman). |
| 8 | `CreateTransaction.php` & `CreateCategory.php` | Tambah `mutateFormDataBeforeCreate()` → set `user_id = Auth::id()` otomatis. Form gak akan gagal lagi karena `user_id` null. |
| 9 | Semua widget di `app/Filament/Widgets/` | Aggregate pakai kolom `tanggal` (semantik), bukan `created_at`. Laporan bulanan sekarang akurat sesuai tanggal transaksi. |
| 10 | `CategoryChart.php` | `pollingInterval` diubah dari string `'null'` → `null` (PHP literal). |
| 11 | `IncomeOutcomeChart.php`, `RecentTransactions.php`, `SummaryStatsOverview.php` | `pollingInterval` dirubah ke `'30s'` (sebelumnya 10s, sering refresh berlebihan). |
| 12 | `app/Models/User.php` | Rename relasi `category()` → `categories()` dan `transaction()` → `transactions()` (konvensi hasMany). |
| 13 | `app/Models/Category.php` | Rename `transaction()` → `transactions()`. |
| 14 | `app/Models/Transaction.php` | Tambah `$casts` untuk `tanggal` (date) dan `jumlah` (integer). Method `user()` diberi keyword `function`/`public` yang konsisten. |
| 15 | `app/Filament/Resources/TransactionResource.php` (PDF action) & `TransactionPdfController.php` | PDF pakai field `tanggal` (bukan `created_at`) untuk kolom Tanggal. |
| 16 | `resources/views/pdf/transactions.blade.php` | Tampilkan periode di header PDF. |

## ✏️ C. Rename `expanse` → `expense`

| # | File | Fix |
|---|------|-----|
| 17 | `database/migrations/2025_04_24_200203_create_categories_table.php` | Enum diubah ke `['income','expense']`. Untuk fresh install. |
| 18 | `database/migrations/2025_04_24_212030_create_transactions_table.php` | Sama. |
| 19 | **`database/migrations/2026_04_29_000000_rename_expanse_to_expense_in_enums.php` (BARU)** | Migration baru untuk database existing. Strategi: widen enum → UPDATE data → narrow enum. Aman untuk MySQL/MariaDB; SQLite/PG cuma update data. |
| 20 | Semua resource, widget, controller, API | Semua referensi `'expanse'` di PHP diganti `'expense'`. Label UI tetap "Pengeluaran" (Bahasa Indonesia). |

> ⚠️ Kalau lo punya data lama di DB production, **WAJIB** jalanin migration baru itu sekali (`php artisan migrate`) sebelum aplikasi dipakai lagi.
> Untuk MySQL/MariaDB, install dulu: `composer require doctrine/dbal` (kalau belum ada).

---

## 🚀 Cara apply & deploy

```bash
# 1. Extract zip ini ke server / lokal lo
unzip finote-patched.zip
cd finote-main

# 2. Install dependency PHP
composer install --no-dev --optimize-autoloader

# 3. Copy & generate env
cp .env.example .env       # kalau belum ada .env
php artisan key:generate

# 4. Edit .env: setup DB_CONNECTION, DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD
#    (MySQL/MariaDB recommended karena migration enum di-tune untuk MySQL)

# 5. (MySQL/MariaDB only, sekali aja) install doctrine/dbal kalau belum
composer require doctrine/dbal

# 6. Run migrations — termasuk migration rename baru
php artisan migrate

# 7. Storage symlink (untuk DejaVu fonts dipakai PDF, dll)
php artisan storage:link
#    Pastikan file storage/app/fonts/DejaVuSans.ttf ada (download dari https://dejavu-fonts.github.io
#    atau hapus block @font-face di resources/views/pdf/transactions.blade.php kalau gak butuh)

# 8. Build frontend (Tailwind / Filament assets)
npm install
npm run build

# 9. Deploy:
#    - Laravel Cloud → push repo, set env, done
#    - Forge/Ploi/Railway → standar Laravel deploy
#    - VPS → nginx + PHP-FPM 8.2+, point root ke public/
#    - Hostinger Premium/Business → upload via FTP, set document root ke /public

# 10. Optimasi production
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan filament:optimize
```

---

## 🧪 Verifikasi setelah deploy

1. Login sebagai User A → buat 1 kategori "Gaji" (income) dan 1 transaksi.
2. Logout, login sebagai User B → di list Categories & Transactions **tidak boleh** muncul data User A.
3. Coba akses `/admin/transactions/pdf` tanpa login → harus redirect ke login.
4. Klik tombol **+ Create** di Categories & Transactions → form muncul, submit berhasil tanpa error `user_id`.
5. Cek dashboard: angka Income/Expense/Balance harus sesuai tanggal transaksi (bukan tanggal input).
6. Klik **Export PDF** → file ter-download, isinya cuma data user yang lagi login.

---

## 📂 File yang dimodifikasi

```
app/Models/User.php                                                       (modified)
app/Models/Category.php                                                   (modified)
app/Models/Transaction.php                                                (modified)
app/Filament/Resources/CategoryResource.php                               (modified)
app/Filament/Resources/TransactionResource.php                            (modified)
app/Filament/Resources/CategoryResource/Pages/CreateCategory.php          (modified)
app/Filament/Resources/TransactionResource/Pages/CreateTransaction.php    (modified)
app/Filament/Widgets/CategoryChart.php                                    (modified)
app/Filament/Widgets/IncomeOutcomeChart.php                               (modified)
app/Filament/Widgets/RecentTransactions.php                               (modified)
app/Filament/Widgets/SummaryStatsOverview.php                             (modified)
app/Http/Controllers/TransactionPdfController.php                         (modified)
app/Http/Controllers/Api/TransactionController.php                        (modified)
routes/web.php                                                            (modified)
resources/views/pdf/transactions.blade.php                                (modified)
database/migrations/2025_04_24_200203_create_categories_table.php         (modified)
database/migrations/2025_04_24_212030_create_transactions_table.php       (modified)
database/migrations/2026_04_29_000000_rename_expanse_to_expense_in_enums.php  (NEW)
PATCH_NOTES.md                                                            (NEW)
```

---

Patched by Lovable — happy hosting! 🚀
