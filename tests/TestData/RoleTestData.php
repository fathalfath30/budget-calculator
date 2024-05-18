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

/**
 * RoleTestData
 *
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\Timestamp
 * @see \Tests\TestData\TimestampTestData
 * @author Fathalfath30
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
  public function getSampleRoleId(bool $admin = false) : string {
    return ($admin) ? '8723b59f-10a9-4b79-9b04-11cdd8bd164c' : '06a11a2f-3dc6-4455-9ab9-5003c5f66128';
  }

  /**
   * Return valid sample role name
   *
   * @param bool $admin
   *
   * @return string
   */
  public function getSampleRoleName(bool $admin = false) : string {
    return "Test Role " . (($admin) ? "Admin" : "Guest");
  }

  /**
   * Return valid role icon
   *
   * @param bool $nullable
   *
   * @return null|string
   */
  public function getSampleRoleIcon(bool $nullable = false) : ?string {
    return (($nullable) ? null : "icon.jpg");
  }

  /**
   * Return valid sample role entity
   *
   * @param bool $admin
   *
   * @return \App\Domain\Entity\Role
   * @throws \App\Exceptions\EntityValidationException
   * @throws \Illuminate\Validation\ValidationException
   */
  public function getSampleRoleEntity(bool $admin = true) : Role {
    return Role::create($this->getSampleRoleId($admin), $this->getSampleRoleName($admin), $admin,
      $this->getSampleTimestampEntity());
  }
}
