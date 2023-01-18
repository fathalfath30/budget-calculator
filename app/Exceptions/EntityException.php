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
 * This class is used for entity, whenever some validation error inside
 * entity, it should have thrown this exception
 *
 * @version 1.0.0
 * @since 0.1.0-alpha
 * @author Fathalfath30
 */
class EntityException extends Exception {
  /**
   * @param string $message
   * @param int $code
   * @param \Throwable|null $previous
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function __construct(string $message = "unhandled entity exception", int $code = DEFAULT_ENTITY_EXCEPTION_CODE,
    Throwable $previous = null) {
    parent::__construct($message, $code, $previous);
  }
}
