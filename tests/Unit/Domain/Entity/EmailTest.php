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

use App\Domain\Entity\Email;
use App\Exceptions\EntityValidationException;
use Exception;
use Illuminate\Support\Carbon;
use Tests\TestCase;
use Tests\TestData\EmailTestData;
use Tests\TestData\TimestampTestData;

/**
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\Email
 * @see \Tests\TestData\EmailTestData
 * @see \Tests\TestData\TimestampTestData
 *
 * @author Fathalfath30
 */
class EmailTest extends TestCase {
  use EmailTestData, TimestampTestData;

  /**
   * Test the validation on each input
   *
   * @return void
   * @test
   * @testdox validate input
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function validateInput() {
    $now = date('Y-m-d H:i:s');
    $testCase = [
      [
        'name' => 'email is required',
        'expected' => [
          'message' => trans('validation.required', ['attribute' => 'email'])
        ],
        'payload' => [
          Email::Email => '',
          Email::EmailVerifiedAt => null
        ]
      ],
      [
        'name' => 'email must be a valid email format',
        'expected' => [
          'message' => trans('validation.email', ['attribute' => 'email'])
        ],
        'payload' => [
          Email::Email => 'loem',
          Email::EmailVerifiedAt => null
        ]
      ],
    ];

    foreach($testCase as $tc) {
      $exception = false;
      try {
        Email::create($tc['payload'][Email::Email], $tc['payload'][Email::EmailVerifiedAt]);
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
   * @throws \App\Exceptions\EntityValidationException
   * @throws \Illuminate\Validation\ValidationException
   *
   * @test
   * @testdox validate entity getter
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function validateEntityGetter() {
    $result = Email::create($this->getSampleEmail(), $this->getSampleEmailVerifiedAt());
    $this->assertNotNull($result);
    $this->assertInstanceOf(Email::class, $result);
    $this->assertEquals($this->getSampleEmail(), $result->getEmail());
    $this->assertNotNull($result->getEmailVerifiedAt());
    $this->assertInstanceOf(Carbon::class, $result->getEmailVerifiedAt());
  }
}
