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

trait UserInfoTestData {

  /**
   * Valid first name
   *
   * @return string
   */
  public function ValidFirstName() : string {
    return "Lorem";
  }

  /**
   * Valid last name
   *
   * @return string
   */
  public function ValidLastName() : string {
    return "Ipsum";
  }

  /**
   * Return valid username
   *
   * @return string
   */
  public function ValidUsername() : string {
    return "Fathalfath30";
  }

  /**
   * Return valid user email
   *
   * @return string
   */
  public function ValidEmail() : string {
    return "fathalfath30@gmail.com";
  }

  /**
   * Valid UserInfo Entity
   *
   * @param bool $lastNull
   *
   * @return \App\Domain\Entity\UserInfo
   * @throws \App\Exceptions\EntityException
   * @throws \Illuminate\Validation\ValidationException
   */
  public function ValidUserInfoEntity(bool $lastNull = false) : UserInfo {
    return new UserInfo([
      UserInfo::FIRST_NAME => $this->ValidFirstName(),
      UserInfo::LAST_NAME => ($lastNull) ? null : $this->ValidLastName(),
      UserInfo::USERNAME => $this->ValidUsername(),
      UserInfo::EMAIL => $this->ValidEmail()
    ], false);
  }
}
