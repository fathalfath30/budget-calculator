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

use App\Domain\Entity\Password;
use App\Exceptions\EntityValidationException;
use Exception;
use Nette\Schema\ValidationException;
use Tests\TestCase;
use Tests\TestData\PasswordTestData;

/**
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\Password
 * @see \Tests\TestData\PasswordTestData
 * @author Fathalfath30
 */
class PasswordTest extends TestCase {
  use PasswordTestData;

  /**
   * @return void
   *
   * @test
   * @testdox validate user input
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function validateUserInput() {
    $testCase = [
      [
        'name' => 'password is required',
        'expected' => [
          'message' => trans('validation.required', ['attribute' => 'password'])
        ],
        'payload' => [
          Password::PASSWORD => '',
          Password::CONFIRM_PASSWORD => '',
          Password::PASSWORD_UPDATED_AT => ''
        ]
      ],
      [
        'name' => 'password must have at least 6 character',
        'expected' => [
          'message' => trans('validation.min.string', ['attribute' => 'password', 'min' => '6'])
        ],
        'payload' => [
          Password::PASSWORD => 'admin',
          Password::CONFIRM_PASSWORD => '',
          Password::PASSWORD_UPDATED_AT => ''
        ]
      ],
      [
        'name' => 'confirm password must have at least 6 character if not empty',
        'expected' => [
          'message' => trans('validation.min.string', ['attribute' => Password::CONFIRM_PASSWORD, 'min' => '6'])
        ],
        'payload' => [
          Password::PASSWORD => $this->getSamplePassword(),
          Password::CONFIRM_PASSWORD => 'aa',
          Password::PASSWORD_UPDATED_AT => ''
        ]
      ],
      [
        'name' => 'confirm password must be equals with password if not empty',
        'expected' => [
          'message' => trans('validation.same', [
            'attribute' => Password::CONFIRM_PASSWORD,
            'other' => Password::PASSWORD
          ])
        ],
        'payload' => [
          Password::PASSWORD => $this->getSamplePassword(),
          Password::CONFIRM_PASSWORD => $this->getSamplePassword() . "abcd",
          Password::PASSWORD_UPDATED_AT => ''
        ]
      ],
      [
        'name' => 'password_updated_at must have valid format Y-m-d H:i:s',
        'expected' => [
          'message' => trans('validation.date_format', [
            'attribute' => Password::PASSWORD_UPDATED_AT,
            'format' => 'Y-m-d H:i:s'
          ])
        ],
        'payload' => [
          Password::PASSWORD => $this->getSamplePassword(),
          Password::CONFIRM_PASSWORD => $this->getSamplePassword(),
          Password::PASSWORD_UPDATED_AT => 'abc'
        ]
      ],
    ];

    foreach($testCase as $tc) {
      $exception = false;
      try {
        Password::create($tc['payload'][Password::PASSWORD], $tc['payload'][Password::CONFIRM_PASSWORD],
          $tc['payload'][Password::PASSWORD_UPDATED_AT]);
      } catch(Exception $e) {
        $this->assertStringMatchesFormat($tc['expected']['message'], $e->getMessage());
        $this->assertInstanceOf(EntityValidationException::class, $e);
        $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
        $exception = true;
      }

      $this->assertTrue($exception, "validation error");
    }
  }

  /**
   * @return void
   * @throws \Illuminate\Validation\ValidationException
   *
   * @test
   * @testdox validate entity getter
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function validateEntityGetter() {
    try {
      $result = Password::create($this->getSamplePassword(), $this->getSamplePassword(),
        $this->getSamplePasswordUpdatedAt());
      $this->assertNotNull($result);
      $this->assertInstanceOf(Password::class, $result);
      $this->assertEquals($this->getSamplePassword(), $result->getPassword());
      $this->assertEquals($this->getSamplePassword(), $result->getConfirmPassword());
      $this->assertEquals($this->getSamplePasswordUpdatedAt(), $result->getUpdatedAt());
    } catch(EntityValidationException|ValidationException $exception) {
      $this->assertNull($exception);
    }
  }

  /**
   * @return void
   * @throws \Illuminate\Validation\ValidationException
   *
   * @test
   * @testdox it can encrypt and validate password
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function itCanEncryptAndValidatePassword() : void {
    try {
      $result = Password::create($this->getSamplePassword(), $this->getSamplePassword(),
        $this->getSamplePasswordUpdatedAt());
      $this->assertNotNull($result);
      $this->assertInstanceOf(Password::class, $result);

      $result->encrypt();
      $this->assertTrue($result->validatePassword(
        $this->getSamplePassword(), $result->getPassword()));
    } catch(EntityValidationException|ValidationException $exception) {
      $this->assertNull($exception);
    }
  }
}
