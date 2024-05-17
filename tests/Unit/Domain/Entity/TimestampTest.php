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

use App\Domain\Entity\Timestamp;
use App\Exceptions\EntityValidationException;
use Exception;
use Tests\TestCase;
use Tests\TestData\TimestampTestData;

/**
 *
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\Timestamp
 * @see \Tests\TestData\TimestampTestData
 *
 * @author Fathalfath30
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
          Timestamp::CreatedAt => '',
          Timestamp::UpdatedAt => '',
          Timestamp::DeletedAt => null
        ]
      ],
      [
        'name' => 'check created at must be valid date time',
        'expected' => [
          'message' => trans('validation.regex', ['attribute' => 'created_at'])
        ],
        'payload' => [
          Timestamp::CreatedAt => 'lorem ipsum',
          Timestamp::UpdatedAt => '',
          Timestamp::DeletedAt => null
        ]
      ],
      [
        'name' => 'check updated_at is required',
        'expected' => [
          'message' => trans('validation.required', ['attribute' => 'updated_at'])
        ],
        'payload' => [
          Timestamp::CreatedAt => $now,
          Timestamp::UpdatedAt => '',
          Timestamp::DeletedAt => null
        ]
      ],
      [
        'name' => 'check deleted at must be valid date time',
        'expected' => [
          'message' => trans('validation.regex', ['attribute' => 'updated_at'])
        ],
        'payload' => [
          Timestamp::CreatedAt => $now,
          Timestamp::UpdatedAt => 'lorem ipsum',
          Timestamp::DeletedAt => null
        ]
      ],
      [
        'name' => 'check deleted at must be valid date time',
        'expected' => [
          'message' => trans('validation.regex', ['attribute' => 'deleted_at'])
        ],
        'payload' => [
          Timestamp::CreatedAt => $now,
          Timestamp::UpdatedAt => $now,
          Timestamp::DeletedAt => 'lorem ipsum'
        ]
      ],
    ];

    foreach($testCase as $tc) {
      $exception = false;
      try {
        Timestamp::create($tc['payload'][Timestamp::CreatedAt], $tc['payload'][Timestamp::UpdatedAt],
          $tc['payload'][Timestamp::DeletedAt]);
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
   * @testdox created_at and updated_at must return constructed value
   */
  public function createdAtAndUpdateAtMustReturnConstructedValue() {
    $now = date('Y-m-d H:i:s');
    $cls = $this->getValidTimestampEntity($now);

    $this->assertSame($now, $cls->getCreatedAt()->format("Y-m-d H:i:s"));
    $this->assertSame($now, $cls->getUpdatedAt()->format("Y-m-d H:i:s"));
    $this->assertSame($now, $cls->getDeletedAt()->format("Y-m-d H:i:s"));

    $clsArray = $cls->toArray();
    $this->assertIsArray($clsArray);

    $this->assertArrayHasKey(Timestamp::CreatedAt, $clsArray);
    $this->assertArrayHasKey(Timestamp::UpdatedAt, $clsArray);
    $this->assertArrayHasKey(Timestamp::DeletedAt, $clsArray);
  }
}
