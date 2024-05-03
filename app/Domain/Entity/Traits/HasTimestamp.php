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

use App\Domain\Entity\Timestamp;

/**
 * HasName
 *
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\Role
 * @author Fathalfath30
 */
trait HasTimestamp {
  const TIMESTAMP = 'timestamp';

  /** @var \App\Domain\Entity\Timestamp $timestamp */
  private Timestamp $timestamp;

  /**
   * Return timestamp entity
   *
   * @return \App\Domain\Entity\Timestamp
   */
  public function getTimestamp() : Timestamp {
    return $this->timestamp;
  }
}
