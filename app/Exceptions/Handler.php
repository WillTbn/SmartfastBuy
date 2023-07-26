<?php

namespace App\Exceptions;

use App\Http\Requests\ValidateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ValidateRequest;
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof NotFoundHttpException && $request->expectsJson()) {
            return $this->simpleAnswer('error', 'Recurso não encontrado!', 404);
        }
        if ($exception instanceof ModelNotFoundException && $request->expectsJson()) {
            return $this->simpleAnswer('error', 'Recurso não encontrado!', 404);
        }
        return parent::render($request, $exception);
    }
}
