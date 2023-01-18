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

namespace App\Domain\Entity;

use App\Traits\StandardEntity;

/**
 * Role entity will hold all role information, that will be used
 * by user entity, and also this entity require Timestamp.
 *
 * @version 1.0.0
 * @since 0.1.0-alpha
 *
 * @see \App\Traits\StandardEntity
 * @see \App\Domain\Entity\Timestamp
 *
 * @author Fathalfath30
 */
class Role implements IStandardEntity {
  use StandardEntity;

  /**
   * @throws \App\Exceptions\EntityException
   * @version 1.0.0
   * @since 1.0.0
   */
  public static function create(string $id, string $name, Timestamp $timestamp) : self {
    $class = new self;

    $class->setId($id);
    $class->setName($name);
    $class->setTimestamp($timestamp);

    return $class;
  }
}
