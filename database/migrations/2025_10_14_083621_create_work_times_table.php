<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('work_times', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->decimal('hours', 5, 2)->default(0);
            $table->unsignedBigInteger('emp_id')->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->unsignedBigInteger('modul_id')->nullable();

            $table->index('emp_id');
            $table->index('project_id');
            $table->index('modul_id');

            $table->timestamps();

            $table->foreign('emp_id')->references('id')->on('employees')->onDelete('set null');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('set null');
            $table->foreign('modul_id')->references('id')->on('moduls')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_times');
    }
};
