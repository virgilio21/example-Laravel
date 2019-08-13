<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {   
        //Por defecto existen excepciones 500 que no son http y que por esta razon no podemos redigir a un vista cuando estas suceden es por eso, que usamos el archivo handler.php
        //Para controlar esas excepciones.

        //si la excepcion no es HTTP y el modo de aplicacion osea el APP_DEBUG en el env es false se ejecuta el codigo. de conversion.

        if( !$exception instanceof HttpException && !config('app.debug')){

            //Si se encuentra una excepcion 500 y no es Http, la convertimos a http
            //El constructor resive el tipo de excepcion 500, el mensaje, y si existe una excepcion anterior en este caso si, le pasamos $exception.
            $exception = new HttpException(500, $exception->getMessage(), $exception);
        }
        return parent::render($request, $exception);
    }
}
