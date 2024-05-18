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

namespace Tests\TestData;

use App\Domain\Entity\Auth;

/**
 * AuthTestData
 *
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\Auth
 * @author Fathalfath30
 */
trait AuthTestData {
  use PasswordTestData, PinTestData;

  /**
   * @return \App\Domain\Entity\Auth
   * @throws \App\Exceptions\EntityValidationException
   * @throws \Illuminate\Validation\ValidationException
   *
   * @version 1.0.0
   * @since 1.0.0
   *
   * @see \App\Domain\Entity\Password
   * @see \App\Domain\Entity\Pin
   */
  public function getSampleAuthEntity() : Auth {
    return Auth::rebuild($this->getPasswordEntity(), $this->getSamplePinEntity());
  }
}
