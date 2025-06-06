<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations. aaa
     */
    public function up()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->string('status')->default('estoque')->after('quantidade');
        });
    }

    public function down()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
