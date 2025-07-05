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
        Schema::create('developer_stack', function (Blueprint $table) {
            $table->id();
            $table->uuid('developer_id');
            $table->foreignId('stack_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->foreign('developer_id')->references('id')->on('developers')->onDelete('cascade');
            $table->unique(['developer_id', 'stack_id']);
            
            
            $table->index('developer_id');
            $table->index('stack_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('developer_stack');
    }
};
