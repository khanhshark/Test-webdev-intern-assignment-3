<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('student_scores', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique(); // Số báo danh (SBD)
            $table->decimal('math', 4, 2)->nullable(); // Toán
            $table->decimal('literature', 4, 2)->nullable(); // Ngữ văn
            $table->decimal('foreign_language', 4, 2)->nullable(); // Ngoại ngữ
            $table->decimal('physics', 4, 2)->nullable(); // Vật lý
            $table->decimal('chemistry', 4, 2)->nullable(); // Hóa học
            $table->decimal('biology', 4, 2)->nullable(); // Sinh học
            $table->decimal('history', 4, 2)->nullable(); // Lịch sử
            $table->decimal('geography', 4, 2)->nullable(); // Địa lý
            $table->decimal('civic_education', 4, 2)->nullable(); // GDCD
            $table->string('foreign_language_code', 10)->nullable(); // Mã ngoại ngữ (N1, N2...)
            $table->timestamps();
            
            // Thêm index để tối ưu tìm kiếm theo SBD
            $table->index('registration_number');
        });
    }

    public function down()
    {// php artisan migrate:reset
        Schema::dropIfExists('students_scores');
    }
};
