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

use App\Domain\Entity\Group;
use App\Domain\Entity\Timestamp;
use App\Domain\Entity\Traits\Entity;
use App\Exceptions\EntityValidationException;
use Exception;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;
use Tests\TestData\GroupTestData;
use Tests\TestData\TimestampTestData;

/**
 * TimestampTest
 *
 * This class is used to testing some business rules for Timestamp entity, for example
 * testing __constructor and validation and more.
 *
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\Timestamp
 * @author Fathalfath30
 */
class GroupTest extends TestCase {
  use GroupTestData, TimestampTestData;

  /** @var \Faker\Generator $faker */
  private Generator $faker;

  protected function setUp() : void {
    parent::setUp();
    $this->faker = Factory::create(app()->getLocale());
  }

  /**
   * @return void
   * @throws \App\Exceptions\EntityValidationException
   * @throws \Illuminate\Validation\ValidationException
   *
   * @test
   * @testdox validate user input
   */
  public function validateUserInput() {
    $testCase = [
      [
        'name' => 'id is required',
        'expected' => [
          'message' => trans('validation.required', ['attribute' => 'id'])
        ],
        'payload' => [
          Group::ID => '',
          Group::NAME => '',
          Group::DESCRIPTION => null,
          Entity::TIMESTAMP => $this->getValidTimestampEntity()
        ]
      ],
      [
        'name' => 'id must be a valid uuid format',
        'expected' => [
          'message' => trans('validation.uuid', ['attribute' => 'id'])
        ],
        'payload' => [
          Group::ID => 'abcd',
          Group::NAME => '',
          Group::DESCRIPTION => null,
          Entity::TIMESTAMP => $this->getValidTimestampEntity()
        ]
      ],

      [
        'name' => 'name is required',
        'expected' => [
          'message' => trans('validation.required', ['attribute' => 'name'])
        ],
        'payload' => [
          Group::ID => $this->getValidGroupId(),
          Group::NAME => '',
          Group::DESCRIPTION => null,
          Entity::TIMESTAMP => $this->getValidTimestampEntity()
        ]
      ],
      [
        'name' => 'group name should have minimum 3 character',
        'expected' => [
          'message' => trans('validation.min.string', ['attribute' => 'name', 'min' => '3'])
        ],
        'payload' => [
          Group::ID => $this->getValidGroupId(),
          Group::NAME => 'a',
          Group::DESCRIPTION => null,
          Entity::TIMESTAMP => $this->getValidTimestampEntity()
        ]
      ],
      [
        'name' => 'group name should not have character more than 150',
        'expected' => [
          'message' => trans('validation.max.string', ['attribute' => 'name', 'max' => '150'])
        ],
        'payload' => [
          Group::ID => $this->getValidGroupId(),
          Group::NAME => join("", $this->faker->words(155)),
          Group::DESCRIPTION => null,
          Entity::TIMESTAMP => $this->getValidTimestampEntity()
        ]
      ],
    ];

    foreach($testCase as $tc) {
      $exception = false;
      try {
        Group::create($tc['payload'][Group::ID], $tc['payload'][Group::NAME], $tc['payload'][Group::DESCRIPTION],
          $tc['payload'][Entity::TIMESTAMP]);
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
   *
   * @test
   * @testdox validate entity getter
   */
  public function validateEntityGetter() {
    try {
      $result = Group::create($this->getValidGroupId(), $this->getValidGroupName(),
        $this->getValidGroupDescription(), $this->getValidTimestampEntity());
      $this->assertNotNull($result);
      $this->assertInstanceOf(Group::class, $result);
      $this->assertEquals($this->getValidGroupId(), $result->getId());
      $this->assertEquals($this->getValidGroupName(), $result->getName());
      $this->assertEquals($this->getValidGroupDescription(), $result->getDescription());
      $this->assertNotNull($result->getTimestamp());
      $this->assertInstanceOf(Timestamp::class, $result->getTimestamp());
      $this->assertEquals($this->getValidTimestampEntity(), $result->getTimestamp());

    } catch(EntityValidationException|ValidationException $e) {
      $this->assertNull($e);
    }
  }
}
