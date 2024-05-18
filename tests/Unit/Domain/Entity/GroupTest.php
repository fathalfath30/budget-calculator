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
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\Group
 * @see \Tests\TestData\GroupTestData
 * @see \Tests\TestData\EmailTestData
 *
 * @author Fathalfath30
 */
class GroupTest extends TestCase {
  use GroupTestData, TimestampTestData;

  /** @var \Faker\Generator $faker */
  private Generator $faker;

  /**
   * @return void
   *
   * @version 1.0.0
   * @since 1.0.0
   */
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
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function validateUserInput() {
    $testCase = [
      [
        'name' => 'id is required',
        'expected' => [
          'message' => trans('validation.required', ['attribute' => 'id'])
        ],
        'payload' => [
          Group::Id => '',
          Group::Name => '',
          Group::Description => null,
          Entity::Timestamp => $this->getSampleTimestampEntity()
        ]
      ],
      [
        'name' => 'id must be a valid uuid format',
        'expected' => [
          'message' => trans('validation.uuid', ['attribute' => 'id'])
        ],
        'payload' => [
          Group::Id => 'abcd',
          Group::Name => '',
          Group::Description => null,
          Entity::Timestamp => $this->getSampleTimestampEntity()
        ]
      ],

      [
        'name' => 'name is required',
        'expected' => [
          'message' => trans('validation.required', ['attribute' => 'name'])
        ],
        'payload' => [
          Group::Id => $this->getSampleGroupId(),
          Group::Name => '',
          Group::Description => null,
          Entity::Timestamp => $this->getSampleTimestampEntity()
        ]
      ],
      [
        'name' => 'group name should have minimum 3 character',
        'expected' => [
          'message' => trans('validation.min.string', ['attribute' => 'name', 'min' => '3'])
        ],
        'payload' => [
          Group::Id => $this->getSampleGroupId(),
          Group::Name => 'a',
          Group::Description => null,
          Entity::Timestamp => $this->getSampleTimestampEntity()
        ]
      ],
      [
        'name' => 'group name should not have character more than 150',
        'expected' => [
          'message' => trans('validation.max.string', ['attribute' => 'name', 'max' => '150'])
        ],
        'payload' => [
          Group::Id => $this->getSampleGroupId(),
          Group::Name => join("", $this->faker->words(155)),
          Group::Description => null,
          Entity::Timestamp => $this->getSampleTimestampEntity()
        ]
      ],
    ];

    foreach($testCase as $tc) {
      $exception = false;
      try {
        Group::create($tc['payload'][Group::Id], $tc['payload'][Group::Name], $tc['payload'][Group::Description],
          $tc['payload'][Entity::Timestamp]);
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
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function validateEntityGetter() {
    try {
      $result = Group::create($this->getSampleGroupId(), $this->getSampleGroupName(),
        $this->getSampleGroupDescription(), $this->getSampleTimestampEntity());
      $this->assertNotNull($result);
      $this->assertInstanceOf(Group::class, $result);
      $this->assertEquals($this->getSampleGroupId(), $result->getId());
      $this->assertEquals($this->getSampleGroupName(), $result->getName());
      $this->assertEquals($this->getSampleGroupDescription(), $result->getDescription());
      $this->assertNotNull($result->getTimestamp());
      $this->assertInstanceOf(Timestamp::class, $result->getTimestamp());
      $this->assertEquals($this->getSampleTimestampEntity(), $result->getTimestamp());

    } catch(EntityValidationException|ValidationException $e) {
      $this->assertNull($e);
    }
  }
}
