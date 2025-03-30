<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_set_id')->constrained('quiz_sets')->onDelete('cascade'); // Set se juda hoga
            $table->text('question'); // Sawal, jaise dil ka sawaal
            $table->string('option_1'); // Pehla option
            $table->string('option_2'); // Doosra option
            $table->string('option_3'); // Teesra option
            $table->string('option_4'); // Chautha option
            $table->integer('correct_option'); // Sahi option (1, 2, 3, ya 4)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
}