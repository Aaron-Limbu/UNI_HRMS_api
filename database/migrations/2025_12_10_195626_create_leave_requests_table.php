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
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id'); 
            $table->unsignedBigInteger('leaveType_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('description');
            $table->enum('status',['pending','approved','rejected']);
            $table->unsignedBigInteger('approved_by');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('leaveType_id')->references('id')->on('leave_types')->onDelete('cascade');
            $table->foreign('approved_by')->references('id')->on('employees')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};
