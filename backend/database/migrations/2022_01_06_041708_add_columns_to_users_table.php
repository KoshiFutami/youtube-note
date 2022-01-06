<?php

use Facade\FlareClient\Truncation\TruncationStrategy;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable(true)->after('name');
            $table->longText('introduction')->nullable(true)->after('username');
            $table->string('thumbnail')->default('default.jpg')->after('introduction');
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
            $table->dropColumn('username');
            $table->dropColumn('introduction');
            $table->dropColumn('thumbnail');
        });
    }
}
