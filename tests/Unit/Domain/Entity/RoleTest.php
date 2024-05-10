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

use App\Domain\Entity\Role;
use App\Domain\Entity\Timestamp;
use App\Domain\Entity\Traits\Entity;
use App\Exceptions\EntityValidationException;
use Exception;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;
use Tests\TestData\RoleTestData;
use Tests\TestData\TimestampTestData;

/**
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\Role
 * @see \Tests\TestData\RoleTestData
 * @see \Tests\TestData\TimestampTestData
 * @author Fathalfath30
 *
 */
class RoleTest extends TestCase {
  use RoleTestData, TimestampTestData;

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
          Role::ID => '',
          Role::NAME => '',
          Role::IS_ADMIN => false,
          Entity::TIMESTAMP => $this->getValidTimestampEntity()
        ]
      ],
      [
        'name' => 'id must be a valid uuid format',
        'expected' => [
          'message' => trans('validation.uuid', ['attribute' => 'id'])
        ],
        'payload' => [
          Role::ID => 'abcd',
          Role::NAME => '',
          Role::IS_ADMIN => false,
          Entity::TIMESTAMP => $this->getValidTimestampEntity()
        ]
      ],

      [
        'name' => 'name is required',
        'expected' => [
          'message' => trans('validation.required', ['attribute' => 'name'])
        ],
        'payload' => [
          Role::ID => $this->getValidRoleId(),
          Role::NAME => '',
          Role::IS_ADMIN => false,
          Entity::TIMESTAMP => $this->getValidTimestampEntity()
        ]
      ],
      [
        'name' => 'role name should have minimum 3 character',
        'expected' => [
          'message' => trans('validation.min.string', ['attribute' => 'name', 'min' => '3'])
        ],
        'payload' => [
          Role::ID => $this->getValidRoleId(),
          Role::NAME => 'a',
          Role::IS_ADMIN => false,
          Entity::TIMESTAMP => $this->getValidTimestampEntity()
        ]
      ],
      [
        'name' => 'role name should not have character more than 150',
        'expected' => [
          'message' => trans('validation.max.string', ['attribute' => 'name', 'max' => '150'])
        ],
        'payload' => [
          Role::ID => $this->getValidRoleId(),
          Role::NAME => join("", $this->faker->words(155)),
          Role::IS_ADMIN => false,
          Entity::TIMESTAMP => $this->getValidTimestampEntity()
        ]
      ],
    ];

    foreach($testCase as $tc) {
      $exception = false;
      try {
        Role::create($tc['payload'][Role::ID], $tc['payload'][Role::NAME], $tc['payload'][Role::IS_ADMIN],
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
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function validateEntityGetter() {
    try {
      $result = Role::create($this->getValidRoleId(), $this->getValidRoleName(), true,
        $this->getValidTimestampEntity());
      $this->assertNotNull($result);

      $this->assertEquals($this->getValidRoleId(), $result->getId());
      $this->assertEquals($this->getValidRoleName(), $result->getName());
      $this->assertTrue($result->is_admin());
      $this->assertInstanceOf(Timestamp::class, $result->getTimestamp());
    } catch(EntityValidationException|ValidationException $e) {
      $this->assertNull($e);
    }
  }
}
