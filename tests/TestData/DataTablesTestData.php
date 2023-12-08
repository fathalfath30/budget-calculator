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

namespace Tests\TestData;

/**
 * DataTablesTestData
 *
 * This traits will provide DataTables entity sample
 * and valid data
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\DataTables
 * @see \Tests\Unit\Domain\Entity\DataTablesTest
 */
trait DataTablesTestData {
  /**
   * Get sample valid keyword
   *
   * @return string
   *
   * @author Fathalfath30
   * @version 1.0.0
   */
  public function getValidDataTablesKeyword() : string {
    return "lorem ipsum";
  }

  /**
   * Get valid search by data
   *
   * @return string
   *
   * @author Fathalfath30
   * @version 1.0.0
   */
  public function getValidDataTablesSearchBy() : string {
    return "username";
  }

  /**
   * Get valid page data
   *
   * @return int
   *
   * @author Fathalfath30
   * @version 1.0.0
   */
  public function getValidDataTablesPage() : int {
    return 1;
  }

  /**
   * Get valid data tables limit
   *
   * @return int
   *
   * @author Fathalfath30
   * @version 1.0.0
   */
  public function getValidDataTablesLimit() : int {
    return 10;
  }

  /**
   * Get valid order by value
   *
   * @return array[]
   *
   * @author Fathalfath30
   * @version 1.0.0
   */
  public function getValidDataTablesOrderBy() : array {
    return [
      ['id', 'asc']
    ];
  }
}
