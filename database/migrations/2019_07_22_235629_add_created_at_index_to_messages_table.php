<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCreatedAtIndexToMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            //Podemos crear el indece con el metodo index, pasandola la columna que se volvera un indice y el nombre del indice
            $table->index('created_at', 'my_created_at_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            //Si en el metodo up no le dimos nombre entonces se crera ese indice con un nombre formado por tabla_columna_index.
            //ejemplo messages_created_at_index.
            $table->dropIndex('my_created_at_index');
        });
    }
}
