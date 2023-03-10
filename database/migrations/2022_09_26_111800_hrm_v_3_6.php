<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HrmV36 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //add column to hrm_languages
        Schema::table('hrm_languages', function ($table) {
            if (!Schema::hasColumn('hrm_languages', 'country_name')) {
                $table->string('country_name')->default('United States')->nullable();
                $table->string('country_code')->default('US')->nullable();
                $table->string('country_flag')->nullable();
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
