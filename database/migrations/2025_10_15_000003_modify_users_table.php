<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('email'); // Elimina columna existente si aplica
            $table->string('codigo_estudiante')->unique()->after('name'); // Agrega nueva columna
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->nullable(); // Restaura email si se revierte
            $table->dropColumn('codigo_estudiante');
        });
    }
}