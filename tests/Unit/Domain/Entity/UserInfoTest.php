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

use App\Domain\Entity\UserInfo;
use App\Exceptions\EntityValidationException;
use Exception;
use Tests\TestCase;
use Tests\TestData\UserInfoTestData;

/**
 * UserInfoTest
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\Timestamp
 */
class UserInfoTest extends TestCase {
  use UserInfoTestData;

  /**
   * @return void
   * @throws \App\Exceptions\EntityValidationException
   *
   * @test
   * @testdox user info must have basic getter to get object value
   */
  public function userInfoMustHaveBasicGetterToGetObjectValue() : void {
    $entity = $this->getValidUserInfoEntity();

    $this->assertEquals($this->getValidFirstName(), $entity->getFirstName());
    $this->assertEquals($this->getValidLastName(), $entity->getLastName());
    $this->assertEquals($this->getValidUsername(), $entity->getUsername());
    $this->assertEquals($this->getValidEmail(), $entity->getEmail());
  }

  /**
   * @return void
   * @throws \App\Exceptions\EntityValidationException
   *
   * @test
   * @testdox get last name must return null if not set or null or empty string
   */
  public function getLastNameMustReturnNullIfNotSetOrNullOrEmptyString() : void {
    $entity = new UserInfo($this->getValidFirstName(), null, $this->getValidUsername(),
      $this->getValidEmail());
    $this->assertNull($entity->getLastName());

    $entity = new UserInfo($this->getValidFirstName(), '', $this->getValidUsername(),
      $this->getValidEmail());
    $this->assertNull($entity->getLastName());
  }
}
