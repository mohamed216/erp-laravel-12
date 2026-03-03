<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->decimal('target', 12, 2);
            $table->decimal('current', 12, 2)->default(0);
            $table->string('period')->default('monthly');
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('achieved')->default(false);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('goals'); }
};
