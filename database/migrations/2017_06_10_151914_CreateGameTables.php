<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for arenas
        if (!Schema::hasTable('arenas')) {
            Schema::create('arenas', function($table) {
                $table->increments('id');
                $table->string('name')->unique();
                $table->boolean('playing')->default(false);
                $table->boolean('private');
                $table->integer('creator_id')->unsigned();
                $table->foreign('creator_id')->references('id')->on('users');
                $table->timestamps();
            });
        }
        // Create table for games
        if (!Schema::hasTable('games')) {
            Schema::create('games', function($table) {
                $table->increments('id');
                $table->integer('arena_id')->unsigned();
                $table->foreign('arena_id')->references('id')->on('arenas');
                $table->integer('winner_id')->unsigned();
                $table->foreign('winner_id')->references('id')->on('users');
                $table->timestamps();
            });
        }
        // Create table for scores
        if (!Schema::hasTable('scores')) {
            Schema::create('scores', function($table) {
                $table->increments('id');
                $table->integer('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users');
                $table->integer('game_id')->unsigned();
                $table->foreign('game_id')->references('id')->on('games');
                $table->integer('score');
                $table->boolean('win');
                $table->timestamps();
            });
        }
        // Create table for attacks
        if (!Schema::hasTable('attacks')) {
            Schema::create('attacks', function($table) {
                $table->increments('id');
                $table->integer('game_id')->unsigned();
                $table->foreign('game_id')->references('id')->on('games');
                $table->integer('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users');
                $table->integer('type');
                $table->timestamps();
            });
        }
        // Add columns for users
        if (!Schema::hasColumn('users', 'taps_per_minute')) {
            Schema::table('users', function($table) {
                $table->integer('taps_per_minute')->default(100);
            });
        }
        if (!Schema::hasColumn('users', 'arena_id')) {
            Schema::table('users', function($table) {
                $table->integer('arena_id')->unsigned()->nullable();
                $table->foreign('arena_id')->references('id')->on('arenas');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arenas');
        Schema::dropIfExists('games');
        Schema::dropIfExists('scores');
        Schema::dropIfExists('attacks');
        if (Schema::hasColumn('users', 'taps_per_minute')) {
            Schema::table('users', function($table) {
                $table->dropColumn('taps_per_minute');
            });
        }
        if (Schema::hasColumn('users', 'arena_id')) {
            Schema::table('users', function($table) {
                $table->dropColumn('arena_id');
            });
        }
    }
}
