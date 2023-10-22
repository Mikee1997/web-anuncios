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
        Schema::table('anuncios', function (Blueprint $table) {
            $table->unsignedBigInteger('buyer_id')->after('user_id')->nullable();
            $table->foreign('buyer_id')->references('id')->on('users');
            $table->json('pick_points')->after('buyer_id');
            $table->unsignedBigInteger('pickpoint_selected')->after('pick_points')->nullable();
            $table->foreign('pickpoint_selected')->references('id')->on('pick_points');
            $table->string('state')->after('pickpoint_selected');
            $table->dateTime('reserved_at')->after('state')->nullable();
            $table->dateTime('available_at')->after('reserved_at')->nullable();
            $table->dateTime('dalivered_at')->after('available_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anuncios', function (Blueprint $table) {
            $table->dropColumn('buyer_id');
            $table->dropColumn('pick_points');
            $table->dropColumn('pickpoint_selected');
            $table->dropColumn('state');
            $table->dropColumn('reserved_at');
            $table->dropColumn('available_at');
            $table->dropColumn('dalivered_at');
        });
    }
};
