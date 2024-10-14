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

use App\Domain\Entity\DataTables;
use Tests\TestCase;

/**
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\Email
 * @see \Tests\TestData\EmailTestData
 * @see \Tests\TestData\TimestampTestData
 *
 * @author Fathalfath30
 */
class DataTablesTest extends TestCase {
  /**
   * @return void
   * @throws \App\Exceptions\EntityValidationException
   * @throws \Illuminate\Validation\ValidationException
   *
   * @test
   * @testdox it should return default value
   *
   * @version 1.0.0
   * @since 1.0.0
   */
  public function itShouldReturnDefaultValue() {
    $result = DataTables::create();
    $this->assertnotnull($result);
    $this->assertInstanceOf(Datatables::class, $result);
    $this->assertNull($result->getKeyword());
    $this->assertNull($result->getSearchBy());
    $this->assertNull($result->getOrderBy());
    $this->assertEquals(DataTables::DefaultPage, $result->getPage());
    $this->assertEquals(DataTables::MinimumLimit, $result->getLimit());
  }
}
