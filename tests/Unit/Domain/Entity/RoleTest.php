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

use App\Domain\Entity\Entity;
use App\Domain\Entity\Role;
use App\Exceptions\EntityException;
use Exception;
use Faker\Factory as Faker;
use Faker\Generator;
use Tests\TestCase;
use Tests\TestData\RoleTestData;
use Tests\TestData\TimestampTestData;

class RoleTest extends TestCase {
  use RoleTestData, TimestampTestData;

  private Generator $faker;

  public function __construct(string $name) {
    parent::__construct($name);
    $this->faker = Faker::Create('id_ID');
  }

  /**
   * Test the validation on each input
   *
   * @return void
   * @test
   */
  public function validateInput() {
    $testCase = [
      // validation test: id
      [
        'name' => 'id is required',
        'expected' => [
          'message' => 'The id field is required.'
        ],
        'payload' => []
      ],
      [
        'name' => 'id must be a valid uuid',
        'expected' => [
          'message' => 'The id field must be a valid UUID.'
        ],
        'payload' => [
          Role::ID => 'lorem'
        ]
      ],

      // validation test name
      [
        'name' => 'name is required',
        'expected' => [
          'message' => 'The name field is required.'
        ],
        'payload' => [
          Role::ID => $this->faker->uuid,
          Role::NAME => ''
        ]
      ],
      [
        'name' => 'id must be a valid uuid',
        'expected' => [
          'message' => 'The name field format is invalid.'
        ],
        'payload' => [
          Role::ID => $this->faker->uuid,
          Role::NAME => 'Lorem!@#'
        ]
      ],

      // validation test level
      [
        'name' => 'level must be a valid integer',
        'expected' => [
          'message' => 'The level field must be an integer.'
        ],
        'payload' => [
          Role::ID => $this->faker->uuid,
          Role::NAME => 'Lorem Ipsum',
          Role::LEVEL => 'XXX'
        ]
      ],
      [
        'name' => 'level must be greater than 0',
        'expected' => [
          'message' => 'The level field must be at least 1.'
        ],
        'payload' => [
          Role::ID => $this->faker->uuid,
          Role::NAME => 'Lorem Ipsum',
          Role::LEVEL => '0'
        ]
      ],
      [
        'name' => 'level must be less than 999',
        'expected' => [
          'message' => 'The level field must not be greater than 998.'
        ],
        'payload' => [
          Role::ID => $this->faker->uuid,
          Role::NAME => 'Lorem Ipsum',
          Role::LEVEL => '999'
        ]
      ],

      // validation test timestamp
      [
        'name' => 'timestamp must be instance of Timestamp entity',
        'expected' => [
          'message' => trans('exception.domain.instance_of.timestamp')
        ],
        'payload' => [
          Role::ID => $this->faker->uuid,
          Role::NAME => 'Lorem Ipsum',
          Role::LEVEL => '1',
          Entity::TIMESTAMP => 'xx'
        ]
      ]
    ];

    foreach($testCase as $tc) {
      try {
        new Role($tc['payload']);
      } catch(Exception $e) {
        /** @var EntityException $e */
        $this->assertStringMatchesFormat($tc['expected']['message'], $e->getMessage());
        $this->assertInstanceOf(EntityException::class, $e);
        $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
      }
    }
  }

  /**
   * roleMustHaveGetterFunction
   *
   * this function will test role domain to get valid getter for default payload (id, name, and level).
   *
   * @return void
   * @test
   */
  public function roleMustHaveGetterFunction() {
    try {
      $role = $this->ValidRoleEntity(true);
      $this->assertEquals($this->ValidRoleId(true), $role->getId());
      $this->assertEquals($this->ValidRoleName(true), $role->getName());
      $this->assertEquals(Role::USER_LEVEL_SUPER_ADMIN, $role->getLevel());


      $ts = $role->getTimestamp();
      $this->assertEquals($this->ValidTimestampEntity(), $ts);
      $this->assertEquals(self::SAMPLE_DATE_TIME, $ts->getCreatedAt());
      $this->assertEquals(self::SAMPLE_DATE_TIME, $ts->getUpdatedAt());
    } catch(Exception $exception) {
      $this->assertNull($exception);
    }
  }


  /**
   * @return void
   * @test
   * @testdox isSuperAdmin must return true if role level is super admin
   */
  public function isSuperAdminMustReturnTrueIfRoleLevelIsSuperAdmin() {
    try {
      $role = $this->ValidRoleEntity(true);
      $this->assertTrue($role->isSuperAdmin());
    } catch(Exception $exception) {
      $this->assertNull($exception);
    }
  }


  /**
   * @return void
   * @test
   * @testdox isGuest must return true if role level is guest
   */
  public function isGuestMustReturnTrueIfRoleLevelIsGuest() {
    try {
      $role = $this->ValidRoleEntity(false);
      $this->assertTrue($role->isGuest());
    } catch(Exception $exception) {
      $this->assertNull($exception);
    }
  }

  /**
   * @return void
   * @test
   * @testdox setSuper must set user level to 999
   */
  public function setSuperAdminMustSetUserLevelTo999() {
    try {
      $role = $this->ValidRoleEntity();
      $this->assertFalse($role->isSuperAdmin());

      $this->assertInstanceOf(Role::class, $role->setSuperAdmin());
      $this->assertEquals(Role::USER_LEVEL_SUPER_ADMIN, $role->getLevel());
      $this->assertTrue($role->isSuperAdmin());
    } catch(Exception $exception) {
      $this->assertNull($exception);
    }
  }

  /**
   * @return void
   * @test
   * @testdox setGuest must set user level to 0
   */
  public function setGuestMustSetUserLevelTo0() {
    try {
      $role = $this->ValidRoleEntity(true);
      $this->assertTrue($role->isSuperAdmin());

      $this->assertInstanceOf(Role::class, $role->setGuest());
      $this->assertEquals(Role::USER_LEVEL_GUEST, $role->getLevel());
      $this->assertFalse($role->isSuperAdmin());
    } catch(Exception $exception) {
      $this->assertNull($exception);
    }
  }
}
