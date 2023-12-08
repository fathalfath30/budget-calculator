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

  // <editor-fold desc="validationCheck::id">

  /**
   * @return void
   * @test
   * @testdox validate id is required
   */
  public function validateIdIsRequired() : void {
    try {
      new Role('', '', '', '', null);
    } catch(EntityValidationException $e) {
      $this->assertInstanceOf(EntityValidationException::class, $e);
      $this->assertEquals(trans('validation.required', ['attribute' => Role::ID]), $e->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
      $this->assertEquals(400, $e->getCode());
    }
  }

  /**
   * @return void
   * @test
   * @testdox validate id must be a valid UUIDv4 format
   */
  public function validateIdMustBeAValidUUIDV4Format() {
    try {
      new Role('lorem', '', '', '', null);
    } catch(EntityValidationException $e) {
      $this->assertInstanceOf(EntityValidationException::class, $e);
      $this->assertEquals(trans('validation.uuid', ['attribute' => Role::ID]), $e->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
      $this->assertEquals(400, $e->getCode());
    }
  }
  // </editor-fold>
  // <editor-fold desc="validationCheck::name">

  /**
   * @return void
   * @test
   * @testdox validate name is required
   */
  public function validateNameIsRequired() {
    try {
      new Role($this->getValidRoleId(), '', '', '', null);
    } catch(EntityValidationException $e) {
      $this->assertInstanceOf(EntityValidationException::class, $e);
      $this->assertEquals(trans('validation.required', ['attribute' => Role::NAME]), $e->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
      $this->assertEquals(400, $e->getCode());
      return;
    }
    $this->fail("expecting EntityValidationException but receive nothing");
  }
  // </editor-fold>
  // <editor-fold desc="validationCheck::level">
  /**
   * @return void
   * @test
   * @testdox validate level must be a valid number
   */
  public function validateLevelMustBeAValidNumber(){
    try {
      new Role($this->getValidRoleId(), $this->getValidRoleName(), 'abcd', '', null);
    } catch(EntityValidationException $e) {
      $this->assertInstanceOf(EntityValidationException::class, $e);
      $this->assertEquals(trans('validation.integer', ['attribute' => Role::LEVEL]), $e->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
      $this->assertEquals(400, $e->getCode());
      return;
    }
    $this->fail("expecting EntityValidationException but receive nothing");
  }

  /**
   * @return void
   * @test
   * @testdox validate level must be greater than zero
   */
  public function validateLevelMustBeLowerThanZero(){
    try {
      new Role($this->getValidRoleId(), $this->getValidRoleName(), '1000', '', null);
    } catch(EntityValidationException $e) {
      $this->assertInstanceOf(EntityValidationException::class, $e);
      $this->assertEquals(trans('validation.between.numeric', [
        'attribute' => 'level',
        'min' => Role::USER_LEVEL_GUEST,
        'max' => Role::USER_LEVEL_SUPER_ADMIN
      ]), $e->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $e->getStatusCode());
      $this->assertEquals(400, $e->getCode());
      return;
    }
    $this->fail("expecting EntityValidationException but receive nothing");
  }
  // </editor-fold>

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
      $this->assertEquals($this->getValidRoleIcon(), $role->getIcon());

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
