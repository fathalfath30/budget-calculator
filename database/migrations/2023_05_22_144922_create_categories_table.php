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

use App\Models\Category;
use Database\Helper\F30_Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * New table to keep all transaction history category, this table has relation with itself to get parent category
 *
 * @version 1.0.0
 * @since 1.0.0
 * @author Fathalfath30
 */
return new class extends F30_Migration {
  public function __construct() {
    $this->table = (new Category())->getTable();
  }

  /**
   * Run the migrations.
   */
  public function up() : void {
    Schema::create($this->getTable(), function(Blueprint $table) {
      $table->uuid('id');
      $table->uuid('parent_id')
        ->nullable();
      $table->string('name');
      $table->longText('description')
        ->nullable();
      $table->tinyInteger('income', false, true)
        ->default('0');
      $table->tinyInteger('expense', false, true)
        ->default('0');

      // add timestamp with soft_deletes
      $this->addTimestamp($table, true);

      // add primary key
      $table->primary(['id']);

      // add index
      $this->addIndex($table, ['parent_id', 'name']);

      // add foreign key
      $this->addForeign($table, 'parent_id', $this->getTable());
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down() : void {
    Schema::dropIfExists($this->getTable());
  }
};
