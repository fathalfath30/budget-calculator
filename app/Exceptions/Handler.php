<?php

namespace App\Exceptions;

use App\Utils\Http\ResponseFormat;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use function PHPUnit\Framework\isInstanceOf;

class Handler extends ExceptionHandler {
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
  public function register() : void {
    $this->reportable(function(Throwable $e) {
      //
    });
  }

  /**
   * @param $request
   * @param \Throwable $e
   *
   * @return false|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response|string|\Symfony\Component\HttpFoundation\Response
   * @throws \Throwable
   */
  public function render($request, Throwable $e) : \Illuminate\Http\Response|bool|JsonResponse|string|Response {
    if($request->ajax() || $request->isJson()) {
      return $this->handleJsonException($e);
    }

    return parent::render($request, $e);
  }

  private function handleJsonException(Throwable $e) : \Illuminate\Http\Response|bool|JsonResponse|string|Response {
    $httpStatus = 200;
    switch(get_class($e)) {
      default:
    }

    return \response()
      ->header('Content-Type', 'application/json');
  }
}
