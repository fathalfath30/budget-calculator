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

use App\Domain\Entity\UserInfo;

/**
 * UserInfoTestData
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\UserInfo
 */
trait UserInfoTestData {

  /**
   * Valid first name
   *
   * @return string
   */
  public function getValidFirstName() : string {
    return "Lorem";
  }

  /**
   * Valid last name
   *
   * @return string
   */
  public function getValidLastName() : string {
    return "Ipsum";
  }

  /**
   * Return valid username
   *
   * @return string
   */
  public function getValidUsername() : string {
    return "Fathalfath30";
  }

  /**
   * Return valid user email
   *
   * @return string
   */
  public function getValidEmail() : string {
    return "fathalfath30@gmail.com";
  }

  /**
   * Valid UserInfo Entity
   *
   * @param bool $last_name
   *
   * @return \App\Domain\Entity\UserInfo
   * @throws \App\Exceptions\EntityValidationException
   */
  public function getValidUserInfoEntity(bool $last_name = false) : UserInfo {
    $last_name = null;
    if(!$last_name) {
      $last_name = $this->getValidLastName();
    }
    return new UserInfo($this->getValidFirstName(), $last_name, $this->getValidUsername(),
      $this->getValidEmail());
  }
}
