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
        Schema::create('travaux', function (Blueprint $table) {
            $table->id();
            $table->string("displayname");
            $table->text("description")->nullable();
            $table->string("type");
            $table->string("document")->nullable();
            $table->boolean("status")->default(false);
            $table->string("due_date");
            $table->integer("id_person");
            $table->foreign("id_person")->references('id')->on('people');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travaux');
    }
};
