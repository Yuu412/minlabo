<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaboratoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laboratories', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');       //Add:user_id
            $table->string('lab_univ');       //大学
            $table->string('lab_faculty');     //学部
            $table->string('lab_department');  //学科
            $table->string('lab_name');       //研究室名
            $table->date('add_time');
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
        Schema::dropIfExists('laboratories');
    }
}
