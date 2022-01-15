<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->dropForeign('notes_video_id_foreign');
            $table->dropColumn('video_id');
            $table->string('yt_video_id', 11)->after('content');
            $table->string('start_seconds')->after('yt_video_id');
        });
        Schema::dropIfExists('videos');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('yt_video_id', 11);
            $table->string('start_seconds');
            $table->timestamps();
        });

        Schema::table('notes', function (Blueprint $table) {
            $table->unsignedBigInteger('video_id');
            $table->dropColumn('yt_video_id');
            $table->dropColumn('start_seconds');

            $table->foreign('video_id')
                ->references('id')
                ->on('videos');

        });
    }
}
