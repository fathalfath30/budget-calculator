<?php

use App\Repository\Models\Budget;
use App\Repository\Models\User;
use Database\Helper\F30_Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Budget
 *
 * This migration will create "budget" table to keep users current and feature budget
 * information
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
    $this->table = (new Budget())->getTable();
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
      $table->char('id', 36);
      $table->string('name');
      $table->decimal('amount', 15, 2)->default(0);
      $table->date('target')
        ->nullable();
      $table->uuid('user_id');
      $table->tinyInteger('budget_type', false, true)
        ->comment('0: once; 1: daily; 2: weekly; 3: monthly; 4: yearly')
        ->default(0);

      // add timestamp
      $this->addTimestamp($table, true);

      // set primary key
      $table->primary(['id']);

      // add index
      $this->addIndex($table, ['name', 'budget_type']);
      $this->addIndex($table, ['user_id']);

      // add foreign key
      $this->addForeign($table, 'user_id', (new User())->getTable());
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
