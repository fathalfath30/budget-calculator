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
use App\Exceptions\EntityValidationException;
use Exception;
use Tests\TestCase;
use Tests\TestData\AuthTestData;
use const http\Client\Curl\AUTH_ANY;

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
    $expected_invalid_password = trans('validation.regex', ['attribute' => Auth::PASSWORD]);
    $testCase = [
      // <editor-fold desc="validation_test::password">
      [
        'name' => 'check password is required',
        'expected' => [
          'message' => trans('validation.required', ['attribute' => Auth::PASSWORD])
        ],
        'payload' => [
          Auth::PASSWORD => '',
          Auth::LOCKED_AT => '',
          Auth::LOGIN_FAIL_ATTEMPT => ''
        ]
      ],
      [
        'name' => 'check password minimum eight character',
        'expected' => [
          'message' => $expected_invalid_password
        ],
        'payload' => [
          Auth::PASSWORD => 'admin',
          Auth::LOCKED_AT => '',
          Auth::LOGIN_FAIL_ATTEMPT => ''
        ],
      ],
      [
        'name' => 'check password at least one uppercase letter',
        'expected' => [
          'message' => $expected_invalid_password
        ],
        'payload' => [
          Auth::PASSWORD => 'admin123',
          Auth::LOCKED_AT => '',
          Auth::LOGIN_FAIL_ATTEMPT => ''
        ]
      ],
      [
        'name' => 'check password at least one lowercase letter',
        'expected' => [
          'message' => $expected_invalid_password
        ],
        'payload' => [
          Auth::PASSWORD => 'A1234567890',
          Auth::LOCKED_AT => '',
          Auth::LOGIN_FAIL_ATTEMPT => ''
        ]
      ],
      [
        'name' => 'check password at least one number',
        'expected' => [
          'message' => $expected_invalid_password
        ],
        'payload' => [
          Auth::PASSWORD => 'Abcdswewfqw',
          Auth::LOCKED_AT => '',
          Auth::LOGIN_FAIL_ATTEMPT => ''
        ]
      ],
      [
        'name' => 'check password at least one special characte',
        'expected' => [
          'message' => $expected_invalid_password
        ],
        'payload' => [
          Auth::PASSWORD => 'Ab1weqsfw',
          Auth::LOCKED_AT => '',
          Auth::LOGIN_FAIL_ATTEMPT => ''
        ]
      ],
      // </editor-fold>
      // <editor-fold desc="validation_test::locked_at">
      [
        'name' => 'check password is required',
        'expected' => [
          'message' => trans('validation.date_format', ['attribute' => Auth::LOCKED_AT, 'format' => 'Y-m-d H:i:s'])
        ],
        'payload' => [
          Auth::PASSWORD => $this->getValidPassword(),
          Auth::LOCKED_AT => "loremIpsum",
          Auth::LOGIN_FAIL_ATTEMPT => ''
        ]
      ],
      // </editor-fold>
      // <editor-fold desc="validation_test::login_fail_attempt">
      [
        'name' => 'check login fail attempt must be an integer',
        'expected' => [
          'message' => trans('validation.regex', ['attribute' => Auth::LOGIN_FAIL_ATTEMPT])
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
          'message' => trans('validation.regex', ['attribute' => Auth::LOGIN_FAIL_ATTEMPT])
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
          'message' => trans('validation.max.numeric', [
            'attribute' => Auth::LOGIN_FAIL_ATTEMPT,
            'max' => Auth::MAX_LOGIN_ATTEMPT
          ])
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
        new Auth($tc['payload'][Auth::PASSWORD], $tc['payload'][Auth::LOCKED_AT], $tc['payload'][Auth::LOGIN_FAIL_ATTEMPT]);
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
   * @throws \App\Exceptions\EntityValidationException
   *
   * @test
   * @testdox getValidLoginFailedAttempt must return null if locked_at is not set or empty or null
   */
  public function getLockedAtMustReturnNullIfNotSetOrNullOrEmptyString() : void {
    $entity = new Auth($this->getValidPassword(), null, $this->getValidLoginFailedAttempt());
    $this->assertNull($entity->getLockedAt());


    $entity = new Auth($this->getValidPassword(), '', $this->getValidLoginFailedAttempt());
    $this->assertNull($entity->getLockedAt());
  }


  /**
   * @return void
   * @throws \App\Exceptions\EntityValidationException
   *
   * @test
   * @testdox getLoginFailAttempt must zero null if login_fail_attempt is not set
   */
  public function getLoginFailAttemptMustReturnZeroIfNotSetOrNullOrEmptyString() : void {
    $entity = new Auth($this->getValidPassword(), null, 0);
    $this->assertEquals(0, $entity->getLoginFailAttempt());


    $entity = new Auth($this->getValidPassword());
    $this->assertEquals(0, $entity->getLoginFailAttempt());
  }
}
