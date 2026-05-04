<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

/**
 * Rename the typo enum value 'expanse' to 'expense' on both
 * categories.jenis and transactions.jenis.
 *
 * Strategy:
 *   1) Widen the enum to accept BOTH old + new values.
 *   2) UPDATE existing rows from 'expanse' -> 'expense'.
 *   3) Narrow the enum down to just ['income','expense'].
 *
 * This is safe to run on existing databases without losing data.
 *
 * NOTE: enum changes via Schema::table() require doctrine/dbal:
 *   composer require doctrine/dbal
 * If you cannot install doctrine/dbal (or you're on SQLite), fall back to
 * the raw-SQL branch below which works on MySQL/MariaDB directly.
 */
return new class extends Migration
{
    public function up(): void
    {
        $driver = DB::connection()->getDriverName();

        if ($driver === 'mysql' || $driver === 'mariadb') {
            // Step 1: widen
            DB::statement("ALTER TABLE categories   MODIFY jenis ENUM('income','expanse','expense') NOT NULL");
            DB::statement("ALTER TABLE transactions MODIFY jenis ENUM('income','expanse','expense') NOT NULL");

            // Step 2: migrate data
            DB::table('categories')->where('jenis', 'expanse')->update(['jenis' => 'expense']);
            DB::table('transactions')->where('jenis', 'expanse')->update(['jenis' => 'expense']);

            // Step 3: narrow
            DB::statement("ALTER TABLE categories   MODIFY jenis ENUM('income','expense') NOT NULL");
            DB::statement("ALTER TABLE transactions MODIFY jenis ENUM('income','expense') NOT NULL");

            return;
        }

        // SQLite / Postgres / others — enums on these aren't enforced the same way.
        // Just update the data; the application layer enforces the allowed values.
        DB::table('categories')->where('jenis', 'expanse')->update(['jenis' => 'expense']);
        DB::table('transactions')->where('jenis', 'expanse')->update(['jenis' => 'expense']);
    }

    public function down(): void
    {
        $driver = DB::connection()->getDriverName();

        if ($driver === 'mysql' || $driver === 'mariadb') {
            DB::statement("ALTER TABLE categories   MODIFY jenis ENUM('income','expanse','expense') NOT NULL");
            DB::statement("ALTER TABLE transactions MODIFY jenis ENUM('income','expanse','expense') NOT NULL");

            DB::table('categories')->where('jenis', 'expense')->update(['jenis' => 'expanse']);
            DB::table('transactions')->where('jenis', 'expense')->update(['jenis' => 'expanse']);

            DB::statement("ALTER TABLE categories   MODIFY jenis ENUM('income','expanse') NOT NULL");
            DB::statement("ALTER TABLE transactions MODIFY jenis ENUM('income','expanse') NOT NULL");

            return;
        }

        DB::table('categories')->where('jenis', 'expense')->update(['jenis' => 'expanse']);
        DB::table('transactions')->where('jenis', 'expense')->update(['jenis' => 'expanse']);
    }
};
