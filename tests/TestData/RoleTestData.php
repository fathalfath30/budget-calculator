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

use App\Domain\Entity\Role;
use App\Domain\Entity\Traits\Entity;

/**
 * RoleTestData
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\Timestamp
 * @see \Tests\TestData\TimestampTestData
 */
trait RoleTestData {
  use TimestampTestData;

  /**
   * Return valid sample role id
   *
   * @param bool $admin
   *
   * @return string
   */
  public function getValidRoleId(bool $admin = false) : string {
    return ($admin) ?
      '8723b59f-10a9-4b79-9b04-11cdd8bd164c' : '06a11a2f-3dc6-4455-9ab9-5003c5f66128';
  }

  /**
   * Return valid sample role name
   *
   * @param bool $admin
   *
   * @return string
   */
  public function getValidRoleName(bool $admin = false) : string {
    return "Test Role " . ($admin) ? "Admin" : "Guest";
  }

  /**
   * Return valid sample role entity
   *
   * @throws \App\Exceptions\EntityException
   * @throws \Illuminate\Validation\ValidationException
   */
  public function getValidRoleEntity(bool $admin = false) : Role {
    return (new Role(
      [
        Role::ID => $this->getValidRoleId($admin),
        Role::NAME => $this->getValidRoleName($admin),
        Role::LEVEL => $admin ? Role::USER_LEVEL_SUPER_ADMIN : Role::USER_LEVEL_GUEST,
        Entity::TIMESTAMP => $this->getValidTimestampEntity()
      ],
      false)
    );
  }
}
