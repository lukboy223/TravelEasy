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
        // DB::unprepared('
        //     drop table if exists Users;
        //     Create table Users(
        //     Id int unsigned not null auto_increment
        //     ,People_Id int unsigned not null
        //     ,name varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
        //     ,email varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
        //     ,password varchar(255) not null
        //     ,email_verified_at timestamp null default null
        //     ,Is_logged_in bit not null default 0
        //     ,Is_logged_out bit not null default 1
        //     ,remember_token varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
        //     ,Is_active bit not null default 1
        //     ,Note varchar(250) null default null
        //     ,Created_at datetime(6) not null default now(6)
        //     ,Updated_at datetime(6) not null default now(6)
        //     ,Primary Key (Id)
        //     ,Foreign Key (People_Id) references People(Id)
        //     )engine=innoDB;
        //     ');



        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $foreignId = $table->foreignId('People_id')->default(1);
            $foreignId->constrained('People');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('Is_logged_in')->default(0);
            $table->boolean('Is_logged_out')->default(1);
            $table->boolean('Is_active')->default(1);
            $table->string('note')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

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
