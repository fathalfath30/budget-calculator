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

namespace App\Helper;

use Illuminate\Database\Migrations\Migration;

/**
 * F30Migration helper
 *
 * @version 1.0.0
 * @since 0.1.0
 *
 * @author Fathalfath30
 */
class F30Migration extends Migration
{
  /** @var string $table */
  private string $table;

  /** @var null|\Illuminate\Database\Eloquent\Model|string $model */
  protected string $model;

  /**
   * F30Migration constructor
   *
   * @version 1.0.0
   * @since 0.1.0
   *
   * @author Fathalfath30
   */
  public function __construct()
  {
    if(!empty($this->model)) {
      $this->table = (new $this->model)->getTable();
    }
  }

  protected function getTable() : string
  {
    return $this->table;
  }
}
