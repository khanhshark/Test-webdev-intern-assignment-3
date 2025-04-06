<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('student_scores', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique();
            $table->decimal('math', 4, 2)->nullable();
            $table->decimal('literature', 4, 2)->nullable();
            $table->decimal('foreign_language', 4, 2)->nullable();
            $table->decimal('physics', 4, 2)->nullable();
            $table->decimal('chemistry', 4, 2)->nullable();
            $table->decimal('biology', 4, 2)->nullable();
            $table->decimal('history', 4, 2)->nullable(); 
            $table->decimal('geography', 4, 2)->nullable(); 
            $table->decimal('civic_education', 4, 2)->nullable();
            $table->string('foreign_language_code', 10)->nullable();
            $table->timestamps();
            
         
            $table->index('registration_number');
        });
    }

    public function down()
    {// php artisan migrate:reset
        Schema::dropIfExists('student_scores');
    }
};
