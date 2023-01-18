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

namespace Tests\Unit\Traits;

use App\Domain\Entity\Timestamp;
use App\Exceptions\EntityException;
use App\Traits\StandardEntity;
use PHPUnit\Framework\TestCase;
use Tests\Data\TimestampTestData;

class StandardEntityTest extends TestCase {
  private object $class;

  protected function setUp() : void {
    parent::setUp();
    $this->class = (new class {
      use StandardEntity;
    });
  }

  public function test_IdIsRequired() {
    $this->expectException(EntityException::class);
    $this->expectExceptionMessage("entity.id.required");

    $this->class->setId("");
  }

  public function test_IdMustBeValidUUIDV4() {
    $this->expectException(EntityException::class);
    $this->expectExceptionMessage("entity.id.invalid");

    $this->class->setId("sample");
  }

  public function test_ItNameIsRequired() {
    $this->expectException(EntityException::class);
    $this->expectExceptionMessage("entity.name.required");

    $this->class->setName("");
  }

  public function test_ItCanGetSetTimestamp() {
    $this->class->setTimestamp(TimestampTestData::validTimestampEntity());
    $this->assertInstanceOf(Timestamp::class, $this->class->getTimestamp());
  }
}
