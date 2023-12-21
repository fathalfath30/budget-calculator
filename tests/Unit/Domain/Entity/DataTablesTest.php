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

use App\Domain\Entity\DataTables;
use Exception;
use Tests\TestCase;
use Tests\TestData\DataTablesTestData;

/**
 * DataTableTest
 * This test case is used to testing DataTables entity
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\DataTables
 * @see \Tests\TestData\DataTablesTestData
 * @see \Tests\TestCase
 */
class DataTablesTest extends TestCase {
  use DataTablesTestData;

  // <editor-fold desc="main_testing">

  /**
   * @return void
   * @test
   * @testdox it can crete new datatables entity
   */
  public function itCanCreateNewDataTablesEntity() {
    try {
      $entity = (new DataTables($this->getValidDataTablesKeyword(),
        $this->getValidDataTablesSearchBy(), $this->getValidDataTablesPage(), $this->getValidDataTablesLimit(),
        $this->getValidDataTablesOrderBy()
      ));

      $this->assertEquals($this->getValidDataTablesKeyword(), $entity->getKeyword());
      $this->assertEquals($this->getValidDataTablesSearchBy(), $entity->getSearchBy());
      $this->assertEquals($this->getValidDataTablesPage(), $entity->getPage());
      $this->assertEquals($this->getValidDataTablesLimit(), $entity->getLimit());
      $this->assertEquals($this->getValidDataTablesOrderBy(), $entity->getOrderBy());
      $this->assertEquals(0, $entity->getOffset());
    } catch(Exception $exception) {
      $this->assertNull($exception);
    }
  }

  /**
   * @return void
   * @test
   * @testdox it should set page value into 1 if page value lower than 1
   */
  public function itShouldSetPageValueInto1IfPageValueLowerThan1() {
    try {
      $entity = (new DataTables($this->getValidDataTablesKeyword(),
        $this->getValidDataTablesSearchBy(), '-1', $this->getValidDataTablesLimit(),
        $this->getValidDataTablesOrderBy()
      ));

      $this->assertEquals(1, $entity->getPage());
    } catch(Exception $exception) {
      $this->assertNull($exception);
    }
  }

  /**
   * @return void
   * @test
   * @testdox it should limit to 100 if limit value greater than 100
   */
  public function itShouldLimitTo100IfLimitValueGreaterThan100() {
    try {
      $entity = (new DataTables($this->getValidDataTablesKeyword(),
        $this->getValidDataTablesSearchBy(), $this->getValidDataTablesPage(), 1000,
        $this->getValidDataTablesOrderBy()
      ));

      $this->assertEquals(100, $entity->getLimit());
    } catch(Exception $exception) {
      $this->assertNull($exception);
    }
  }
  // </editor-fold>
}
