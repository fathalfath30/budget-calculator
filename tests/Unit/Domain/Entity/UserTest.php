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

namespace Tests\Unit\Domain\Entity;

use App\Domain\Entity\Auth;
use App\Domain\Entity\Role;
use App\Domain\Entity\Timestamp;
use App\Domain\Entity\User;
use App\Domain\Entity\UserInfo;
use App\Exceptions\EntityValidationException;
use Tests\TestCase;
use Tests\TestData\AuthTestData;
use Tests\TestData\TimestampTestData;
use Tests\TestData\UserInfoTestData;
use Tests\TestData\UserRoleTestData;
use Tests\TestData\UserTestData;

/**
 * TimestampTest
 *
 * This class is used to testing some business rules for Timestamp entity, for example
 * testing __constructor and validation and more.
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\Timestamp
 */
class UserTest extends TestCase {
  use UserTestData, UserRoleTestData, AuthTestData, UserInfoTestData, TimestampTestData;

  /**
   * @return void
   * @throws \App\Exceptions\EntityValidationException
   */
  public function testIdIsRequired() : void {
    $this->expectException(EntityValidationException::class);
    $this->expectExceptionMessage(trans("validation.required", ['attribute' => 'id']));
    $this->expectExceptionCode(400);

    new User('', $this->getValidSuperAdminRole(), $this->getValidAuthEntity(), $this->getValidUserInfoEntity(),
      $this->getValidTimestampEntity());
  }

  /**
   * @return void
   * @throws \App\Exceptions\EntityValidationException
   */
  public function testIdIsRequiredAndAlsoValidateWhitespace() {
    $this->expectException(EntityValidationException::class);
    $this->expectExceptionMessage(trans("validation.required", ['attribute' => 'id']));

    new User(' ', $this->getValidSuperAdminRole(), $this->getValidAuthEntity(), $this->getValidUserInfoEntity(),
      $this->getValidTimestampEntity());
  }

  /**
   * @return void
   * @throws \App\Exceptions\EntityValidationException
   */
  public function testItShouldHaveMainGetterForTheProps() {
    $user = new User($this->getValidUserId(), $this->getValidSuperAdminRole(), $this->getValidAuthEntity(), $this->getValidUserInfoEntity(),
      $this->getValidTimestampEntity());

    $this->assertEquals($this->getValidUserId(), $user->getId());
    $this->assertEquals($this->getValidSuperAdminRole(), $user->getRole());
    $this->assertIsArray($user->getRole());
    for($i = 0; $i < count($user->getRole()); $i++) {
      $this->assertInstanceOf(Role::class, $user->getRole()[$i]);
    }

    $this->assertEquals($this->getValidAuthEntity(), $user->getAuth());
    $this->assertInstanceOf(Auth::class, $user->getAuth());

    $this->assertEquals($this->getValidUserInfoEntity(), $user->getUserInfo());
    $this->assertInstanceOf(UserInfo::class, $user->getUserInfo());

    $this->assertEquals($this->getValidTimestampEntity(), $user->getTimestamp());
    $this->assertInstanceOf(Timestamp::class, $user->getTimestamp());
  }
}
