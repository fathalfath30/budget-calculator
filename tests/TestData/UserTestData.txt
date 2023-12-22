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

use App\Domain\Entity\User as UserEntity;

/**
 * UserTestData
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\User
 */
trait UserTestData {
  use UserRoleTestData, AuthTestData, UserInfoTestData, TimestampTestData;

  /**
   * @return string
   */
  public function getValidUserId() : string {
    return "40797635-7cad-4e9a-8159-2f09191e1061";
  }

  /**
   * @return \App\Domain\Entity\User
   * @throws \App\Exceptions\EntityValidationException
   */
  public function getValidUserEntity() : UserEntity {
    return new UserEntity(
      $this->getValidUserId(),
      $this->getValidSuperAdminRole(),
      $this->getValidAuthEntity(),
      $this->getValidUserInfoEntity(true),
      $this->getValidTimestampEntity()
    );
  }
}
