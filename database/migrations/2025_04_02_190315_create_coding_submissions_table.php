<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodingSubmissionsTable extends Migration
{
    public function up()
    {
        Schema::create('coding_submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Student who submitted
            $table->unsignedBigInteger('coding_question_id'); // The coding question
            $table->text('submitted_solution'); // The student's submitted solution
            $table->boolean('is_correct')->default(false); // Whether the solution is correct
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('coding_question_id')->references('id')->on('coding_questions')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('coding_submissions');
    }
}
