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
use App\Exceptions\EntityException;
use Exception;
use Tests\TestCase;
use Tests\TestData\AuthTestData;

/**
 * AuthTest
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\Timestamp
 */
class AuthTest extends TestCase {
  use AuthTestData;

  /**
   * Test the validation on each input
   *
   * @return void
   * @test
   */
  public function validateInput() : void {
    $testCase = [
      // <editor-fold desc="validation_test::password">
      [
        'name' => 'check password is required',
        'expected' => [
          'message' => 'The password field is required.'
        ],
        'payload' => []
      ],
      [
        'name' => 'check password minimum eight character',
        'expected' => [
          'message' => 'The password field format is invalid.'
        ],
        'payload' => [
          Auth::PASSWORD => 'admin'
        ],
      ],
      [
        'name' => 'check password at least one uppercase letter',
        'expected' => [
          'message' => 'The password field format is invalid.'
        ],
        'payload' => [
          Auth::PASSWORD => 'admin123'
        ]
      ],
      [
        'name' => 'check password at least one lowercase letter',
        'expected' => [
          'message' => 'The password field format is invalid.'
        ],
        'payload' => [
          Auth::PASSWORD => 'A1234567890'
        ]
      ],
      [
        'name' => 'check password at least one number',
        'expected' => [
          'message' => 'The password field format is invalid.'
        ],
        'payload' => [
          Auth::PASSWORD => 'Abcdswewfqw'
        ]
      ],
      [
        'name' => 'check password at least one special characte',
        'expected' => [
          'message' => 'The password field format is invalid.'
        ],
        'payload' => [
          Auth::PASSWORD => 'Ab1weqsfw'
        ]
      ],
      // </editor-fold>
      // <editor-fold desc="validation_test::locked_at">
      [
        'name' => 'check password is required',
        'expected' => [
          'message' => 'The locked at field must match the format Y-m-d H:i:s.'
        ],
        'payload' => [
          Auth::PASSWORD => $this->getValidPassword(),
          Auth::LOCKED_AT => "loremIpsum"
        ]
      ],
      // </editor-fold>
      // <editor-fold desc="validation_test::login_fail_attempt">
      [
        'name' => 'check login fail attempt must be an integer',
        'expected' => [
          'message' => 'The login fail attempt field must be an integer.'
        ],
        'payload' => [
          Auth::PASSWORD => $this->getValidPassword(),
          Auth::LOCKED_AT => $this->getValidLockedAt(),
          Auth::LOGIN_FAIL_ATTEMPT => 'lorem'
        ]
      ],
      [
        'name' => 'login fail attempt must be greater or equals zero',
        'expected' => [
          'message' => 'The login fail attempt field must be at least 0.'
        ],
        'payload' => [
          Auth::PASSWORD => $this->getValidPassword(),
          Auth::LOCKED_AT => $this->getValidLockedAt(),
          Auth::LOGIN_FAIL_ATTEMPT => -1
        ]
      ],
      [
        'name' => 'login fail attempt must be less then or equals 5',
        'expected' => [
          'message' => 'The login fail attempt field must not be greater than 5.'
        ],
        'payload' => [
          Auth::PASSWORD => $this->getValidPassword(),
          Auth::LOCKED_AT => $this->getValidLockedAt(),
          Auth::LOGIN_FAIL_ATTEMPT => 88
        ]
      ],
      // </editor-fold>
    ];

    foreach($testCase as $tc) {
      $exception = false;
      try {
        new Auth($tc['payload']);
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
  public function itMustHaveBasicGetterToGetObjectValue() : void {
    $entity = $this->getValidAuthEntity();

    $this->assertEquals($this->getValidPassword(), $entity->getPassword());
    $this->assertEquals($this->getValidLockedAt(), $entity->getLockedAt());
    $this->assertEquals($this->getValidLoginFailedAttempt(), $entity->getLoginFailAttempt());
  }

  /**
   * @return void
   * @throws \App\Exceptions\EntityException
   * @throws \Illuminate\Validation\ValidationException
   *
   * @test
   * @testdox getLockedAt must return null if locked_at is not set
   */
  public function getLockedAtMustReturnNullIfNotSetOrNullOrEmptyString() : void {
    $entity = new Auth([Auth::PASSWORD => $this->getValidPassword()], false);
    $this->assertNull($entity->getLockedAt());


    $entity = new Auth([Auth::PASSWORD => $this->getValidPassword(), Auth::LOCKED_AT => ''], false);
    $this->assertNull($entity->getLockedAt());


    $entity = new Auth([Auth::PASSWORD => $this->getValidPassword(), Auth::LOCKED_AT => null], false);
    $this->assertNull($entity->getLockedAt());
  }


  /**
   * @return void
   * @throws \App\Exceptions\EntityException
   * @throws \Illuminate\Validation\ValidationException
   *
   * @test
   * @testdox getLoginFailAttempt must zero null if locked_at is not set
   */
  public function getLoginFailAttemptMustReturnZeroIfNotSetOrNullOrEmptyString() : void {
    $entity = new Auth([Auth::PASSWORD => $this->getValidPassword()], false);
    $this->assertEquals(0, $entity->getLoginFailAttempt());

    $entity = new Auth([Auth::PASSWORD => $this->getValidPassword(), Auth::LOGIN_FAIL_ATTEMPT => null], false);
    $this->assertEquals(0, $entity->getLoginFailAttempt());

    $entity = new Auth([Auth::PASSWORD => $this->getValidPassword(), Auth::LOGIN_FAIL_ATTEMPT => ''], false);
    $this->assertEquals(0, $entity->getLoginFailAttempt());
  }
}
