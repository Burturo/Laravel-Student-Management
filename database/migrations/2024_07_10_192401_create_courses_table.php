<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string("displayname");
            $table->text("description")->nullable();
            $table->string("type");
            $table->string("document")->nullable();
            $table->boolean("status")->default(false);
            $table->date("dueDate");
            $table->integer("idPerson");
            $table->foreign("idPerson")->references('id')->on('people');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
