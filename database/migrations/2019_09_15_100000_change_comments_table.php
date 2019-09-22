<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('file_id')->references('id')->on('files');
            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('parent_id')->references('id')->on('posts');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign('comments_file_id_foreign');
            $table->dropForeign('comments_post_id_foreign');
            $table->dropForeign('comments_parent_id_foreign');
            $table->dropForeign('comments_user_id_foreign');
        });
        Schema::enableForeignKeyConstraints();
    }
}
