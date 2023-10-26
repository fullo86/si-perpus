<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rental_logs', function (Blueprint $table) {
            $table->string('trx_code', 10)->after('id')->required();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rental_logs', function (Blueprint $table) {
            $table->dropColumn('trx_code');
        });
    }
};
