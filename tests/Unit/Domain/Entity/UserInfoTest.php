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

use App\Domain\Entity\UserInfo;
use App\Exceptions\EntityException;
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
          'message' => 'The first name field is required.'
        ],
        'payload' => []
      ],
      [
        'name' => 'first name must have a valid format (1)',
        'expected' => [
          'message' => 'The first name field format is invalid.'
        ],
        'payload' => [
          UserInfo::FIRST_NAME => 'lorem1psum'
        ]
      ],
      [
        'name' => 'first name must have a valid format (2)',
        'expected' => [
          'message' => 'The first name field format is invalid.'
        ],
        'payload' => [
          UserInfo::FIRST_NAME => 'lorem 1psum'
        ]
      ],
      [
        'name' => 'first name must have a valid format (3)',
        'expected' => [
          'message' => 'The first name field format is invalid.'
        ],
        'payload' => [
          UserInfo::FIRST_NAME => 'lorem @psum'
        ]
      ],
      [
        'name' => 'first name must have a valid format (4)',
        'expected' => [
          'message' => 'The first name field format is invalid.'
        ],
        'payload' => [
          UserInfo::FIRST_NAME => 'lorem.'
        ]
      ],
      // </editor-fold>

      // <editor-fold desc="last_name">
      [
        'name' => 'last name must have a valid format (1)',
        'expected' => [
          'message' => 'The last name field format is invalid.'
        ],
        'payload' => [
          UserInfo::FIRST_NAME => 'lorem',
          UserInfo::LAST_NAME => 'lorem1psum'
        ]
      ],
      [
        'name' => 'last name must have a valid format (2)',
        'expected' => [
          'message' => 'The last name field format is invalid.'
        ],
        'payload' => [
          UserInfo::FIRST_NAME => 'lorem',
          UserInfo::LAST_NAME => 'lorem 1psum'
        ]
      ],
      [
        'name' => 'last name must have a valid format (3)',
        'expected' => [
          'message' => 'The last name field format is invalid.'
        ],
        'payload' => [
          UserInfo::FIRST_NAME => 'lorem',
          UserInfo::LAST_NAME => 'lorem @psum'
        ]
      ],
      [
        'name' => 'last name must have a valid format (4)',
        'expected' => [
          'message' => 'The last name field format is invalid.'
        ],
        'payload' => [
          UserInfo::FIRST_NAME => 'lorem',
          UserInfo::LAST_NAME => 'lorem.'
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
          UserInfo::FIRST_NAME => 'lorem',
          UserInfo::LAST_NAME => 'ipsum',
        ]
      ],
      [
        'name' => 'validate username format (1)',
        'expected' => [
          'message' => 'The username field format is invalid.'
        ],
        'payload' => [
          UserInfo::FIRST_NAME => 'lorem',
          UserInfo::LAST_NAME => 'ipsum',
          UserInfo::USERNAME => 'lorem_.'
        ],
      ],
      [
        'name' => 'validate username format (2)',
        'expected' => [
          'message' => 'The username field format is invalid.'
        ],
        'payload' => [
          UserInfo::FIRST_NAME => 'lorem',
          UserInfo::LAST_NAME => 'ipsum',
          UserInfo::USERNAME => 'lorem_ '
        ],
      ],
      // </editor-fold>
    ];

    foreach($testCase as $tc) {
      try {
        new UserInfo($tc['payload']);
      } catch(Exception $e) {
        /** @var EntityException $e */
        $this->assertStringMatchesFormat($tc['expected']['message'], $e->getMessage());
        $this->assertInstanceOf(EntityException::class, $e);
        $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
      }
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
    $entity = $this->ValidUserInfoEntity();

    $this->assertEquals($this->ValidFirstName(), $entity->getFirstName());
    $this->assertEquals($this->ValidLastName(), $entity->getLastName());
    $this->assertEquals($this->ValidUsername(), $entity->getUsername());
    $this->assertEquals($this->ValidEmail(), $entity->getEmail());
  }
}
