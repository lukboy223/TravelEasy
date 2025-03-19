da<?php

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
      
        DB::unprepared('
        Create table customers(
        Id int unsigned not null auto_increment
        ,PeopleId int unsigned
        ,RelationNumber Varchar(50) not null
        ,Isactive bit not null default 1
        ,Note varchar(250) null default null
        ,DateCreated datetime(6) not null default now(6)
        ,DateChanged datetime(6) not null default now(6)
        ,Created_at datetime(6) not null default now(6)
        ,Updated_at datetime(6) not null default now(6)
        ,primary key (Id)
        ,Foreign Key (PeopleId) references People(Id)
        )engine=innoDB;');
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
