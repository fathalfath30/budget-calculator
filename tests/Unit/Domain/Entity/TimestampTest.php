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

use App\Domain\Entity\Timestamp;
use App\Domain\Entity\Timestamp as TimestampEntity;
use App\Exceptions\EntityValidationException;
use Exception;
use Ramsey\Uuid\Type\Time;
use Tests\TestCase;
use Tests\TestData\TimestampTestData;

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
class TimestampTest extends TestCase {
  use TimestampTestData;

  /**
   * @return void
   * @test
   * @testdox it can make timestamp entity
   */
  public function itCanMakeTimestampEntity() {
    try {
      $result = TimestampEntity::make([
        TimestampEntity::created_at => $this->getValidSampleTimestamp(),
        TimestampEntity::updated_at => $this->getValidSampleTimestamp(),
        TimestampEntity::deleted_at => $this->getValidSampleTimestamp()
      ]);

      $this->assertNotNull($result);
      $this->assertInstanceOf(TimestampEntity::class, $result);
      $this->assertEquals($this->getValidSampleTimestamp(), $result->getCreatedAt());
      $this->assertEquals($this->getValidSampleTimestamp(), $result->getUpdatedAt());
      $this->assertEquals($this->getValidSampleTimestamp(), $result->getDeletedAt());

    } catch(Exception $exception) {
      $this->assertNull($exception);
    }
  }

  /**
   * @return void
   * @test
   * @testdox if deleted_at is empty it should convert into null
   */
  public function ifDeletedAtIsEmptyItShouldConvertedIntoNull() {
    // <editor-fold desc="using empty string should be null">
    try {
      $result = TimestampEntity::make([
        TimestampEntity::created_at => $this->getValidSampleTimestamp(),
        TimestampEntity::updated_at => $this->getValidSampleTimestamp(),
        TimestampEntity::deleted_at => ""
      ]);

      $this->assertNotNull($result);
      $this->assertInstanceOf(TimestampEntity::class, $result);
      $this->assertNull($result->getDeletedAt());

    } catch(Exception $exception) {
      $this->assertNull($exception);
    }
    // </editor-fold>
    // <editor-fold desc="if null then it should be null">
    try {
      $result = TimestampEntity::make([
        TimestampEntity::created_at => $this->getValidSampleTimestamp(),
        TimestampEntity::updated_at => $this->getValidSampleTimestamp(),
        TimestampEntity::deleted_at => null
      ]);

      $this->assertNotNull($result);
      $this->assertInstanceOf(TimestampEntity::class, $result);
      $this->assertNull($result->getDeletedAt());

    } catch(Exception $exception) {
      $this->assertNull($exception);
    }
    // </editor-fold>
  }

  /**
   * @return void
   *
   * @test
   * @testdox it can create new timestamp
   */
  public function itCanCreateNewTimestamp() {
    try {
      $result = TimestampEntity::create([
        TimestampEntity::created_at => $this->getValidSampleTimestamp(),
        TimestampEntity::updated_at => $this->getValidSampleTimestamp(),
        TimestampEntity::deleted_at => null
      ]);

      $this->assertNotNull($result);
      $this->assertInstanceOf(TimestampEntity::class, $result);
      $this->assertNull($result->getDeletedAt());

    } catch(Exception $exception) {
      $this->assertNull($exception);
    }
  }

  // <editor-fold desc="validationTest">
  // <editor-fold desc="validationTest::created_at">
  /**
   * @return void
   * @test
   * @testdox validate created_at is required
   */
  public function validateCreatedAtIsRequired() {
    try {
      TimestampEntity::create([
        TimestampEntity::created_at => '',
      ]);
    } catch(Exception $exception) {
      $this->assertNotNull($exception);
      $this->assertInstanceOf(EntityValidationException::class, $exception);

      $this->assertEquals(trans('validation.required', ['attribute' => TimestampEntity::created_at]),
        $exception->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $exception->getStatusCode());
      $this->assertEquals(400, $exception->getCode());
    }
  }

  /**
   * @return void
   * @test
   * @testdox validate created_at format must be valid "Y-m-d H:i:s"
   */
  public function validateCreatedAtFormatMustBeValidYmdHis() {
    try {
      TimestampEntity::create([
        TimestampEntity::created_at => 'xxxx',
      ]);
    } catch(Exception $exception) {
      $this->assertNotNull($exception);
      $this->assertInstanceOf(EntityValidationException::class, $exception);

      $this->assertEquals(trans('validation.date_format', [
        'attribute' => TimestampEntity::created_at, 'format' => 'Y-m-d H:i:s'
      ]), $exception->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $exception->getStatusCode());
      $this->assertEquals(400, $exception->getCode());
    }
  }
  // </editor-fold>
  // <editor-fold desc="validationTest::updated_at">
  /**
   * @return void
   * @test
   * @testdox validate updated_at is required
   */
  public function validateUpdatedAtIsRequired() {
    try {
      TimestampEntity::create([
        TimestampEntity::created_at => $this->getValidSampleTimestamp(),
      ]);
    } catch(Exception $exception) {
      $this->assertNotNull($exception);
      $this->assertInstanceOf(EntityValidationException::class, $exception);

      $this->assertEquals(trans('validation.required', ['attribute' => TimestampEntity::updated_at]),
        $exception->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $exception->getStatusCode());
      $this->assertEquals(400, $exception->getCode());
    }
  }

  /**
   * @return void
   * @test
   * @testdox validate updated_at format must be valid "Y-m-d H:i:s"
   */
  public function validateUpdatedAtFormatMustBeValidYmdHis() {
    try {
      TimestampEntity::create([
        TimestampEntity::created_at => $this->getValidSampleTimestamp(),
        TimestampEntity::updated_at => 'xxx'
      ]);
    } catch(Exception $exception) {
      $this->assertNotNull($exception);
      $this->assertInstanceOf(EntityValidationException::class, $exception);

      $this->assertEquals(trans('validation.date_format', [
        'attribute' => TimestampEntity::updated_at, 'format' => 'Y-m-d H:i:s'
      ]), $exception->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $exception->getStatusCode());
      $this->assertEquals(400, $exception->getCode());
    }
  }
  // </editor-fold>
  // <editor-fold desc="validationTest::updated_at">
  /**
   * @return void
   * @test
   * @testdox validate deleted_at is required
   */
  /**
   * @return void
   * @test
   * @testdox validate deleted_at format must be valid "Y-m-d H:i:s"
   */
  public function validateDeletedAtFormatMustBeValidYmdHis() {
    try {
      TimestampEntity::create([
        TimestampEntity::created_at => $this->getValidSampleTimestamp(),
        TimestampEntity::updated_at =>  $this->getValidSampleTimestamp(),
        TimestampEntity::deleted_at => 'xxx'
      ]);
    } catch(Exception $exception) {
      $this->assertNotNull($exception);
      $this->assertInstanceOf(EntityValidationException::class, $exception);

      $this->assertEquals(trans('validation.date_format', [
        'attribute' => TimestampEntity::deleted_at, 'format' => 'Y-m-d H:i:s'
      ]), $exception->getMessage());
      $this->assertEquals(config('response_code.user.error.bad_request'), $exception->getStatusCode());
      $this->assertEquals(400, $exception->getCode());
    }
  }
  // </editor-fold>
  // </editor-fold>
}
