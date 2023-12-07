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

use App\Domain\Entity\UserInfo;
use App\Exceptions\EntityValidationException;
use Exception;
use Tests\TestCase;
use Tests\TestData\UserInfoTestData;

/**
 * UserInfoTest
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\Timestamp
 */
class UserInfoTest extends TestCase {
  use UserInfoTestData;

  /**
   * Test the validation on each input
   *
   * @return void
   * @test
   */
  public function validateInput() : void {
    $testCase = [
      // <editor-fold desc="first_name">
      [
        'name' => 'first name is required',
        'expected' => [
          'message' => trans('validation.required', ['attribute' => UserInfo::FIRST_NAME])
        ],
        'payload' => [
          UserInfo::FIRST_NAME => '',
          UserInfo::LAST_NAME => null,
          UserInfo::USERNAME => '',
          UserInfo::EMAIL => ''
        ]
      ],
      [
        'name' => 'first name must have a valid format (1)',
        'expected' => [
          'message' => trans('validation.regex', ['attribute' => UserInfo::FIRST_NAME])
        ],
        'payload' => [
          UserInfo::FIRST_NAME => 'lorem1psum',
          UserInfo::LAST_NAME => null,
          UserInfo::USERNAME => '',
          UserInfo::EMAIL => ''
        ]
      ],
      [
        'name' => 'first name must have a valid format (2)',
        'expected' => [
          'message' => trans('validation.regex', ['attribute' => UserInfo::FIRST_NAME])
        ],
        'payload' => [
          UserInfo::FIRST_NAME => 'lorem 1psum',
          UserInfo::LAST_NAME => null,
          UserInfo::USERNAME => '',
          UserInfo::EMAIL => ''
        ]
      ],
      [
        'name' => 'first name must have a valid format (3)',
        'expected' => [
          'message' => trans('validation.regex', ['attribute' => UserInfo::FIRST_NAME])
        ],
        'payload' => [
          UserInfo::FIRST_NAME => 'lorem @psum',
          UserInfo::LAST_NAME => null,
          UserInfo::USERNAME => '',
          UserInfo::EMAIL => ''
        ]
      ],
      [
        'name' => 'first name must have a valid format (4)',
        'expected' => [
          'message' => trans('validation.regex', ['attribute' => UserInfo::FIRST_NAME])
        ],
        'payload' => [
          UserInfo::FIRST_NAME => 'lorem.',
          UserInfo::LAST_NAME => null,
          UserInfo::USERNAME => '',
          UserInfo::EMAIL => ''
        ]
      ],
      // </editor-fold>

      // <editor-fold desc="last_name">
      [
        'name' => 'last name must have a valid format (1)',
        'expected' => [
          'message' => trans('validation.regex', ['attribute' => UserInfo::LAST_NAME])
        ],
        'payload' => [
          UserInfo::FIRST_NAME => $this->getValidFirstName(),
          UserInfo::LAST_NAME => 'lorem1psum',
          UserInfo::USERNAME => '',
          UserInfo::EMAIL => ''
        ]
      ],
      [
        'name' => 'last name must have a valid format (2)',
        'expected' => [
          'message' => trans('validation.regex', ['attribute' => UserInfo::LAST_NAME])
        ],
        'payload' => [
          UserInfo::FIRST_NAME => $this->getValidFirstName(),
          UserInfo::LAST_NAME => 'lorem 1psum',
          UserInfo::USERNAME => '',
          UserInfo::EMAIL => ''
        ]
      ],
      [
        'name' => 'last name must have a valid format (3)',
        'expected' => [
          'message' => trans('validation.regex', ['attribute' => UserInfo::LAST_NAME])
        ],
        'payload' => [
          UserInfo::FIRST_NAME => $this->getValidFirstName(),
          UserInfo::LAST_NAME => 'lorem @psum',
          UserInfo::USERNAME => '',
          UserInfo::EMAIL => ''
        ]
      ],
      [
        'name' => 'last name must have a valid format (4)',
        'expected' => [
          'message' => trans('validation.regex', ['attribute' => UserInfo::LAST_NAME])
        ],
        'payload' => [
          UserInfo::FIRST_NAME => $this->getValidFirstName(),
          UserInfo::LAST_NAME => 'lorem.',
          UserInfo::USERNAME => '',
          UserInfo::EMAIL => ''
        ]
      ],
      // </editor-fold>

      // <editor-fold desc="username">
      [
        'name' => 'username is required',
        'expected' => [
          'message' => 'The username field is required.'
        ],
        'payload' => [
          UserInfo::FIRST_NAME => $this->getValidFirstName(),
          UserInfo::LAST_NAME => $this->getValidLastName(),
          UserInfo::USERNAME => '',
          UserInfo::EMAIL => ''
        ]
      ],
      [
        'name' => 'validate username format (1)',
        'expected' => [
          'message' => trans('validation.regex', ['attribute' => UserInfo::USERNAME])
        ],
        'payload' => [
          UserInfo::FIRST_NAME => $this->getValidFirstName(),
          UserInfo::LAST_NAME => $this->getValidLastName(),
          UserInfo::USERNAME => 'lorem_.',
          UserInfo::EMAIL => ''
        ],
      ],
      [
        'name' => 'validate username format (2)',
        'expected' => [
          'message' => trans('validation.regex', ['attribute' => UserInfo::USERNAME])
        ],
        'payload' => [
          UserInfo::FIRST_NAME => $this->getValidFirstName(),
          UserInfo::LAST_NAME => $this->getValidLastName(),
          UserInfo::USERNAME => 'lorem_ ',
          UserInfo::EMAIL => ''
        ],
      ],
      // </editor-fold>

      // <editor-fold desc="email">
      [
        'name' => 'username is required',
        'expected' => [
          'message' => trans('validation.email', ['attribute' => UserInfo::EMAIL])
        ],
        'payload' => [
          UserInfo::FIRST_NAME => $this->getValidFirstName(),
          UserInfo::LAST_NAME => $this->getValidLastName(),
          UserInfo::USERNAME => $this->getValidUsername(),
          UserInfo::EMAIL => ''
        ]
      ],
      [
        'name' => 'validate username format (1)',
        'expected' => [
          'message' => trans('validation.email', ['attribute' => UserInfo::EMAIL])
        ],
        'payload' => [
          UserInfo::FIRST_NAME => $this->getValidFirstName(),
          UserInfo::LAST_NAME => $this->getValidLastName(),
          UserInfo::USERNAME => $this->getValidUsername(),
          UserInfo::EMAIL => 'loremipsum.com'
        ],
      ],
      [
        'name' => 'validate username format (2)',
        'expected' => [
          'message' => trans('validation.email', ['attribute' => UserInfo::EMAIL])
        ],
        'payload' => [
          UserInfo::FIRST_NAME => $this->getValidFirstName(),
          UserInfo::LAST_NAME => $this->getValidLastName(),
          UserInfo::USERNAME => $this->getValidUsername(),
          UserInfo::EMAIL => '!@#_loremipsum@gmail.com'
        ],
      ],
      // </editor-fold>
    ];

    foreach($testCase as $tc) {
      $exception = false;
      try {
        new UserInfo($tc['payload'][UserInfo::FIRST_NAME], $tc['payload'][UserInfo::LAST_NAME],
          $tc['payload'][UserInfo::USERNAME], $tc['payload'][UserInfo::EMAIL]);
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
   * @throws \App\Exceptions\EntityException
   * @throws \Illuminate\Validation\ValidationException
   *
   * @test
   */
  public function userInfoMustHaveBasicGetterToGetObjectValue() : void {
    $entity = $this->getValidUserInfoEntity();

    $this->assertEquals($this->getValidFirstName(), $entity->getFirstName());
    $this->assertEquals($this->getValidLastName(), $entity->getLastName());
    $this->assertEquals($this->getValidUsername(), $entity->getUsername());
    $this->assertEquals($this->getValidEmail(), $entity->getEmail());
  }

  /**
   * @return void
   * @throws \App\Exceptions\EntityValidationException
   */
  public function getLastNameMustReturnNullIfNotSetOrNullOrEmptyString() : void {
    $entity = new UserInfo($this->getValidFirstName(), null, $this->getValidUsername(),
      $this->getValidEmail());
    $this->assertNull($entity->getLastName());

    $entity = new UserInfo($this->getValidFirstName(), '', $this->getValidUsername(),
      $this->getValidEmail());
    $this->assertNull($entity->getLastName());
  }
}
