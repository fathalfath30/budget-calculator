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
use App\Domain\Entity\Email;
use App\Domain\Entity\Role;
use App\Domain\Entity\Timestamp;
use App\Domain\Entity\User;
use App\Domain\Entity\UserProfile;
use Illuminate\Support\Carbon;
use Tests\TestCase;
use Tests\TestData\AuthTestData;
use Tests\TestData\EmailTestData;
use Tests\TestData\RoleTestData;
use Tests\TestData\TimestampTestData;
use Tests\TestData\UserProfileTestData;

/**
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\IEntity
 * @see \App\Domain\Entity\Traits\Entity
 * @see \App\Domain\Entity\Traits\ToArray
 *
 * @author Fathalfath30
 */
class UserTest extends TestCase {
  use UserProfileTestData, EmailTestData, AuthTestData, RoleTestData, TimestampTestData;

  /**
   * @return void
   * @throws \App\Exceptions\EntityValidationException
   * @throws \Illuminate\Validation\ValidationException
   *
   * @test
   * @testdox it can create new user
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function itCanCreateNewUser() {
    $result = User::create($this->getSampleUserProfileEntity(), $this->getSampleEmailEntity(),
      $this->getSampleAuthEntity(), $this->getSampleRoleEntity());

    $this->assertNotNull($result);
    $this->assertInstanceOf(User::class, $result);
    $this->assertNotNull($result->getProfile());
    $this->assertInstanceOf(UserProfile::class, $result->getProfile());
    $this->assertNotNull($result->getEmail());
    $this->assertInstanceOf(Email::class, $result->getEmail());
    $this->assertNotNull($result->getAuth());
    $this->assertInstanceOf(Auth::class, $result->getAuth());
    $this->assertNotNull($result->getRole());
    $this->assertinstanceof(Role::class, $result->getRole());
    $this->assertNull($result->getLockedAt());
    $this->assertNotNull($result->getTimestamp());
    $this->assertInstanceOf(Timestamp::class, $result->getTimestamp());
  }

  /**
   * @return void
   * @throws \App\Exceptions\EntityValidationException
   * @throws \Illuminate\Validation\ValidationException
   *
   * @test
   * @testdox it can rebuild user entity
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function itCanRebuildUserEntity() {
    $result = User::rebuild($this->getSampleUserProfileEntity(), $this->getSampleEmailEntity(),
      $this->getSampleAuthEntity(), $this->getSampleRoleEntity(), $this->getSampleDateTimeCarbon(),
      $this->getSampleTimestampEntity());

    $this->assertNotNull($result);
    $this->assertInstanceOf(User::class, $result);
    $this->assertNotNull($result->getProfile());
    $this->assertInstanceOf(UserProfile::class, $result->getProfile());
    $this->assertNotNull($result->getEmail());
    $this->assertInstanceOf(Email::class, $result->getEmail());
    $this->assertNotNull($result->getAuth());
    $this->assertInstanceOf(Auth::class, $result->getAuth());
    $this->assertNotNull($result->getRole());
    $this->assertinstanceof(Role::class, $result->getRole());
    $this->assertNotNull($result->getLockedAt());
    $this->assertTrue($result->isLocked());
    $this->assertInstanceOf(Carbon::class, $result->getLockedAt());
    $this->assertNotNull($result->getTimestamp());
    $this->assertInstanceOf(Timestamp::class, $result->getTimestamp());
  }
}
