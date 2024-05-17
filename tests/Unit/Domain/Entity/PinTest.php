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

use App\Domain\Entity\Pin;
use App\Exceptions\EntityValidationException;
use Exception;
use Illuminate\Support\Carbon;
use Nette\Schema\ValidationException;
use Tests\TestCase;
use Tests\TestData\PinTestData;

/**
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\Pin
 * @see \Tests\TestData\PinTestData
 *
 * @author Fathalfath30
 */
class PinTest extends TestCase {
  use PinTestData;

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
        'name' => 'pin is required',
        'expected' => [
          'message' => trans('validation.required', ['attribute' => 'pin'])
        ],
        'payload' => [
          Pin::Pin => '',
          Pin::LastUpdated => $this->getSampleLastUpdated()
        ]
      ],
      [
        'name' => 'pin is must be a valid integer',
        'expected' => [
          'message' => trans('validation.numeric', ['attribute' => 'pin'])
        ],
        'payload' => [
          Pin::Pin => 'lorem',
          Pin::LastUpdated => $this->getSampleLastUpdated()
        ]
      ],
      [
        'name' => 'pin must be 6 digits',
        'expected' => [
          'message' => trans('validation.digits', ['attribute' => 'pin', 'digits' => '6'])
        ],
        'payload' => [
          Pin::Pin => '0999900',
          Pin::LastUpdated => $this->getSampleLastUpdated()
        ]
      ],
      [
        'name' => 'pin must be 6 digits 2',
        'expected' => [
          'message' => trans('validation.digits', ['attribute' => 'pin', 'digits' => '6'])
        ],
        'payload' => [
          Pin::Pin => '00000',
          Pin::LastUpdated => $this->getSampleLastUpdated()
        ]
      ]
    ];

    foreach($testCase as $tc) {
      $exception = false;
      try {
        Pin::create($tc['payload'][Pin::Pin], $tc['payload'][Pin::LastUpdated]);
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
}
