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

namespace App\Domain\Entity\Traits;

/**
 * ToArray
 *
 * This trait is used to convert object class to array
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 */
trait ToArray {
  /**
   * @return array
   * @author Fathalfath30
   * @version 1.0.0
   * @since 1.0.0
   */
  public function toArray() : array {
    return get_object_vars($this);
  }
}
