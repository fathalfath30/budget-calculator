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

use App\Domain\Entity\Password;

/**
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\IEntity
 * @see \App\Domain\Entity\Password
 *
 * @author Fathalfath30
 */
trait PasswordTestData {

  /**
   * Return sample password or confirm_password value
   *
   * @return string
   */
  public function getSamplePassword() : string {
    return "Lupa@123";
  }

  /**
   * Return sample password_updated_at value
   *
   * @return string
   */
  public function getSamplePasswordUpdatedAt() : string {
    return "2024-01-01 23:59:59";
  }

  /**
   * @return int
   */
  public function getSampleFailAttempts() : int  {
    return 1;
  }

  /**
   * Return valid sample Password entity
   *
   * @param $withConfirm bool
   *
   * @return \App\Domain\Entity\Password
   */
  public function getPasswordEntity(bool $withConfirm = false) : Password {
    return Password::rebuild($this->getSamplePassword(), (($withConfirm) ? $this->getSamplePassword() : null),
      $this->getSamplePasswordUpdatedAt());
  }
}
