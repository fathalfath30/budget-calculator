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
use Carbon\Traits\Timestamp;

trait RoleTestData {
  use Timestamp;
  public function ValidRoleId(bool $admin = false) : string {
    return ($admin) ?
      '8723b59f-10a9-4b79-9b04-11cdd8bd164c' : '06a11a2f-3dc6-4455-9ab9-5003c5f66128';
  }

  public function ValidRoleName(bool $admin = false) : string {
    return "Test Role " . ($admin) ? "Admin" : "Guest";
  }

  /**
   * @throws \App\Exceptions\EntityException
   * @throws \Illuminate\Validation\ValidationException
   */
  public function ValidRoleEntity(bool $admin = false) : Role {
    return (new Role(
      [
        Role::ID => $this->ValidRoleId($admin),
        Role::NAME => $this->ValidRoleName($admin),
        Role::LEVEL => $admin ? Role::USER_LEVEL_SUPER_ADMIN : Role::USER_LEVEL_GUEST,
        Role::TIMESTAMP => $this->ValidTimestampEntity()
      ],
      false)
    );
  }
}
