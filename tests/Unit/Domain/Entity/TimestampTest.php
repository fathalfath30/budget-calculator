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
use Exception;
use Tests\TestCase;

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
          'message' => 'The created at field is required.'
        ],
        'payload' => []
      ],
      [
        'name' => 'check created at must be valid date time',
        'expected' => [
          'message' => 'The created at field must be a valid date.'
        ],
        'payload' => [
          Timestamp::CREATED_AT => 'lorem ipsum'
        ]
      ],
      [
        'name' => 'check updated_at is required',
        'expected' => [
          'message' => 'The updated at field is required.'
        ],
        'payload' => [
          Timestamp::CREATED_AT => $now
        ]
      ],
      [
        'name' => 'check deleted at must be valid date time',
        'expected' => [
          'message' => 'The updated at field must be a valid date.'
        ],
        'payload' => [
          Timestamp::CREATED_AT => $now,
          Timestamp::UPDATED_AT => 'lorem ipsum'
        ]
      ],
      [
        'name' => 'check deleted at must be valid date time',
        'expected' => [
          'message' => 'The deleted at field must be a valid date.'
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
        new Timestamp($tc['payload']);
      } catch(Exception $e) {
        $this->assertStringMatchesFormat($tc['expected']['message'], $e->getMessage());
        $this->assertInstanceOf(EntityException::class, $e);
        $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
        $exception = true;
      }

      $this->assertTrue($exception, "validation error");
    }
  }

  /**
   * @return void
   * @throws \App\Exceptions\EntityException
   * @throws \Illuminate\Validation\ValidationException
   *
   * @test
   */
  public function createdAtAndUpdateAtMustReturnConstructedValue() {
    $now = date('Y-m-d H:i:s');
    $cls = new Timestamp([Timestamp::CREATED_AT => $now, Timestamp::UPDATED_AT => $now]);

    $this->assertSame($now, $cls->getCreatedAt());
    $this->assertSame($now, $cls->getUpdatedAt());
    $this->assertNull($cls->getDeletedAt());

    $clsArray = $cls->toArray();
    $this->assertIsArray($clsArray);

    $this->assertArrayHasKey(Timestamp::CREATED_AT, $clsArray);
    $this->assertArrayHasKey(Timestamp::UPDATED_AT, $clsArray);
    $this->assertArrayHasKey(Timestamp::DELETED_AT, $clsArray);
  }
}
