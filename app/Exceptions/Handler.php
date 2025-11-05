<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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
   public function render($request, Throwable $exception)
{
    if ($this->isHttpException($exception)) {
        $status = $exception->getStatusCode();
        if (view()->exists("errors.{$status}")) {
            return response()->view("errors.{$status}", [], $status);
        }
    }
    return parent::render($request, $exception);
}

}
