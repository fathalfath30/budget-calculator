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

use App\Repository\Models\Role;
use Database\Helper\F30_Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * This migration file will create `roles` table that will store
 * all roles information
 *
 * @version 1.0.0
 * @since 1.0.0
 * @author Fathalfath30
 */
return new class extends F30_Migration {
  public function __construct() {
    $this->table = (new Role())->getTable();
  }

  /**
   * Run the migrations.
   */
  public function up() : void {
    Schema::create($this->getTable(), function(Blueprint $table) {
      $table->uuid('id')
        ->primary();
      $table->string('name');
      $table->string('icon')
        ->nullable();
      $table->integer('level', false, true)
        ->default(0);
      $table->tinyInteger('is_admin', false, true)
        ->default(0);

      // add timestamp
      $this->addTimestamp($table, true);

      // add index
      $this->addIndex($table, ['is_admin']);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down() : void {
    Schema::dropIfExists($this->getTable());
  }
};
