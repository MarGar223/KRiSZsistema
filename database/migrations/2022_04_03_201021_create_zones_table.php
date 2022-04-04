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
        Schema::create('zones', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('max_people_count');


        });

        DB::insert('insert into zones (name, max_people_count) values (?, ?)', ['Kasis', 25]);
        DB::insert('insert into zones (name, max_people_count) values (?, ?)', ['Fule', 30]);
        DB::insert('insert into zones (name, max_people_count) values (?, ?)', ['Gronkes', 15]);
        DB::insert('insert into zones (name, max_people_count) values (?, ?)', ['Sale', 10]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zones');
    }
};
