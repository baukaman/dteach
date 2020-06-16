<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OnlineMeeting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_teacher_online', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->bigInteger("teacher_id")->unsigned()->unique();
            $table->foreign("teacher_id")->references("id")->on("users");
            $table->string("subject");
            $table->integer("level");
            $table->string("city");
            $table->integer("lhs");
            $table->timestamps();
        });

        DB::update("ALTER TABLE t_teacher_online AUTO_INCREMENT = 50;");

        Schema::create('t_live_lesson', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->bigInteger("teacher_id")->unsigned()->unique();
            $table->foreign("teacher_id")->references("id")->on("users");
            $table->integer("student_id")->unique();
            $table->date("start_date");
            $table->date("end_date");
            $table->timestamps();
        });

        DB::update("ALTER TABLE t_live_lesson AUTO_INCREMENT = 100;");



        Schema::create('t_teacher_accept', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("teacher_id")->unsigned();
            $table->foreign("teacher_id")->references("id")->on("users");
            $table->date("start_date");
            $table->date("end_date");
            $table->timestamps();
        });

        DB::update("ALTER TABLE t_teacher_accept AUTO_INCREMENT = 150;");

        Schema::create('t_teacher_page', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("teacher_id")->unsigned();
            $table->foreign("teacher_id")->references("id")->on("users");
            $table->string("page_id");
            $table->timestamps();
        });

        DB::update("ALTER TABLE t_teacher_page AUTO_INCREMENT = 200;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_teacher_online');
        Schema::dropIfExists('t_live_lesson');
        Schema::dropIfExists('t_teacher_accept');
        Schema::dropIfExists('t_teacher_page');
    }
}
