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
use App\Domain\Entity\Traits\Entity;
use App\Exceptions\EntityValidationException;
use Exception;
use Faker\Factory as Faker;
use Faker\Generator;
use Tests\TestCase;
use Tests\TestData\RoleTestData;

class RoleTest extends TestCase {
  use RoleTestData;

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
        'payload' => [
          Role::ID => '',
          Role::NAME => '',
          Role::LEVEL => 0,
          Entity::TIMESTAMP => null,
        ]
      ],
      [
        'name' => 'id must be a valid uuid',
        'expected' => [
          'message' => 'The id field must be a valid UUID.'
        ],
        'payload' => [
          Role::ID => 'lorem',
          Role::NAME => '',
          Role::LEVEL => 0,
          Entity::TIMESTAMP => null,
        ]
      ],

      // validation test name
      [
        'name' => 'name is required',
        'expected' => [
          'message' => 'The name field is required.'
        ],
        'payload' => [
          Role::ID => $this->faker->uuid(),
          Role::NAME => '',
          Role::LEVEL => 0,
          Entity::TIMESTAMP => null,
        ]
      ],
      [
        'name' => 'id must be a valid uuid',
        'expected' => [
          'message' => 'The name field format is invalid.'
        ],
        'payload' => [
          Role::ID => $this->faker->uuid(),
          Role::NAME => 'Lorem!@#',
          Role::LEVEL => 0,
          Entity::TIMESTAMP => null,
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
          Role::LEVEL => 'XXX',
          Entity::TIMESTAMP => null,
        ]
      ]
    ];

    foreach($testCase as $tc) {
      $exception = false;
      try {
        new Role($tc['payload'][Role::ID], $tc['payload'][Role::NAME], $tc['payload'][Role::LEVEL],
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
   * roleMustHaveGetterFunction
   *
   * this function will test role domain to get valid getter for default payload (id, name, and level).
   *
   * @return void
   * @test
   */
  public function roleMustHaveGetterFunction() {
    try {
      $role = $this->getValidRoleEntity(true);
      $this->assertEquals($this->getValidRoleId(true), $role->getId());
      $this->assertEquals($this->getValidRoleName(true), $role->getName());
      $this->assertEquals(Role::USER_LEVEL_SUPER_ADMIN, $role->getLevel());


      $ts = $role->getTimestamp();
      $this->assertEquals($this->getValidTimestampEntity(), $ts);
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
      $role = $this->getValidRoleEntity(true);
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
      $role = $this->getValidRoleEntity();
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
      $role = $this->getValidRoleEntity();
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
      $role = $this->getValidRoleEntity(true);
      $this->assertTrue($role->isSuperAdmin());

      $this->assertInstanceOf(Role::class, $role->setGuest());
      $this->assertEquals(Role::USER_LEVEL_GUEST, $role->getLevel());
      $this->assertFalse($role->isSuperAdmin());
    } catch(Exception $exception) {
      $this->assertNull($exception);
    }
  }
}
