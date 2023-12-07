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
   */
  public function checkPasswordRequired() : void {
    $this->expectException(EntityValidationException::class);
    $this->expectExceptionMessage(trans('validation.required', ['attribute' => Auth::PASSWORD]));
    new Auth('');

    try {
      new Auth('');
    } catch(EntityValidationException $e) {
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
    }
  }

  /**
   * @return void
   * @test
   */
  public function passwordMustHaveMinimumEightCharacter(): void {
    $this->expectException(EntityValidationException::class);
    $this->expectExceptionMessage(trans('validation.regex', ['attribute' => Auth::PASSWORD]));
    new Auth('admin');

    try {
      new Auth('admin');
    } catch(EntityValidationException $e) {
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
    }
  }

  /**
   * @return void
   * @test
   */
  public function passwordMustHaveAtLeastOneUpperCaseLater() : void {
    $this->expectException(EntityValidationException::class);
    $this->expectExceptionMessage(trans('validation.regex', ['attribute' => Auth::PASSWORD]));
    new Auth('admin123');

    try {
      new Auth('admin123');
    } catch(EntityValidationException $e) {
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
    }
  }

  /**
   * @return void
   * @test
   */
  public function passwordMustHaveAtLeastOneLowerCaseLater() : void {
    $this->expectException(EntityValidationException::class);
    $this->expectExceptionMessage(trans('validation.regex', ['attribute' => Auth::PASSWORD]));
    new Auth('A1234567890');

    try {
      new Auth('A1234567890');
    } catch(EntityValidationException $e) {
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
    }
  }

  /**
   * @return void
   * @test
   */
  public function passwordMustHaveAtLeastOneNumber() : void {
    $this->expectException(EntityValidationException::class);
    $this->expectExceptionMessage(trans('validation.regex', ['attribute' => Auth::PASSWORD]));
    new Auth('Abcdswewfqw');

    try {
      new Auth('Abcdswewfqw');
    } catch(EntityValidationException $e) {
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
    }
  }

  /**
   * @return void
   * @test
   */
  public function passwordMustHaveAtLeastOneSpecialCharacter() : void {
    $this->expectException(EntityValidationException::class);
    $this->expectExceptionMessage(trans('validation.regex', ['attribute' => Auth::PASSWORD]));
    new Auth('Ab1weqsfw');

    try {
      new Auth('Ab1weqsfw');
    } catch(EntityValidationException $e) {
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
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
