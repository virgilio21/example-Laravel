<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        //Los test tienen tres pasos
        //Preparacion, accion y verificación.
        //En este caso solo hay acción y verificación.
        //Este es un archivo para probar caracteristicas

        //Trae el recurso raiz
        $response = $this->get('/');

        //Prueba que haya dado algun error.
        $response->assertStatus(200);

        //El test pasa si en el html de la pagina se encuentra la palabra Laratter
        $response->assertSee('Laratter');
    }

    //Test para la busqueda de mensajes
    public function testCanSearchForMessages()
    {
        $response = $this->get('/messages?query=Alice');

        $response->assertSee('Alice');
    }
}
