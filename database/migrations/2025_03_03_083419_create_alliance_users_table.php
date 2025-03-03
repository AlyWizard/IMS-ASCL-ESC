<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllianceUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alliance_users', function (Blueprint $table) {
            $table->id(); // Creates an auto-incrementing primary key
            $table->string('username')->unique(); // Username must be unique
            $table->string('password'); // Password field (will be hashed)
            $table->string('email')->unique(); // Email must be unique
            $table->string('name'); // User's full name
            $table->enum('role', ['admin', 'standard', 'readonly'])->default('readonly'); // User role with default
            $table->rememberToken(); // For "remember me" functionality
            $table->timestamps(); // Creates created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alliance_users');
    }
}