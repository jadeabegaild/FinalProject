<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReturnedToRentedVehiclesTable extends Migration
{
    public function up()
    {
       // In the generated migration file:
Schema::table('rented_vehicles', function (Blueprint $table) {
    $table->boolean('returned')->default(0);
});


      
    }

    public function down()
    {
        // In the generated migration file:
Schema::table('rented_vehicles', function (Blueprint $table) {
    $table->dropColumn('returned');
});

    }
}