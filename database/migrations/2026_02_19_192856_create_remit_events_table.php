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
        Schema::create('remit_events', function (Blueprint $table) {
            $table->id();
            $table->string('asset', 50)->index();
            $table->string('event_id', 100)->unique();
            $table->unsignedInteger('revision')->default(1);
            $table->timestamp('published_at');
            $table->timestamp('start_at');
            $table->timestamp('estimated_end_at');
            $table->unsignedInteger('installed_capacity_mw')->default(0);
            $table->unsignedInteger('available_capacity_mw')->default(0);
            $table->unsignedInteger('unavailable_capacity_mw')->default(0);
            $table->string('type', 100)->default('Special Information');
            $table->string('remit_reason', 100)->index();
            $table->string('status', 50)->default('Active')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remit_events');
    }
};
