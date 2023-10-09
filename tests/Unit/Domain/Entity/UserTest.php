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

use App\Domain\Entity\Auth;
use App\Domain\Entity\Role;
use App\Domain\Entity\Timestamp;
use App\Domain\Entity\User;
use App\Domain\Entity\UserInfo;
use App\Exceptions\EntityValidationException;
use Tests\TestCase;
use Tests\TestData\AuthTestData;
use Tests\TestData\RoleTestData;
use Tests\TestData\TimestampTestData;
use Tests\TestData\UserInfoTestData;
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
  use UserTestData, RoleTestData, AuthTestData, UserInfoTestData, TimestampTestData;

  /**
   * @return void
   * @throws \App\Exceptions\EntityException
   * @throws \App\Exceptions\EntityValidationException
   * @throws \Illuminate\Validation\ValidationException
   */
  public function idIsRequired() : void {
    $this->expectException(EntityValidationException::class);
    $this->expectExceptionMessage(trans("validation.required", ['attribute' => 'id']));
    $this->expectExceptionCode(400);

    new User('', $this->getValidRoleEntity(), $this->getValidAuthEntity(), $this->getValidUserInfoEntity(),
      $this->getValidTimestampEntity());
  }

  /**
   * @return void
   * @throws \App\Exceptions\EntityException
   * @throws \Illuminate\Validation\ValidationException
   *
   * @test
   */
  public function idIsRequiredAndAlsoValidateWhitespace() {
    $this->expectException(EntityValidationException::class);
    $this->expectExceptionMessage(trans("validation.required", ['attribute' => 'id']));

    new User(' ', $this->getValidRoleEntity(), $this->getValidAuthEntity(), $this->getValidUserInfoEntity(),
      $this->getValidTimestampEntity());
  }

  /**
   * @return void
   * @throws \App\Exceptions\EntityException
   * @throws \App\Exceptions\EntityValidationException
   * @throws \Illuminate\Validation\ValidationException
   *
   * @test
   */
  public function itShouldHaveMainGetterForTheProps() {
    $user = new User($this->getValidUserId(), $this->getValidRoleEntity(), $this->getValidAuthEntity(), $this->getValidUserInfoEntity(),
      $this->getValidTimestampEntity());

    $this->assertEquals($this->getValidUserId(), $user->getId());
    $this->assertEquals($this->getValidRoleEntity(), $user->getRole());
    $this->assertInstanceOf(Role::class, $user->getRole());

    $this->assertEquals($this->getValidAuthEntity(), $user->getAuth());
    $this->assertInstanceOf(Auth::class, $user->getAuth());

    $this->assertEquals($this->getValidUserInfoEntity(), $user->getUserInfo());
    $this->assertInstanceOf(UserInfo::class, $user->getUserInfo());

    $this->assertEquals($this->getValidTimestampEntity(), $user->getTimestamp());
    $this->assertInstanceOf(Timestamp::class, $user->getTimestamp());
  }
}
