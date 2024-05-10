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


class EmailTest extends TestCase {
  use EmailTestData, TimestampTestData;

  /**
   * Test the validation on each input
   *
   * @return void
   * @test
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
          Email::EMAIL => '',
          Email::EMAIL_VERIFIED_AT => null
        ]
      ],
      [
        'name' => 'email must be a valid email format',
        'expected' => [
          'message' => trans('validation.email', ['attribute' => 'email'])
        ],
        'payload' => [
          Email::EMAIL => 'loem',
          Email::EMAIL_VERIFIED_AT => null
        ]
      ],
    ];

    foreach($testCase as $tc) {
      $exception = false;
      try {
        Email::create($tc['payload'][Email::EMAIL], $tc['payload'][Email::EMAIL_VERIFIED_AT]);
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
