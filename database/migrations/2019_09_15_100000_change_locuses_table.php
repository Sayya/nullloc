<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeLocusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('locuses', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('locuses');
            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('created_user_id')->references('id')->on('users');
            $table->foreign('updated_user_id')->references('id')->on('users');
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
        Schema::table('locuses', function (Blueprint $table) {
            $table->dropForeign('locuses_parent_id_foreign');
            $table->dropForeign('locuses_post_id_foreign');
            $table->dropForeign('locuses_created_user_id_foreign');
            $table->dropForeign('locuses_updated_user_id_foreign');
        });
        Schema::enableForeignKeyConstraints();
    }
}
