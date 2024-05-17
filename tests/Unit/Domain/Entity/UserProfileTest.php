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

use App\Domain\Entity\UserProfile;
use App\Exceptions\EntityValidationException;
use Exception;
use Faker\Factory;
use Faker\Generator;
use Tests\TestCase;
use Tests\TestData\SampleLongText;
use Tests\TestData\UserProfileTestData;

/**
 *
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\Timestamp
 * @see \Tests\TestData\TimestampTestData
 *
 * @author Fathalfath30
 * @testdox UserProfile entity test case
 */
class UserProfileTest extends TestCase {
  use SampleLongText, UserProfileTestData;

  private Generator $faker;

  protected function setUp() : void {
    parent::setUp();
    $this->faker = Factory::create(app()->getLocale());
  }

  /**
   * Test the validation on each input
   *
   * @return void
   * @test
   */
  public function validateInput() {
    $testCase = [
      [
        'name' => 'Firstname is required',
        'expected' => [
          'message' => trans('validation.required', ['attribute' => 'firstname'])
        ],
        'payload' => [
          UserProfile::Firstname => '',
          UserProfile::Lastname => null,
          UserProfile::Username => ''
        ]
      ],
      [
        'name' => 'Firstname must be at least 3 character',
        'expected' => [
          'message' => trans('validation.min.string', ['attribute' => 'firstname', 'min' => 3])
        ],
        'payload' => [
          UserProfile::Firstname => 'aa',
          UserProfile::Lastname => null,
          UserProfile::Username => ''
        ]
      ],
      [
        'name' => 'Firstname must not exceed 150 characters',
        'expected' => [
          'message' => trans('validation.max.string', ['attribute' => 'firstname', 'max' => 150])
        ],
        'payload' => [
          UserProfile::Firstname => $this->getSampleLongText155(),
          UserProfile::Lastname => null,
          UserProfile::Username => ''
        ]
      ],
      [
        'name' => 'Firstname must be a valid name format',
        'expected' => [
          'message' => trans('validation.regex', ['attribute' => 'firstname'])
        ],
        'payload' => [
          UserProfile::Firstname => "L0r3m !psum",
          UserProfile::Lastname => null,
          UserProfile::Username => ''
        ]
      ],

      [
        'name' => 'Lastname must be a valid name format',
        'expected' => [
          'message' => trans('validation.min.string', ['attribute' => 'lastname', 'min' => 3])
        ],
        'payload' => [
          UserProfile::Firstname => $this->getSampleFirstname(),
          UserProfile::Lastname => 'aa',
          UserProfile::Username => ''
        ]
      ],
      [
        'name' => 'Lastname must not exceed 150 characters',
        'expected' => [
          'message' => trans('validation.max.string', ['attribute' => 'lastname', 'max' => 150])
        ],
        'payload' => [
          UserProfile::Firstname => $this->getSampleFirstname(),
          UserProfile::Lastname => $this->getSampleLongText155(),
          UserProfile::Username => ''
        ]
      ],
      [
        'name' => 'Lastname must be a valid name format',
        'expected' => [
          'message' => trans('validation.regex', ['attribute' => 'lastname'])
        ],
        'payload' => [
          UserProfile::Firstname => $this->getSampleFirstname(),
          UserProfile::Lastname => "L0r3m !psum",
          UserProfile::Username => ''
        ]
      ],

      [
        'name' => 'username is required',
        'expected' => [
          'message' => trans('validation.required', ['attribute' => 'username'])
        ],
        'payload' => [
          UserProfile::Firstname => $this->getSampleFirstname(),
          UserProfile::Lastname => $this->getSampleLastname(),
          UserProfile::Username => ''
        ]
      ],
      [
        'name' => 'username must be at least 6 characters',
        'expected' => [
          'message' => trans('validation.min.string', ['attribute' => 'username', 'min' => 6])
        ],
        'payload' => [
          UserProfile::Firstname => $this->getSampleFirstname(),
          UserProfile::Lastname => $this->getSampleLastname(),
          UserProfile::Username => 'aa'
        ]
      ],
      [
        'name' => 'Firstname must not exceed 28 characters',
        'expected' => [
          'message' => trans('validation.max.string', ['attribute' => 'username', 'max' => 28])
        ],
        'payload' => [
          UserProfile::Firstname => $this->getSampleFirstname(),
          UserProfile::Lastname => $this->getSampleLastname(),
          UserProfile::Username => $this->getSampleLongText155()
        ]
      ],
      [
        'name' => 'Firstname must be a valid name format 1',
        'expected' => [
          'message' => trans('validation.regex', ['attribute' => 'username'])
        ],
        'payload' => [
          UserProfile::Firstname => $this->getSampleFirstname(),
          UserProfile::Lastname => $this->getSampleLastname(),
          UserProfile::Username => 'L0r3m !psum'
        ]
      ],
      [
        'name' => 'Firstname must be a valid name format 2',
        'expected' => [
          'message' => trans('validation.regex', ['attribute' => 'username'])
        ],
        'payload' => [
          UserProfile::Firstname => $this->getSampleFirstname(),
          UserProfile::Lastname => $this->getSampleLastname(),
          UserProfile::Username => 'L0r3m!psum'
        ]
      ],
      [
        'name' => 'Firstname must be a valid name format 2',
        'expected' => [
          'message' => trans('validation.regex', ['attribute' => 'username'])
        ],
        'payload' => [
          UserProfile::Firstname => $this->getSampleFirstname(),
          UserProfile::Lastname => $this->getSampleLastname(),
          UserProfile::Username => 'L0r3m psum'
        ]
      ],
    ];

    foreach($testCase as $tc) {
      $exception = false;
      try {
        UserProfile::create($tc['payload'][UserProfile::Firstname], $tc['payload'][UserProfile::Lastname],
          $tc['payload'][UserProfile::Username]);
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
   * @throws \Exception
   *
   * @test
   * @testdox created_at and updated_at must return constructed value
   */
  public function createdAtAndUpdateAtMustReturnConstructedValue() {
    $result = UserProfile::create($this->getSampleFirstname(), $this->getSampleLastname(),
      $this->getSampleUsername());

    $this->assertNotNull($result);
    $this->assertInstanceOf(UserProfile::class, $result);
    $this->assertEquals($this->getSampleFirstname(), $result->getFirstname());
    $this->assertEquals($this->getSampleLastname(), $result->getLastname());
    $this->assertEquals($this->getSampleUsername(), $result->getUsername());
  }

  /**
   * @return void
   * @throws \Exception
   *
   * @test
   * @testdox lastname should return null if null or empty
   */
  public function lastnameShouldReturnNullIfNullOrEmpty() {
    $result = UserProfile::create($this->getSampleFirstname(), "", $this->getSampleUsername());
    $this->assertNotNull($result);
    $this->assertInstanceOf(UserProfile::class, $result);
    $this->assertNull($result->getLastname());

    $result = UserProfile::create($this->getSampleFirstname(), null, $this->getSampleUsername());
    $this->assertNotNull($result);
    $this->assertInstanceOf(UserProfile::class, $result);
    $this->assertNull($result->getLastname());

    $result = UserProfile::create($this->getSampleFirstname(), " ", $this->getSampleUsername());
    $this->assertNotNull($result);
    $this->assertInstanceOf(UserProfile::class, $result);
    $this->assertNull($result->getLastname());
  }
}
