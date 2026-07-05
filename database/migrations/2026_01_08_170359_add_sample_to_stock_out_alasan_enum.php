<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $driver = DB::getDriverName();

        if (in_array($driver, ['pgsql', 'postgres'], true)) {
            return;
        }

        // Modify ENUM to include 'sample'
        DB::statement("ALTER TABLE stock_out MODIFY COLUMN alasan ENUM('penjualan', 'rusak', 'kadaluarsa', 'retur', 'sample', 'lainnya') DEFAULT 'penjualan'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $driver = DB::getDriverName();

        if (in_array($driver, ['pgsql', 'postgres'], true)) {
            return;
        }

        // Revert back to original ENUM
        DB::statement("ALTER TABLE stock_out MODIFY COLUMN alasan ENUM('penjualan', 'rusak', 'kadaluarsa', 'retur', 'lainnya') DEFAULT 'penjualan'");
    }
};
