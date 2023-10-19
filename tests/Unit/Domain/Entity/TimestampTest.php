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

use App\Domain\Entity\Timestamp;
use App\Exceptions\EntityException;
use App\Exceptions\EntityValidationException;
use Exception;
use Tests\TestCase;
use Tests\TestData\TimestampTestData;

/**
 * TimestampTest
 *
 * This class is used to testing some business rules for Timestamp entity, for example
 * testing __constructor and validation and more.
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\Timestamp
 */
class TimestampTest extends TestCase {
  use TimestampTestData;

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
        'name' => 'check created_at is required',
        'expected' => [
          'message' => trans('validation.required', ['attribute' => 'created_at'])
        ],
        'payload' => [
          Timestamp::CREATED_AT => '',
          Timestamp::UPDATED_AT => '',
          Timestamp::DELETED_AT => null
        ]
      ],
      [
        'name' => 'check created at must be valid date time',
        'expected' => [
          'message' => trans('validation.regex', ['attribute' => 'created_at'])
        ],
        'payload' => [
          Timestamp::CREATED_AT => 'lorem ipsum',
          Timestamp::UPDATED_AT => '',
          Timestamp::DELETED_AT => null
        ]
      ],
      [
        'name' => 'check updated_at is required',
        'expected' => [
          'message' => trans('validation.required', ['attribute' => 'updated_at'])
        ],
        'payload' => [
          Timestamp::CREATED_AT => $now,
          Timestamp::UPDATED_AT => '',
          Timestamp::DELETED_AT => null
        ]
      ],
      [
        'name' => 'check deleted at must be valid date time',
        'expected' => [
          'message' => trans('validation.regex', ['attribute' => 'updated_at'])
        ],
        'payload' => [
          Timestamp::CREATED_AT => $now,
          Timestamp::UPDATED_AT => 'lorem ipsum',
          Timestamp::DELETED_AT => null
        ]
      ],
      [
        'name' => 'check deleted at must be valid date time',
        'expected' => [
          'message' => trans('validation.regex', ['attribute' => 'deleted_at'])
        ],
        'payload' => [
          Timestamp::CREATED_AT => $now,
          Timestamp::UPDATED_AT => $now,
          Timestamp::DELETED_AT => 'lorem ipsum'
        ]
      ],
    ];

    foreach($testCase as $tc) {
      $exception = false;
      try {
        new Timestamp($tc['payload'][Timestamp::CREATED_AT], $tc['payload'][Timestamp::UPDATED_AT],
          $tc['payload'][Timestamp::DELETED_AT]);
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
   *
   * @test
   */
  public function createdAtAndUpdateAtMustReturnConstructedValue() {
    $now = date('Y-m-d H:i:s');
    $cls = $this->getValidTimestampEntity($now);

    $this->assertSame($now, $cls->getCreatedAt());
    $this->assertSame($now, $cls->getUpdatedAt());
    $this->assertSame($now, $cls->getDeletedAt());

    $clsArray = $cls->toArray();
    $this->assertIsArray($clsArray);

    $this->assertArrayHasKey(Timestamp::CREATED_AT, $clsArray);
    $this->assertArrayHasKey(Timestamp::UPDATED_AT, $clsArray);
    $this->assertArrayHasKey(Timestamp::DELETED_AT, $clsArray);
  }
}
