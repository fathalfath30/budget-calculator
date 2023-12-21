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

use Throwable;

/**
 * EntityException
 *
 * This entity should be used on every EntityClass if error happened, as default
 * it will return bad request status code
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 * @see \App\Exceptions\F30Exception
 */
class RepositoryException extends F30Exception {
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
  public function __construct(string $message = "Unhandled repository exception", int $code = 500, ?Throwable $previous = null) {
    parent::__construct($message, $code, $previous);
    // set default status code
    $this->statusCode = config('response_code.server.error.internal');
  }
}
