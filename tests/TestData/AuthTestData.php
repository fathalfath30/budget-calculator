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
use Illuminate\Support\Facades\Hash;

/**
 * AuthTestData
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\Auth
 */
trait AuthTestData {
  /**
   * Get expected valid password: minimum eight characters, at least one uppercase letter, one lowercase letter,
   * one number and one special character
   *
   * @return string
   */
  public function getValidPassword() : string {
    return "Budget@C4lculatoR";
  }

  /**
   * Get valid locked at with format: Y-m-d H:i:s
   *
   * @return string
   */
  public function getValidLockedAt() : string {
    return "2023-01-01 00:00:00";
  }

  /**
   * Get valid total login failed attempt
   *
   * @return int
   */
  public function getValidLoginFailedAttempt() : int {
    return 1;
  }

  /**
   * Get valid auth entity
   *
   * @return \App\Domain\Entity\Auth
   * @throws \App\Exceptions\EntityValidationException
   */
  public function getValidAuthEntity(bool $encrypt = false) : Auth {
    $password = $this->getValidPassword();
    if($encrypt) {
      $password = Hash::make($encrypt);
    }

    return new Auth($password, $this->getValidLockedAt(), $this->getValidLoginFailedAttempt());
  }
}
