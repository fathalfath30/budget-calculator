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
use App\Domain\Entity\Pin;
use App\Exceptions\EntityValidationException;
use Exception;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\Carbon;
use Nette\Schema\ValidationException;
use Tests\TestCase;
use Tests\TestData\PinTestData;

/**
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\Password
 * @see \Tests\TestData\PasswordTestData
 * @author Fathalfath30
 */
class PinTest extends TestCase {
  use PinTestData;

  /** @var \Faker\Generator $faker */
  private Generator $faker;

  /**
   * Set up the test case
   *
   * @return void
   */
  protected function setUp() : void {
    parent::setUp();
    $this->faker = Factory::create(app()->getLocale());
  }

  /**
   * @return void
   *
   * @test
   * @testdox validate user input
   */
  public function validateUserInput() {
    $testCase = [
      [
        'name' => 'pin is required',
        'expected' => [
          'message' => trans('validation.required', ['attribute' => 'pin'])
        ],
        'payload' => [
          Pin::PIN => '',
          Pin::LAST_UPDATED => $this->getSampleLastUpdated()
        ]
      ],
      [
        'name' => 'pin is must be a valid integer',
        'expected' => [
          'message' => trans('validation.numeric', ['attribute' => 'pin'])
        ],
        'payload' => [
          Pin::PIN => 'lorem',
          Pin::LAST_UPDATED => $this->getSampleLastUpdated()
        ]
      ],
      [
        'name' => 'pin must be 6 digits',
        'expected' => [
          'message' => trans('validation.digits', ['attribute' => 'pin', 'digits' => '6'])
        ],
        'payload' => [
          Pin::PIN => '0999900',
          Pin::LAST_UPDATED => $this->getSampleLastUpdated()
        ]
      ],
      [
        'name' => 'pin must be 6 digits 2',
        'expected' => [
          'message' => trans('validation.digits', ['attribute' => 'pin', 'digits' => '6'])
        ],
        'payload' => [
          Pin::PIN => '00000',
          Pin::LAST_UPDATED => $this->getSampleLastUpdated()
        ]
      ]
    ];

    foreach($testCase as $tc) {
      $exception = false;
      try {
        Pin::create($tc['payload'][Pin::PIN], $tc['payload'][Pin::LAST_UPDATED]);
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
   */
  public function validateEntityGetter() {
    try {
      $result = Pin::create($this->getSamplePin(), $this->getSampleLastUpdated());
      $this->assertNotNull($result);
      $this->assertInstanceOf(Pin::class, $result);
      $this->assertEquals($this->getSamplePin(), $result->getPin());
      $this->assertNotNull($result->getLastUpdated());
      $this->assertInstanceOf(Carbon::class, $result->getLastUpdated());
    } catch(EntityValidationException|ValidationException $exception) {
      $this->assertNull($exception);
    }
  }

  /**
   * @return void
   * @throws \Illuminate\Validation\ValidationException
   *
   * test
   * @testdox it can encrypt and validate password
   */
  public function itCanEncryptAndValidatePassword() : void {
    try {
      $result = Password::create($this->getValidPassword(), $this->getValidPassword(),
        $this->getValidPasswordUpdatedAt());
      $this->assertNotNull($result);
      $this->assertInstanceOf(Password::class, $result);

      $result->encrypt();
      $this->assertTrue($result->validatePassword(
        $this->getValidPassword(), $result->getPassword()));
    } catch(EntityValidationException|ValidationException $exception) {
      $this->assertNull($exception);
    }
  }
}
