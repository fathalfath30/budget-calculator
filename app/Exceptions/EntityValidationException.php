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

/**
 * EntityValidationException
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 * @see \App\Exceptions\F30Exception
 */
class EntityValidationException extends F30Exception {
  /**
   * @param string $message
   * @param array $replace
   */
  public function __construct(string $message = "Unhandled entity exception", array $replace = []) {
    parent::__construct(trans($message, $replace), 400);
    $this->statusCode = config('response_code.user.error.bad_request');
  }
}
