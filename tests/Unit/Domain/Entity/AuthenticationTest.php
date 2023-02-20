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

use App\Domain\Entity\Authentication;
use App\Domain\Entity\Role;
use App\Exceptions\EntityException;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\TestCase;
use Tests\Data\RoleTestData;
use Tests\Data\UserTestData;

class AuthenticationTest extends TestCase {
  public function testItCanCreateAuthentication() {
    $class = Authentication::create(
      UserTestData::validUserPassword(),
      RoleTestData::validRoleEntity(),
      UserTestData::validPasswordUpdatedAt(),
      UserTestData::validRememberToken()
    );

    $this->assertInstanceOf(Authentication::class, $class);
    $this->assertEquals(UserTestData::validUserPassword(), $class->getPassword());

    $this->assertInstanceOf(Carbon::class, $class->getValidPasswordUpdatedAt());
    $this->assertEquals(UserTestData::validPasswordUpdatedAt(), $class->getValidPasswordUpdatedAt());

    $this->assertInstanceOf(Role::class, $class->getRole());
    $this->assertEquals(UserTestData::validRememberToken(), $class->getRememberToken());
  }

  public function testPasswordIsRequired() {
    $this->expectException(EntityException::class);
    $this->expectExceptionMessage("entity.password.required");

    Authentication::create("", RoleTestData::validRoleEntity(), UserTestData::validPasswordUpdatedAt(),
      UserTestData::validRememberToken());
  }

  public function testPasswordMustHaveMinimum6Character() {
    $this->expectException(EntityException::class);
    $this->expectExceptionMessage("entity.password.min");

    Authentication::create("pass", RoleTestData::validRoleEntity(), UserTestData::validPasswordUpdatedAt(),
      UserTestData::validRememberToken());
  }
}
