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

use App\Domain\Entity\Role;
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


  // <editor-fold desc="Validation">
  // <editor-fold desc="Validation::FirstName">
  /**
   * @return void
   * @test
   * @testdox firstname is required
   */
  public function firstNameIsRequired() {
    try {
      new UserInfo('', '', '', '');
    } catch(EntityValidationException $e) {
      $this->assertInstanceOf(EntityValidationException::class, $e);
      $this->assertEquals(trans('validation.required', ['attribute' => UserInfo::FIRST_NAME]), $e->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
      $this->assertEquals(400, $e->getCode());
    }
  }

  /**
   * @return void
   * @test
   * @testdox first name must have valid format
   */
  public function firstNameMustHaveValidFormat() {
    try {
      new UserInfo('lorem1psum', '', '', '');
    } catch(EntityValidationException $e) {
      $this->assertInstanceOf(EntityValidationException::class, $e);
      $this->assertEquals(trans('validation.regex', ['attribute' => UserInfo::FIRST_NAME]), $e->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
      $this->assertEquals(400, $e->getCode());
    }

    try {
      new UserInfo('lorem 1psum', '', '', '');
    } catch(EntityValidationException $e) {
      $this->assertInstanceOf(EntityValidationException::class, $e);
      $this->assertEquals(trans('validation.regex', ['attribute' => UserInfo::FIRST_NAME]), $e->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
      $this->assertEquals(400, $e->getCode());
    }

    try {
      new UserInfo('lorem @psum', '', '', '');
    } catch(EntityValidationException $e) {
      $this->assertInstanceOf(EntityValidationException::class, $e);
      $this->assertEquals(trans('validation.regex', ['attribute' => UserInfo::FIRST_NAME]), $e->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
      $this->assertEquals(400, $e->getCode());
    }

    try {
      new UserInfo('lorem.', '', '', '');
    } catch(EntityValidationException $e) {
      $this->assertInstanceOf(EntityValidationException::class, $e);
      $this->assertEquals(trans('validation.regex', ['attribute' => UserInfo::FIRST_NAME]), $e->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
      $this->assertEquals(400, $e->getCode());
    }
  }
  // </editor-fold>
  // <editor-fold desc="Validation::LastName">
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

  /**
   * @return void
   * @test
   * @testdox validate last name if not empty
   */
  public function validateLastNameIfNotEmpty() {
    try {
      new UserInfo($this->getValidFirstName(), 'lorem1psum', '', '');
    } catch(EntityValidationException $e) {
      $this->assertInstanceOf(EntityValidationException::class, $e);
      $this->assertEquals(trans('validation.regex', ['attribute' => UserInfo::LAST_NAME]), $e->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
      $this->assertEquals(400, $e->getCode());
    }

    try {
      new UserInfo($this->getValidFirstName(), 'lorem 1psum', '', '');
    } catch(EntityValidationException $e) {
      $this->assertInstanceOf(EntityValidationException::class, $e);
      $this->assertEquals(trans('validation.regex', ['attribute' => UserInfo::LAST_NAME]), $e->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
      $this->assertEquals(400, $e->getCode());
    }

    try {
      new UserInfo($this->getValidFirstName(), 'lorem @psum', '', '');
    } catch(EntityValidationException $e) {
      $this->assertInstanceOf(EntityValidationException::class, $e);
      $this->assertEquals(trans('validation.regex', ['attribute' => UserInfo::LAST_NAME]), $e->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
      $this->assertEquals(400, $e->getCode());
    }

    try {
      new UserInfo($this->getValidLastName(), 'lorem.', '', '');
    } catch(EntityValidationException $e) {
      $this->assertInstanceOf(EntityValidationException::class, $e);
      $this->assertEquals(trans('validation.regex', ['attribute' => UserInfo::LAST_NAME]), $e->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
      $this->assertEquals(400, $e->getCode());
    }
  }
  // </editor-fold>
  // <editor-fold desc="Validation::Username">
  /**
   * @return void
   * @test
   * @testdox validate username is required
   */
  public function validateUsernameIsRequired() {
    try {
      new UserInfo($this->getValidFirstName(), $this->getValidLastName(),
        '', '');
    } catch(EntityValidationException $e) {
      $this->assertInstanceOf(EntityValidationException::class, $e);
      $this->assertEquals(trans('validation.required', ['attribute' => UserInfo::USERNAME]), $e->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
      $this->assertEquals(400, $e->getCode());
    }
  }

  /**
   * @return void
   * @test
   * @testdox validate username format
   */
  public function validateUsernameFormat() {
    try {
      new UserInfo($this->getValidFirstName(), $this->getValidLastName(),
        'lorem_.', '');
    } catch(EntityValidationException $e) {
      $this->assertInstanceOf(EntityValidationException::class, $e);
      $this->assertEquals(trans('validation.regex', ['attribute' => UserInfo::USERNAME]), $e->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
      $this->assertEquals(400, $e->getCode());
    }
    try {
      new UserInfo($this->getValidFirstName(), $this->getValidLastName(),
        'lorem_ ', '');
    } catch(EntityValidationException $e) {
      $this->assertInstanceOf(EntityValidationException::class, $e);
      $this->assertEquals(trans('validation.regex', ['attribute' => UserInfo::USERNAME]), $e->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
      $this->assertEquals(400, $e->getCode());
    }
  }
  // </editor-fold>
  // <editor-fold desc="Validation::Email">
  /**
   * @return void
   * @test
   * @testdox validate email is required
   */
  public function validateEmailIsRequired() {
    try {
      new UserInfo($this->getValidFirstName(), $this->getValidLastName(),
        $this->getValidUsername(), '');
    } catch(EntityValidationException $e) {
      $this->assertInstanceOf(EntityValidationException::class, $e);
      $this->assertEquals(trans('validation.email', ['attribute' => UserInfo::EMAIL]), $e->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
      $this->assertEquals(400, $e->getCode());
    }
  }
  // </editor-fold>
  // </editor-fold>
}
