<?php

use App\Repository\Models\Account;
use App\Repository\Models\Group;
use App\Repository\Models\User;
use Database\Helper\F30_Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Accounts
 *
 * This migration will create table to keep users accounts (not for login) but
 * to keep basic information such as bank name, card name to identify
 * transaction history.
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
    $this->table = (new Account())->getTable();
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
      $table->uuid('parent_id')
        ->nullable();
      $table->uuid('group_id');
      $table->uuid('user_id')
        ->nullable();

      // add timestamp
      $this->addTimestamp($table);

      // set primary key
      $table->primary('id');

      // adding index
      $this->addIndex($table, ['name']);
      $this->addIndex($table, ['parent_id', 'group_id', 'user_id']);

      // adding foreign key
      $this->addForeign($table, 'parent_id', $this->getTable());
      $this->addForeign($table, 'group_id', (new Group())->getTable());
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
