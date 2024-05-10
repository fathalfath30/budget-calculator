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

use App\Domain\Entity\Traits\Entity;
use App\Domain\Entity\Traits\ToArray;

/**
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\IEntity
 * @see \App\Domain\Entity\Traits\Entity
 * @see \App\Domain\Entity\Traits\ToArray
 *
 * @author Fathalfath30
 */
class Auth extends Entity implements IEntity {
  use ToArray;

  /** @var null|\App\Domain\Entity\Password $password */
  private ?Password $password;

  /** @var null|\App\Domain\Entity\Pin $pin */
  private ?Pin $pin;

  /**
   * @param null|\App\Domain\Entity\Password $password
   * @param null|\App\Domain\Entity\Pin $pin
   *
   * @return \App\Domain\Entity\Auth
   */
  public static function rebuild(?Password $password = null, ?Pin $pin = null) : Auth {
    $cls = new self;
    $cls->password = $password;
    $cls->pin = $pin;

    return $cls;
  }

  /**
   * Get password entity
   *
   * @return null|\App\Domain\Entity\Password
   */
  public function getPassword() : ?Password {
    return $this->password;
  }

  /**
   * @return null|\App\Domain\Entity\Pin
   */
  public function getPin() : ?Pin {
    return $this->pin;
  }
}
