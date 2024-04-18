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

use App\Domain\Entity\Role;
use App\Domain\Entity\Timestamp;
use App\Domain\Entity\Traits\Entity;
use App\Exceptions\EntityValidationException;
use Exception;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;
use Tests\TestData\RoleTestData;
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
class RoleTest extends TestCase {
  use RoleTestData, TimestampTestData;

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
          Role::ID => '',
          Role::NAME => '',
          Role::ENABLE => false,
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
          Role::ENABLE => false,
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
          Role::ENABLE => false,
          Entity::TIMESTAMP => $this->getValidTimestampEntity()
        ]
      ],
    ];

    foreach($testCase as $tc) {
      $exception = false;
      try {
        Role::create($tc['payload'][Role::ID], $tc['payload'][Role::NAME], $tc['payload'][Role::ENABLE],
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
      $result = Role::create($this->getValidRoleId(), $this->getValidRoleName(), true,
        $this->getValidTimestampEntity());
      $this->assertNotNull($result);

      $this->assertEquals($this->getValidRoleId(), $result->getId());
      $this->assertEquals($this->getValidRoleName(), $result->getName());
      $this->assertTrue($result->isAdmin());
      $this->assertInstanceOf(Timestamp::class, $result->getTimestamp());
    } catch(EntityValidationException|ValidationException $e) {
      $this->assertNull($e);
    }
  }
}
