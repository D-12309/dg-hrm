<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->string('subject');
            $table->foreignId('show_to_customer')->index('show_to_customer')->default(22)->constrained('statuses')->comment('22=No,32=Yes');
            $table->foreignId('task_id')->constrained('tasks')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('attachment')->nullable()->constrained('uploads');
            $table->foreignId('status_id')->index('status_id')->default(1)->constrained('statuses')->comment('1=active,4=inactive');
            $table->timestamps();
            $table->timestamp('last_activity')->nullable();

            $table->index(['id', 'task_id', 'company_id', 'status_id','user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_files');
    }
}
