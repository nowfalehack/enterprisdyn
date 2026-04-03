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
    { Schema::table('fields', function (Blueprint $table) {

        if (!Schema::hasColumn('fields', 'validation')) {
            $table->string('validation')->nullable();
        }

        if (!Schema::hasColumn('fields', 'order')) {
            $table->integer('order')->default(0);
        }

        if (!Schema::hasColumn('fields', 'options')) {
            $table->text('options')->nullable();
        }

    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
