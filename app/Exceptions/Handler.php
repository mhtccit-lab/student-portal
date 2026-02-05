<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Database\QueryException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        //500 error handling
        if ($exception instanceof QueryException) {
            return response()->view('errors.500', [], 500);
        }

        return parent::render($request, $exception);

        //419 error handling
        if ($exception instanceof TokenMismatchException) {
            return response()->view('errors.419', [], 419);
        }

        return parent::render($request, $exception);
        }
}
