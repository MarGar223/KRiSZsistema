<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            $table->timestamps();

        });

        DB::insert('insert into zones (name, max_people_count) values (?, ?)', ['Krepšinio salė', 40]);
        DB::insert('insert into zones (name, max_people_count) values (?, ?)', ['Futbolo aikštelė', 40]);
        DB::insert('insert into zones (name, max_people_count) values (?, ?)', ['Granatų metymo laukas', 20]);
        DB::insert('insert into zones (name, max_people_count) values (?, ?)', ['Sporto salė', 20]);
        DB::insert('insert into zones (name, max_people_count) values (?, ?)', ['Tinklinio aikstelė', 20]);
        DB::insert('insert into zones (name, max_people_count) values (?, ?)', ['Stadionas', 40]);

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
