<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::create('users', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('person_id');
        //     $table->string('name', 50);
        //     $table->string('email', 150)->unique();
        //     $table->timestamp('email_verified_at')->nullable();
        //     $table->string('password', 255);
        //     $table->boolean('is_logged_in')->default(0);
        //     $table->boolean('is_logged_out')->default(1);
        //     $table->boolean('is_active')->default(1);
        //     $table->string('note')->nullable();
        //     $table->rememberToken();
        //     $table->timestamps(6);

            DB::unprepared('
                drop table if exists Users;
                Create table Users(
                Id int unsigned not null auto_increment
                ,People_Id int unsigned not null
                ,Name varchar(50) not null
                ,Email varchar(50) not null
                ,Password varchar(255) not null
                ,Email_verified_at timestamp null default null
                ,Is_logged_in bit not null default 0
                ,Is_logged_out bit not null default 1
                ,remember_token varchar(100) null default null
                ,Is_active bit not null default 1
                ,Note varchar(250) null default null
                ,Created_at datetime(6) not null default now(6)
                ,Updated_at datetime(6) not null default now(6)
                ,Primary Key (Id)
                ,Foreign Key (People_Id) references People(Id)
                )engine=innoDB;
                ');

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};