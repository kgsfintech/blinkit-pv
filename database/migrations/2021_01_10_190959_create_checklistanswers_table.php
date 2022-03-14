<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChecklistanswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checklistanswers', function (Blueprint $table) {
            $table->id();
            $table->string('assignment_id')->int();
            $table->string('audit_id')->int();
            $table->string('answer')->nullable();
            $table->string('checklist_note')->nullable();
            $table->string('ref_doc')->nullable();
            $table->string('created_by')->int();
            $table->string('modify_by')->int();
            $table->string('critical_notes')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('checklistanswers');
    }
}
