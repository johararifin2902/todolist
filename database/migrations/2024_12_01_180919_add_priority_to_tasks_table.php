<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('tasks', function (Blueprint $table) {
        $table->integer('priority')->default(3);  // Prioritas default: 3 (rendah)
    });
}

public function down()
{
    Schema::table('tasks', function (Blueprint $table) {
        $table->dropColumn('priority');
    });
}


    /**
     * Reverse the migrations.
     */

};
