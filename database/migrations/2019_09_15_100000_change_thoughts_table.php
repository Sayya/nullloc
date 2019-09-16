<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeThoughtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('thoughts', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('locus_id')->references('id')->on('locuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('thoughts', function (Blueprint $table) {
            $table->dropForeign('thoughts_user_id_foreign');
            $table->dropForeign('thoughts_locus_id_foreign');
        });
        Schema::enableForeignKeyConstraints();
    }
}
