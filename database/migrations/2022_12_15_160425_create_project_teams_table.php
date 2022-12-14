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
        Schema::create('bl_project_teams', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id')->length(5);
            $table->bigInteger('user_id');
            $table->smallInteger('status');
            $table->timestamps();
            $table->index(['project_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bl_project_teams');
    }
};
