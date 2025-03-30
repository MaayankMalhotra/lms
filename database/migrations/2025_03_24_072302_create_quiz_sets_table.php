<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizSetsTable extends Migration
{
    public function up()
    {
        Schema::create('quiz_sets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade'); // Teacher jo set banayega
            $table->string('title'); // Set ka naam, jaise ek kahani ka title
            $table->integer('total_quizzes'); // Kitne quizzes honge
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quiz_sets');
    }
}