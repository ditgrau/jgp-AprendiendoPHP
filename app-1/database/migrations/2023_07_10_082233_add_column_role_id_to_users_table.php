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
        Schema::table('users', function (Blueprint $table) {
            //aqui añado la columna que quiero añadir, y donde la quiero añadir
            $table -> string('surname')->after('name');
            $table -> unsignedBigInteger('role_id')->after('password');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table -> dropColumn('surname');
            $table -> dropColumn('role_id');
                        //
        });
    }
};
