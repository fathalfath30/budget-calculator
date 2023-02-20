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

namespace Tests\Data;

use App\Domain\Entity\Role;

/**
 * This class will hold all test data that will be used for testing purpose
 *
 * @version 1.0.0
 * @since 0.1.0-alpha
 *
 * @see \App\Domain\Entity\Role
 * @author Fathalfath30
 *
 * @codeCoverageIgnore
 */
class RoleTestData {
  /**
   * This method will return valid static role id for unit test
   * purpose
   *
   * @return string valid uuid for role id
   * @version 1.0.0
   * @since 1.0.0
   *
   * @author Fathalfath30
   */
  public static function validRoleId() : string {
    return "08493adb-c8c9-4f96-ad68-36d17727fe77";
  }

  /**
   * This method will return valid static role id for unit test
   * purpose
   *
   * @return string valid uuid for role id
   * @version 1.0.0
   * @since 1.0.0
   *
   * @author Fathalfath30
   */
  public static function validRoleName() : string {
    return "Test Role";
  }

  /**
   * This method will return a valid Role entity
   *
   * @throws \App\Exceptions\EntityException
   * @version 1.0.0
   * @since 1.0.0
   *
   * @author Fathalfath30
   */
  public static function validRoleEntity() : Role {
    return Role::create(
      RoleTestData::validRoleId(),
      RoleTestData::validRoleName(),
      TimestampTestData::validTimestampEntity()
    );
  }
}
