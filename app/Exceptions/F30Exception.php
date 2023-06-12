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

/**
 * F30Exception
 *
 * Default F30Exception class
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 * @see \App\Exceptions\F30Exception
 */
class F30Exception extends Exception {
  /** @var string $statusCode */
  protected string $statusCode;

  /**
   * @return string
   *
   * @author Fathalfath30
   * @version 1.0.0
   * @since 1.0.0
   * @see \App\Exceptions\F30Exception
   */
  public function getStatusCode() : string {
    return $this->statusCode;
  }
}
