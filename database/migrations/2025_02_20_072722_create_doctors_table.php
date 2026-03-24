<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    public function up()
    {
        // Removed – not used in this system
    }

    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}
