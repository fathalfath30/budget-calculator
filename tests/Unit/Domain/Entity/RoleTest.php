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

namespace Domain\Entity;

use App\Domain\Entity\Role;
use App\Domain\Entity\Timestamp;
use PHPUnit\Framework\TestCase;
use Tests\Data\RoleTestData;
use Tests\Data\TimestampTestData;

class RoleTest extends TestCase {
  public function test_ItCanCreateNewRoleDomain() {
    $role = Role::create(RoleTestData::validRoleId(), RoleTestData::validRoleName(),
      TimestampTestData::validTimestampEntity());

    $this->assertEquals($role->getId(), RoleTestData::validRoleId());
    $this->assertEquals($role->getName(), RoleTestData::validRoleName());

    $this->assertInstanceOf(Timestamp::class, $role->getTimestamp());
    $this->assertEquals(TimestampTestData::validStrTimestamp(), $role->getTimestamp()->getCreatedAt());
    $this->assertEquals(TimestampTestData::validStrTimestamp(), $role->getTimestamp()->getUpdatedAt());
    $this->assertNull($role->getTimestamp()->getDeletedAt());
  }
}
