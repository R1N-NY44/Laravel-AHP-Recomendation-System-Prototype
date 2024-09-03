<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('values', function (Blueprint $table) {            
            $table->integer('nim')->primary();            
            $table->unsignedInteger('id_internship');
            $table->string('name', 50);            
            $table->decimal('ipk', 3, 2)->nullable();
            $table->json('course_grades');
            $table->boolean('status')->default(true);
            $table->timestamps();   
            
            $table->foreign('id_internship')->references('id_internship')->on('internships')
        ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('values');
    }
};
