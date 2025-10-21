<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //$table->dropColumn('email'); // Elimina columna existente si aplica
            $table->dropColumn('email_verified_at');
            $table->string('codigo_estudiante')->unique()->after('name');
            $table->string('rol')->default('user')->after('codigo_estudiante');
        });
    }


}