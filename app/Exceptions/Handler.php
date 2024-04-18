<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Illuminate\Support\Str;

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
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $e)
    {
        if ($e instanceof ModelNotFoundException) {
            $model = str_replace('App\\Models\\', '', $e->getModel());
            $model = preg_split('/(?=[A-Z])/',$model);
            $model = trim(implode(" ", $model));
            return response()->json(['message' => "Nenhum resultado encontrado em $model."], 404);
        } else if ($e instanceof ValidationException) {
            return response()->json(['message' => $e->getMessage(), 'errors' => $e->errors()], 422);
        } else if($e instanceof UnauthorizedHttpException){
            return response()->json(['message' => $e->getMessage()], 401);
        }

        return response()->json(['message' => $e->getMessage()], 500);

//        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->ajax()) {
            return response([
                "message" => "Unauthenticated.",
                "data" => [],
            ], 401);
        }

        return redirect()->to('/login');
    }
}
