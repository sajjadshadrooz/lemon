<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\NotFoundHttpExeption;
use Throwable;
use App\Traits\ApiResponser;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{

    use ApiResponser;

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // public function render($request, Throwable $error)
    // {
        
    //     if($error instanceof ModelNotFoundException){
    //         return $this->errorResponser(404, $error->getMessage());
    //     }
        
    //     if($error instanceof NotFoundHttpException){
    //         return $this->errorResponser(404, $error->getMessage());
    //     }

    //     if(config('app.debug'))
    //     {
    //         return $this->errorResponser(500, $error->getMessage());
    //     }
    //     return $this->errorResponser(500, 'Somethings got wrong in server.');
    // }
}
