<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    // ...

    public function render($request, Throwable $exception)
    {
        // Jika exception adalah 404, tampilkan halaman 404 kustom
        if ($exception instanceof NotFoundHttpException) {
            return response()->view('errors.404', [], 404);
        }

        if ($exception instanceof ForbiddenException) {
            return response()->view('errors.403', [], 403);
        }

        return parent::render($request, $exception);
    }
}
