<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

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
            $table->string('name');
            $table->string('surname');
            $table->string('role');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('user_level_id');
            $table->timestamps();
        });
        // $password = Password::Hash('Marius!2');
        DB::insert('insert into users (name, surname, role, email, password, user_level_id) values (?, ?, ?, ?, ?, ?)', ['Admin', 'Admin', 'Admin', 'admin@admin.lt', Hash::make('Marius!2'), 1]);

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
