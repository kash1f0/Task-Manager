<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\TaskStatus; 

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->date('due_date');
            $table->unsignedBigInteger('employer_id');
            $table->unsignedBigInteger('employee_id')->nullable(); 
            $table->foreign('employer_id')->references('id')->on('employers')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null'); 
            $table->string('status'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
