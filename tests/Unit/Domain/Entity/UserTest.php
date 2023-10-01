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

use App\Domain\Entity\Auth;
use App\Domain\Entity\Role;
use App\Domain\Entity\User;
use App\Exceptions\EntityException;
use Exception;
use Tests\TestCase;
use Tests\TestData\RoleTestData;
use Tests\TestData\UserTestData;

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
class UserTest extends TestCase {
  use UserTestData, RoleTestData;

  /**
   * Test the validation on each input
   *
   * @return void
   * @return void
   * @test
   * @throws \Illuminate\Validation\ValidationException
   *
   * @throws \App\Exceptions\EntityException
   */
  public function validateInput() {
    $testCase = [
      // <editor-fold desc="validation_test::id">
      [
        'name' => 'check id must be filled',
        'expected' => [
          'message' => trans('validation.required', ['attribute' => 'id'])
        ],
        'payload' => []
      ],
      [
        'name' => 'check id must be a valid uuid',
        'expected' => [
          'message' => trans('validation.uuid', ['attribute' => 'id'])
        ],
        'payload' => [
          User::ID => 'lorem'
        ]
      ],
      // </editor-fold>
      // <editor-fold desc="validation_test::role">
      [
        'name' => 'check role is required',
        'expected' => [
          'message' => trans('validation.required', ['attribute' => 'role'])
        ],
        'payload' => [
          User::ID => $this->getValidUserId()
        ]
      ],
      [
        'name' => 'check role is instance of Role class',
        'expected' => [
          'message' => trans("validation.instance_of", ['attribute' => 'role', 'values' => Role::class])
        ],
        'payload' => [
          User::ID => $this->getValidUserId(),
          User::ROLE => 'lorem'
        ]
      ],
      // </editor-fold>
      // <editor-fold desc="validation_test::auth">
      [
        'name' => 'check auth is required',
        'expected' => [
          'message' => trans('validation.required', ['attribute' => 'auth'])
        ],
        'payload' => [
          User::ID => $this->getValidUserId(),
          User::ROLE => $this->getValidRoleEntity()
        ]
      ],
      [
        'name' => 'check auth is required',
        'expected' => [
          'message' => trans("validation.instance_of", ['attribute' => 'auth', 'values' => Auth::class])
        ],
        'payload' => [
          User::ID => $this->getValidUserId(),
          User::ROLE => $this->getValidRoleEntity(),
          User::AUTH => 'lorem'
        ]
      ],
      // </editor-fold>
    ];

    foreach($testCase as $tc) {
      $exception = false;
      try {
        new User($tc['payload']);
      } catch(Exception $e) {
        $this->assertStringMatchesFormat($tc['expected']['message'], $e->getMessage());
        $this->assertInstanceOf(EntityException::class, $e);
        $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
        $exception = true;
      }

      $this->assertTrue($exception, "validation error");
    }
  }
}
