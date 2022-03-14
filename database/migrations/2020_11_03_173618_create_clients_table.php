<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('client_name')->nullable();
            $table->string('kind_attention')->nullable();
            $table->string('emailid')->unique();
            $table->string('c_address')->nullable();
            $table->string('scopeofwork')->nullable();
            $table->string('c_state')->nullable();
            $table->string('mobileno')->nullable();
            $table->string('associatedfrom')->nullable();
            $table->string('leadpartner')->nullable();
            $table->string('panno')->nullable();
            $table->string('legalstatus')->nullable();
            $table->string('tanno')->nullable();
            $table->string('tanupload')->nullable();
            $table->string('gstno')->nullable();
            $table->string('gstupload')->nullable();
            $table->string('dateofincorporation')->nullable();
            $table->string('anotherpartner')->nullable();
            $table->string('companygroup')->nullable();
            $table->string('engagementpartner')->nullable();
            $table->string('clientdob')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
