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
        Schema::table('users', function (Blueprint $table) {
            $table->string('country')->nullable();
            $table->string('streetAddress')->nullable();
            $table->string('city')->nullable();
            $table->string('postCode')->nullable();
            $table->string('phone')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('sex')->nullable();
            $table->string('username')->nullable()->after('password');
            $table->string('avatar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('country');
            $table->dropColumn('streetAddress');
            $table->dropColumn('city');
            $table->dropColumn('postCode');
            $table->dropColumn('phone');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('sex');
            $table->dropColumn('username');
            $table->dropColumn('avatar');
            $table->dropTimestamps();
        });
    }
};