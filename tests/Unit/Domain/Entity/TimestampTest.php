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

use App\Domain\Entity\Timestamp;
use App\Exceptions\EntityException;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\TestCase;
use Tests\Data\TimestampTestData;

class TimestampTest extends TestCase {
  public function test_ItCanCreateNewTimestampEntityWithNullDeletedAt() {
    $class = Timestamp::create(TimestampTestData::validStrTimestamp(), TimestampTestData::validStrTimestamp());

    $this->assertInstanceOf(Carbon::class, $class->getCreatedAt());
    $this->assertInstanceOf(Carbon::class, $class->getUpdatedAt());
    $this->assertNull($class->getDeletedAt());
  }

  public function test_ItCanCreateNewTimestampEntityWithNotNullDeletedAt() {
    $class = Timestamp::create(TimestampTestData::validStrTimestamp(), TimestampTestData::validStrTimestamp(),
      TimestampTestData::validStrTimestamp());

    $this->assertInstanceOf(Carbon::class, $class->getCreatedAt());
    $this->assertInstanceOf(Carbon::class, $class->getUpdatedAt());
    $this->assertInstanceOf(Carbon::class, $class->getDeletedAt());
  }

  // <editor-fold desc="negative test case">
  public function test_CreatedAtIsRequired() {
    $this->expectException(EntityException::class);
    $this->expectExceptionMessage("entity.created_at.required");

    Timestamp::create("", "");
  }

  public function test_UpdatedAtIsRequired() {
    $this->expectException(EntityException::class);
    $this->expectExceptionMessage("entity.updated_at.required");

    Timestamp::create(TimestampTestData::validStrTimestamp(), "");
  }
  // </editor-fold>
}
