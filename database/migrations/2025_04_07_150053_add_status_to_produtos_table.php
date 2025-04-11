<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
   /**
    * Run the migrations.
    */
   public function up()
   {
       Schema::table('produtos', function (Blueprint $table) {
           $table->string('status')->default('estoque')->after('quantidade');
       });
   }

   /**
    * Reverse the migrations.
    */
   public function down()
   {
       Schema::table('produtos', function (Blueprint $table) {
           $table->dropColumn('status');
       });
   }
};