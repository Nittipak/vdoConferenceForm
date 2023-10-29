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
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained();
            $table->date('meeting_date');
            $table->time('meeting_time');
            $table->string('meeting_topic',1000);
            $table->string('meeting_room_name',1000);
            //checkboxเก็บจำนวน
            $table->boolean('notebook')->default(false);
            $table->boolean('speaker')->default(false);

            $table->string('contact_email');
            $table->string('contact_name');
            $table->string('contact_number');
            
            $table->string('institution');//dropdown
            $table->string('เลขที่หนังสือ')->nullable();
            //institution

            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forms');
    }
};
