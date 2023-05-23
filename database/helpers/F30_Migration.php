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

namespace Database\Helper;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * F30_Migration
 *
 * This helper class is used to simplify migration code such as get table name, buldi some
 * repeating code and more
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \Illuminate\Database\Migrations\Migration
 */
class F30_Migration extends Migration {
  /** @var string $table table name */
  protected string $table;

  /** @var int $indexCounter counter for creating new index */
  protected int $indexCounter = 1;

  /** @var int $foreignKeyCounter counter for creating new foreign key */
  protected int $foreignKeyCounter = 1;

  /**
   * This method will return table name from $table variable
   *
   * @return string
   * @version 1.0.0
   * @since 1.0.0
   */
  protected function getTable() : string {
    return $this->table;
  }

  /**
   * This method will add timestamp field 'created_at', 'updated_at' and 'deleted_at'
   *
   * @param \Illuminate\Database\Schema\Blueprint $blueprint table blueprint
   * @param bool $softDeletes if true it will add 'deleted_at' column
   *
   * @return void
   * @version 1.0.0
   * @since 1.0.0
   */
  protected function addTimestamp(Blueprint $blueprint, bool $softDeletes = false) : void {
    $blueprint->timestamps();
    if($softDeletes) {
      $blueprint->softDeletes();
    }
  }

  /**
   * addIndex will create new index on selected table, as default it will create
   * index name with format : 'idx_<table_name>_<index_counter>'
   *
   * @param \Illuminate\Database\Schema\Blueprint $blueprint
   * @param array $column
   *
   * @return void
   * @version 1.0.0
   * @since 1.0.0
   */
  protected function addIndex(Blueprint $blueprint, array $column) : void {
    $blueprint->index($column, sprintf("idx_%s_%d", $this->getTable(), $this->indexCounter++));
  }

  /**
   * addForeign will create new foreign key on selected table, as default it will create
   * index name with format : 'fk_<table_name>_<index_counter>'
   *
   * @param \Illuminate\Database\Schema\Blueprint $blueprint
   * @param string $column foreign key column
   * @param string $on parent table
   * @param string $reference reference field with default value 'id'
   * @param string $onUpdate on update default 'cascade'
   * @param string $onDelete on delete default 'cascade'
   *
   * @return void
   * @version 1.0.0
   * @since 1.0.0
   */
  protected function addForeign(Blueprint $blueprint, string $column, string $on, string $reference = 'id',
    string $onUpdate = 'cascade', string $onDelete = 'cascade') : void {
    $blueprint->foreign($column, sprintf("fk_%s_%d", $this->getTable(), $this->foreignKeyCounter++))
      ->references($reference)
      ->on($on)
      ->onUpdate($onUpdate)
      ->onDelete($onDelete);
  }
}
