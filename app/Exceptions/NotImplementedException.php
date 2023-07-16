<?php
/*
//
//  ______    _   _           _  __      _   _     ____   ___
// |  ____|  | | | |         | |/ _|    | | | |   |___ \ / _ \
// | |__ __ _| |_| |__   __ _| | |_ __ _| |_| |__   __) | | | |
// |  __/ _` | __| '_ \ / _` | |  _/ _` | __| '_ \ |__ <| | | |
// | | | (_| | |_| | | | (_| | | || (_| | |_| | | |___) | |_| |
// |_|  \__,_|\__|_| |_|\__,_|_|_| \__,_|\__|_| |_|____/ \___/
//
// Written by Fathalfath30.
// Email : fathalfath30@gmail.com
// Follow me on:
//  Github : https://github.com/fathalfath30
//  Gitlab : https://gitlab.com/Fathalfath30
//
*/

namespace App\Exceptions;

use Exception;
use Throwable;

/**
 * NotImplementedException
 *
 * This exception should use on some method, function or controller in case
 * their just a template, and not ready to implement yet
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 * @see \App\Exceptions\F30Exception
 */
class NotImplementedException extends F30Exception {
  /**
   * @param string $message
   * @param int $code
   * @param null|\Throwable $previous
   *
   * @author Fathalfath30
   * @version 1.0.0
   * @since 1.0.0
   * @see \App\Exceptions\F30Exception
   */
  public function __construct(string $message = "Not implemented", int $code = 503, ?Throwable $previous = null) {
    parent::__construct($message, $code, $previous);
    // set default status code
    $this->statusCode = config('response_code.server.error.not_implemented');
  }
}
