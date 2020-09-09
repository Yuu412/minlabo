<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabEvaluationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_evaluation', function (Blueprint $table) {
            $table->id();
            $table->string('lab_name');
            $table->string('lab_univ');
            $table->integer('user_id');     //Add:user_id
            /*教授について*/
            $table->integer('prof_care');
            $table->integer('prof_friendly');
            $table->integer('prof_jobhunt');
            $table->integer('prof_network');
            $table->integer('prof_experience');
            $table->double('prof_average',2,1);
            /*就活について*/
            $table->integer('job_major');
            $table->integer('job_small');
            $table->integer('job_jobhunt');
            $table->integer('job_recommendation');
            $table->integer('job_reserch');
            $table->double('job_average',2,1);
            /*研究室について*/
            $table->integer('lab_restraint');
            $table->integer('lab_event');
            $table->integer('lab_free');
            $table->integer('lab_advice');
            $table->integer('lab_communication');
            $table->integer('lab_popularity');
            $table->double('lab_average',2,1);
            /*その他*/
            $table->integer('other_skill');
            $table->integer('other_fac');
            $table->integer('other_regret');
            $table->integer('other_international');
            $table->integer('other_gender');
            $table->double('other_average',2,1);
            /*他*/
            $table->string('terms');
            $table->string('content', 2000);
            $table->string('objobtype');
            $table->double('all_average',2,1);

            $table->string('token');
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
        Schema::dropIfExists('lab_evaluation');
    }
}
