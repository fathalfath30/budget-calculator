<?php

use App\Repository\Models\Group;
use Database\Helper\F30_Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Group
 *
 * This migration will create "group" table, this table is used to grouping
 * accounts
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \Database\Helper\F30_Migration
 */
return new class extends F30_Migration {

  /**
   * constructor
   *
   * @author Fathalfath30
   * @version 1.0.0
   * @since 1.0.0
   */
  public function __construct() {
    $this->table = (new Group())->getTable();
  }

  /**
   * Run the migrations.
   *
   * @author Fathalfath30
   * @version 1.0.0
   * @since 1.0.0
   */
  public function up() : void {
    Schema::create($this->getTable(), function(Blueprint $table) {
      $table->uuid('id');
      $table->string('name');
      $table->text('description')
        ->nullable();

      // add timestamp
      $this->addTimestamp($table);

      //  set primary key
      $table->primary(['id']);

      // add index
      $this->addIndex($table, ['name']);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @author Fathalfath30
   * @version 1.0.0
   * @since 1.0.0
   */
  public function down() : void {
    Schema::dropIfExists($this->getTable());
  }
};
