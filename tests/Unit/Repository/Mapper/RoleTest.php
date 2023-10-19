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

namespace Repository\Mapper;

use App\Domain\Entity\Role as RoleEntity;
use App\Repository\Mapper\Role as RoleMapper;
use App\Repository\Models\Role;
use App\Repository\Models\Role as RoleModel;
use Tests\TestCase;

class RoleTest extends TestCase {
  /**
   * @return void
   * @throws \App\Exceptions\EntityValidationException
   */
  public function testItCanMappingFromModelToRoleEntity() {
    $roleModel = RoleModel::where(['id' => DEFAULT_ROLE_SUPER_ADMIN_ID])->first();
    if(empty($roleModel)) {
      $this->fail("role is empty");
    }

    $role = RoleMapper::fromModelToEntity($roleModel);
    $this->assertInstanceOf(RoleEntity::class, $role);
    $this->assertEquals("Super Administrator", $role->getName());
    $this->assertEquals(RoleEntity::USER_LEVEL_SUPER_ADMIN, $role->getLevel());
  }
}