<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        DB::unprepared('
Create table people(
 Id int unsigned not null auto_increment
,Firstname varchar(50) not null
,Infix varchar(50) null default null
,Lastname varchar(50) not null
,Fullname varchar(110) as (concat_WS(" ",Firstname,Infix,Lastname)) stored
,Birthdate date not null
,Isactive bit not null default 1
,Note varchar(250) null default null
,DateCreated datetime(6) not null default now(6)
,DateChanged datetime(6) not null default now(6)
,Created_at datetime(6) not null default now(6)
,Updated_at datetime(6) not null default now(6)

,Primary Key (id)
)engine=innoDB;');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
