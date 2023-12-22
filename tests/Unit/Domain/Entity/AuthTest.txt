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
use App\Exceptions\EntityValidationException;
use Tests\TestCase;
use Tests\TestData\AuthTestData;

/**
 * AuthTest
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\Timestamp
 */
class AuthTest extends TestCase {
  use AuthTestData;

  // <editor-fold desc="validationCheck::password">

  /**
   * Test the validation on each input
   *
   * @return void
   * @test
   * @testdox validate password is required
   */
  public function validatePasswordIsRequired() : void {
    try {
      (new Auth(''))
        ->validatePasswordFormat();
    } catch(EntityValidationException $e) {
      $this->assertInstanceOf(EntityValidationException::class, $e);
      $this->assertEquals(trans('validation.required', ['attribute' => Auth::PASSWORD]), $e->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
      $this->assertEquals(400, $e->getCode());
    }
  }

  /**
   * @return void
   * @test
   * @testdox validate password must have minimum eight character
   */
  public function validatePasswordMustHaveMinimumEightCharacter() : void {
    try {
      (new Auth('admin'))
        ->validatePasswordFormat();
    } catch(EntityValidationException $e) {
      $this->assertInstanceOf(EntityValidationException::class, $e);
      $this->assertEquals(trans('validation.regex', ['attribute' => Auth::PASSWORD]), $e->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
      $this->assertEquals(400, $e->getCode());
    }
  }

  /**
   * @return void
   * @test
   * @testdox validate password must have at least one upper case letter
   */
  public function passwordMustHaveAtLeastOneUpperCaseLetter() : void {
    try {
      (new Auth('admin123'))
        ->validatePasswordFormat();
    } catch(EntityValidationException $e) {
      $this->assertInstanceOf(EntityValidationException::class, $e);
      $this->assertEquals(trans('validation.regex', ['attribute' => Auth::PASSWORD]), $e->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
      $this->assertEquals(400, $e->getCode());
    }
  }

  /**
   * @return void
   * @test
   * @testdox validate password must have at least one lower case letter
   */
  public function validatePasswordMustHaveAtLeastOneLowerCaseLetter() : void {
    try {
      (new Auth('A1234567890'))
        ->validatePasswordFormat();
    } catch(EntityValidationException $e) {
      $this->assertInstanceOf(EntityValidationException::class, $e);
      $this->assertEquals(trans('validation.regex', ['attribute' => Auth::PASSWORD]), $e->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
      $this->assertEquals(400, $e->getCode());
    }
  }

  /**
   * @return void
   * @test
   * @testdox validate password must have at least one number
   */
  public function validatePasswordMustHaveAtLeastOneNumber() : void {
    try {
      (new Auth('Abcdswewfqw'))
        ->validatePasswordFormat();
    } catch(EntityValidationException $e) {
      $this->assertInstanceOf(EntityValidationException::class, $e);
      $this->assertEquals(trans('validation.regex', ['attribute' => Auth::PASSWORD]), $e->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
      $this->assertEquals(400, $e->getCode());
    }
  }

  /**
   * @return void
   * @test
   * @testdox validate password must have at least one special character
   */
  public function validatePasswordMustHaveAtLeastOneSpecialCharacter() : void {
    try {
      (new Auth('Ab1weqsfw'))
        ->validatePasswordFormat();
    } catch(EntityValidationException $e) {
      $this->assertInstanceOf(EntityValidationException::class, $e);
      $this->assertEquals(trans('validation.regex', ['attribute' => Auth::PASSWORD]), $e->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
      $this->assertEquals(400, $e->getCode());
    }
  }
  // </editor-fold>
  // <editor-fold desc="validationCheck::locked_at">
  /**
   * @return void
   *
   * @test
   * @testdox validate if locked_at is not empty it must validate format
   */
  public function validateIfLockedAtIsNotEmptyItMustValidateFormat() : void {
    try {
      (new Auth($this->getValidPassword(), "loremipsum"))
        ->validatePasswordFormat();
    } catch(EntityValidationException $e) {
      $this->assertInstanceOf(EntityValidationException::class, $e);
      $this->assertEquals(trans('validation.date_format', [
        'attribute' => Auth::LOCKED_AT, 'format' => 'Y-m-d H:i:s'
      ]), $e->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
      $this->assertEquals(400, $e->getCode());
    }
  }

  // </editor-fold>
  // <editor-fold desc="validationCheck::login_fail_attempt">
  /**
   * @return void
   * @test
   * @testdox validate login_fail_attempt must be a number
   */
  public function loginFailAttemptMustBeANumber() : void {
    try {
      (new Auth($this->getValidPassword(), $this->getValidLockedAt(), 'abc'))
        ->validatePasswordFormat();
    } catch(EntityValidationException $e) {
      $this->assertInstanceOf(EntityValidationException::class, $e);
      $this->assertEquals(trans('validation.regex', ['attribute' => Auth::LOGIN_FAIL_ATTEMPT]), $e->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
      $this->assertEquals(400, $e->getCode());
    }
  }

  /**
   * @return void
   * @test
   * @testdox validate login_fail_attempt must be greater or equals then zero
   */
  public function validateLoginFailAttemptMustBeGreaterOrEqualsThanZero() : void {
    try {
      (new Auth($this->getValidPassword(), $this->getValidLockedAt(), '-1'))
        ->validatePasswordFormat();
    } catch(EntityValidationException $e) {
      $this->assertInstanceOf(EntityValidationException::class, $e);
      $this->assertEquals(trans('validation.regex', ['attribute' => Auth::LOGIN_FAIL_ATTEMPT]), $e->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
      $this->assertEquals(400, $e->getCode());
    }
  }

  /**
   * @return void
   * @test
   * @testdox validate login fail attempt must be less or equals than five
   */
  public function validateLoginFailAttemptMustBeLessOrEqualsThanFive() : void {
    try {
      (new Auth($this->getValidPassword(), $this->getValidLockedAt(), '88'))
        ->validatePasswordFormat();
    } catch(EntityValidationException $e) {
      $this->assertInstanceOf(EntityValidationException::class, $e);
      $this->assertEquals(trans('validation.max.numeric', [
        'attribute' => Auth::LOGIN_FAIL_ATTEMPT,
        'max' => Auth::MAX_LOGIN_ATTEMPT
      ]), $e->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
      $this->assertEquals(400, $e->getCode());
    }
  }
  // </editor-fold>

  /**
   * @return void
   * @throws \App\Exceptions\EntityValidationException
   *
   * @test
   */
  public function itMustHaveBasicGetterToGetObjectValue() : void {
    $entity = $this->getValidAuthEntity();

    $this->assertEquals($this->getValidPassword(), $entity->getPassword());
    $this->assertEquals($this->getValidLockedAt(), $entity->getLockedAt());
    $this->assertTrue($entity->isLocked());
    $this->assertEquals($this->getValidLoginFailedAttempt(), $entity->getLoginFailAttempt());
  }

  /**
   * @return void
   * @throws \App\Exceptions\EntityValidationException
   *
   * @test
   * @testdox getValidLoginFailedAttempt must return null if locked_at is not set or empty or null
   */
  public function getLockedAtMustReturnNullIfNotSetOrNullOrEmptyString() : void {
    $entity = new Auth($this->getValidPassword(), null, $this->getValidLoginFailedAttempt());
    $this->assertNull($entity->getLockedAt());

    $entity = new Auth($this->getValidPassword(), '', $this->getValidLoginFailedAttempt());
    $this->assertNull($entity->getLockedAt());
  }


  /**
   * @return void
   * @throws \App\Exceptions\EntityValidationException
   *
   * @test
   * @testdox getLoginFailAttempt must zero null if login_fail_attempt is not set
   */
  public function getLoginFailAttemptMustReturnZeroIfNotSetOrNullOrEmptyString() : void {
    $entity = new Auth($this->getValidPassword(), null, 0);
    $this->assertEquals(0, $entity->getLoginFailAttempt());

    $entity = new Auth($this->getValidPassword());
    $this->assertEquals(0, $entity->getLoginFailAttempt());
  }
}
