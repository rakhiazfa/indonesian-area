<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
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
     */
    public function register(): void
    {
        // 
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof ModelNotFoundException) return response()->json([
            'message' => 'Model not found.',
        ], 404);

        if ($e instanceof NotFoundHttpException) return response()->json([
            'message' => $e->getMessage(),
        ], 404);

        return parent::render($request, $e);
    }
}
