<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdColumUsersToMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            //Unsigned nos permite usar un entero sin signo, osea todos positivos
            //se agrega una columna a la tabla messages de tipo entero
            //No olvidar que las llaves que son foraneas deben de tener el mismo tipo de dato que las llaves primarias de la tabla a la que hacen referencia.
            $table->bigInteger('user_id')->unsigned();

            //Asi se agrega la llave foranea a la tabla messages
            $table->foreign('user_id')->references('id')->on('users');
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
            //Se usa una convencion de tipo tabla_columna_foreign, para eliminar la llave foranea
            $table->dropForeign('messages_user_id_foreign');


            //Luego hay que eliminar la columna
            $table->dropColumn('user_id');
        });
    }
}
