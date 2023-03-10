<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class V37Update extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'marital_status')) {
                DB::statement("ALTER TABLE users MODIFY COLUMN marital_status ENUM('Married','Unmarried','Common-Law/Live-In','Widowed','Separated')");
            }
            if (Schema::hasColumn('users', 'religion')) {
                DB::statement("ALTER TABLE `users` CHANGE `religion` `religion` ENUM('Islam','Hindu','Christan','Buddha') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT 'Islam'");
            }
            try {
                DB::statement("ALTER TABLE `users` DROP INDEX `users_phone_unique`");
                DB::statement("ALTER TABLE `users` DROP INDEX `users_email_unique`");
            } catch (\Throwable $th) {
            }
        });
        Schema::table('location_binds', function (Blueprint $table) {
            if (!Schema::hasColumn('location_binds', 'employee_id')) {
                $table->foreignId('employee_id')->nullable()->constrained('users')->cascadeOnDelete();  
            }
        });
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'location_id')) {
                $table->foreignId('location_id')->nullable()->constrained('location_binds')->cascadeOnDelete();  
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
