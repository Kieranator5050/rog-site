<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->bigInteger('uid')->nullable()->unique();
            $table->text('description')->nullable();
            $table->integer('opCount')->default(0);
            $table->float('balance')->default(0);
            $table->boolean('isAdmin')->default(0);
            $table->boolean('isTeamLead')->default(0);
            $table->boolean('isQuartermaster')->default(0);
            $table->boolean('isMissionMaker')->default(0);
            $table->boolean('isActive')->default(1);
            $table->boolean('isLocked')->default(0);
            $table->rememberToken();
            $table->string('profile_photo_path', 2048)->nullable();
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
        Schema::dropIfExists('users');
    }
};
