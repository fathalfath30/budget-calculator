<?php

namespace App\Exceptions;

use App\Utils\Http\ResponseFormat;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Handler
 *
 * This class will handle exception error
 */
class Handler extends ExceptionHandler {
  /**
   * The list of the inputs that are never flashed to the session on validation exceptions.
   *
   * @var array<int, string>
   */
  protected $dontFlash = ['current_password', 'password', 'password_confirmation'];

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

  /**
   * @param \Throwable $e
   *
   * @return \Illuminate\Http\Response|bool|\Illuminate\Http\JsonResponse|string|\Symfony\Component\HttpFoundation\Response
   */
  private function handleJsonException(Throwable $e) : \Illuminate\Http\Response|bool|JsonResponse|string|Response {
    switch(get_class($e)) {
      case ValidationException::class:
      {
        $httpCode = ResponseFormat::HttpBadRequest;
        $statusCode = config("response_code.user.error.bad_request");
        break;
      }
      default:
      {
        $httpCode = ResponseFormat::HttpOk;
        $statusCode = config("response_code.server.error.internal");
        break;
      }
    }

    return response()
      ->json(ResponseFormat::create($httpCode, $statusCode, $e->getMessage()), $httpCode, [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json'
      ]);
  }
}
